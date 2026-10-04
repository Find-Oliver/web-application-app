<?php

use App\Models\Employee;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

describe('Leave management', function () {
    beforeEach(function () {
        Schema::dropIfExists('leave_requests');
        Schema::dropIfExists('leave_types');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('positions');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name');
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->nullable()->constrained('roles');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('department_name')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('position_name')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_code')->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->string('email')->unique();
            $table->string('phone');
            $table->text('address');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->unsignedBigInteger('position_id');
            $table->unsignedBigInteger('department_id');
            $table->string('employment_status')->default('Active');
            $table->date('date_hired');
            $table->string('profile_picture')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->string('leave_type_name')->unique();
            $table->text('description')->nullable();
            $table->integer('default_days')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('leave_type_id')->constrained('leave_types')->restrictOnDelete();
            $table->date('start_date');
            $table->date('end_date');
            $table->text('reason');
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Cancelled'])->default('Pending');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    });

    afterEach(function () {
        Schema::dropIfExists('leave_requests');
        Schema::dropIfExists('leave_types');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('positions');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    });

    it('supports admin leave type management and employee leave request approval', function () {
        $adminRole = Role::create(['role_name' => 'Admin', 'is_active' => true]);
        $employeeRole = Role::create(['role_name' => 'Employee', 'is_active' => true]);
        $admin = User::factory()->create(['role_id' => $adminRole->id]);
        $employeeUser = User::factory()->create(['role_id' => $employeeRole->id, 'email' => 'luna@example.test']);

        $department = 1;
        $position = 1;

        $employee = Employee::create([
            'employee_code' => 'EMP-LOVE-01',
            'first_name' => 'Luna',
            'last_name' => 'Ng',
            'email' => 'luna@example.test',
            'phone' => '555-0010',
            'address' => '55 Market Street',
            'date_of_birth' => '1996-02-01',
            'gender' => 'Female',
            'position_id' => $position,
            'department_id' => $department,
            'employment_status' => 'Active',
            'date_hired' => '2024-01-15',
        ]);

        $this->actingAs($admin)
            ->get(route('leave_types.index'))
            ->assertOk();

        $this->actingAs($admin)
            ->post(route('leave_types.store'), [
                'leave_type_name' => 'Sick Leave',
                'description' => 'Medical leave',
                'default_days' => 5,
                'is_active' => true,
            ])
            ->assertRedirect(route('leave_types.index'));

        $leaveType = LeaveType::firstOrFail();

        $this->actingAs($employeeUser)
            ->get(route('leave_requests.create'))
            ->assertOk();

        $this->actingAs($employeeUser)
            ->post(route('leave_requests.store'), [
                'employee_id' => $employee->id,
                'leave_type_id' => $leaveType->id,
                'start_date' => now()->addDay()->toDateString(),
                'end_date' => now()->addDays(2)->toDateString(),
                'reason' => 'Medical appointment',
            ])
            ->assertRedirect(route('leave_requests.index'));

        $leaveRequest = LeaveRequest::firstOrFail();
        $this->assertDatabaseHas('leave_requests', ['id' => $leaveRequest->id, 'status' => 'Pending']);

        $this->actingAs($admin)
            ->patch(route('leave_requests.approve', $leaveRequest), ['remarks' => 'Approved by HR'])
            ->assertRedirect(route('leave_requests.index'));

        $this->assertDatabaseHas('leave_requests', ['id' => $leaveRequest->id, 'status' => 'Approved']);
    });

    it('denies employee users access to leave type administration', function () {
        $employeeRole = Role::create(['role_name' => 'Employee', 'is_active' => true]);
        $employeeUser = User::factory()->create(['role_id' => $employeeRole->id]);

        $this->actingAs($employeeUser)
            ->get(route('leave_types.index'))
            ->assertForbidden();
    });
});
