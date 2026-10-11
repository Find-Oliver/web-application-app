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

    it('shows an employee only the employee record linked to their account', function () {
        $employeeRole = Role::create(['role_name' => 'Employee', 'is_active' => true]);
        $employeeUser = User::factory()->create([
            'role_id' => $employeeRole->id,
            'email' => 'luna@example.test',
        ]);

        $employee = Employee::create([
            'employee_code' => 'EMP-OWN-01',
            'first_name' => 'Luna',
            'last_name' => 'Ng',
            'email' => 'luna@example.test',
            'phone' => '555-0010',
            'address' => '55 Market Street',
            'date_of_birth' => '1996-02-01',
            'gender' => 'Female',
            'position_id' => 1,
            'department_id' => 1,
            'employment_status' => 'Active',
            'date_hired' => '2024-01-15',
        ]);

        $otherEmployee = Employee::create([
            'employee_code' => 'EMP-OTHER-01',
            'first_name' => 'Alex',
            'last_name' => 'Kim',
            'email' => 'alex@example.test',
            'phone' => '555-0020',
            'address' => '10 Market Street',
            'date_of_birth' => '1995-02-01',
            'gender' => 'Other',
            'position_id' => 1,
            'department_id' => 1,
            'employment_status' => 'Active',
            'date_hired' => '2024-01-15',
        ]);

        $this->actingAs($employeeUser)
            ->get(route('leave_requests.create'))
            ->assertOk()
            ->assertSee('<option value="'.$employee->id.'"', false)
            ->assertDontSee('<option value="'.$otherEmployee->id.'"', false);
    });

    it('forces employee submissions to their linked record and pending status', function () {
        $employeeRole = Role::create(['role_name' => 'Employee', 'is_active' => true]);
        User::factory()->create([
            'role_id' => $employeeRole->id,
            'email' => 'another-user@example.test',
        ]);
        $employeeUser = User::factory()->create([
            'role_id' => $employeeRole->id,
            'email' => 'luna@example.test',
        ]);
        $employee = Employee::create([
            'employee_code' => 'EMP-OWN-02',
            'first_name' => 'Luna',
            'last_name' => 'Ng',
            'email' => 'luna@example.test',
            'phone' => '555-0010',
            'address' => '55 Market Street',
            'date_of_birth' => '1996-02-01',
            'gender' => 'Female',
            'position_id' => 1,
            'department_id' => 1,
            'employment_status' => 'Active',
            'date_hired' => '2024-01-15',
        ]);
        $otherEmployee = Employee::create([
            'employee_code' => 'EMP-OTHER-02',
            'first_name' => 'Alex',
            'last_name' => 'Kim',
            'email' => 'alex@example.test',
            'phone' => '555-0020',
            'address' => '10 Market Street',
            'date_of_birth' => '1995-02-01',
            'gender' => 'Other',
            'position_id' => 1,
            'department_id' => 1,
            'employment_status' => 'Active',
            'date_hired' => '2024-01-15',
        ]);
        $leaveType = LeaveType::create([
            'leave_type_name' => 'Vacation Leave',
            'default_days' => 10,
            'is_active' => true,
        ]);

        $this->actingAs($employeeUser)
            ->post(route('leave_requests.store'), [
                'employee_id' => $otherEmployee->id,
                'leave_type_id' => $leaveType->id,
                'start_date' => now()->addDay()->toDateString(),
                'end_date' => now()->addDays(2)->toDateString(),
                'reason' => 'Family trip',
                'status' => 'Approved',
            ])
            ->assertRedirect(route('leave_requests.index'));

        $this->assertDatabaseHas('leave_requests', [
            'employee_id' => $employee->id,
            'leave_type_id' => $leaveType->id,
            'status' => 'Pending',
        ]);
        $this->assertDatabaseMissing('leave_requests', [
            'employee_id' => $otherEmployee->id,
        ]);

        $leaveRequest = LeaveRequest::firstOrFail();
        $this->actingAs($employeeUser)
            ->get(route('leave_requests.show', $leaveRequest))
            ->assertOk();

        $this->actingAs($employeeUser)
            ->put(route('leave_requests.update', $leaveRequest), [
                'employee_id' => $otherEmployee->id,
                'leave_type_id' => $leaveType->id,
                'start_date' => now()->addDay()->toDateString(),
                'end_date' => now()->addDays(2)->toDateString(),
                'reason' => 'Updated family trip',
                'status' => 'Approved',
            ])
            ->assertRedirect(route('leave_requests.index'));

        $this->assertDatabaseHas('leave_requests', [
            'id' => $leaveRequest->id,
            'employee_id' => $employee->id,
            'status' => 'Pending',
            'reason' => 'Updated family trip',
        ]);
    });

    it('shows an empty state and rejects submissions for an unlinked employee account', function () {
        $employeeRole = Role::create(['role_name' => 'Employee', 'is_active' => true]);
        $employeeUser = User::factory()->create([
            'role_id' => $employeeRole->id,
            'email' => 'unlinked@example.test',
        ]);
        $otherEmployee = Employee::create([
            'employee_code' => 'EMP-OTHER-03',
            'first_name' => 'Alex',
            'last_name' => 'Kim',
            'email' => 'alex@example.test',
            'phone' => '555-0020',
            'address' => '10 Market Street',
            'date_of_birth' => '1995-02-01',
            'gender' => 'Other',
            'position_id' => 1,
            'department_id' => 1,
            'employment_status' => 'Active',
            'date_hired' => '2024-01-15',
        ]);
        $leaveType = LeaveType::create([
            'leave_type_name' => 'Vacation Leave',
            'default_days' => 10,
            'is_active' => true,
        ]);

        $this->actingAs($employeeUser)
            ->get(route('leave_requests.create'))
            ->assertOk()
            ->assertSee('No employee record is linked to your account.');

        $this->actingAs($employeeUser)
            ->post(route('leave_requests.store'), [
                'employee_id' => $otherEmployee->id,
                'leave_type_id' => $leaveType->id,
                'start_date' => now()->addDay()->toDateString(),
                'end_date' => now()->addDays(2)->toDateString(),
                'reason' => 'Family trip',
            ])
            ->assertForbidden();

        $this->assertDatabaseMissing('leave_requests', [
            'employee_id' => $otherEmployee->id,
        ]);
    });

    it('returns leave form validation errors for missing fields and reversed dates', function () {
        $employeeRole = Role::create(['role_name' => 'Employee', 'is_active' => true]);
        $employeeUser = User::factory()->create([
            'role_id' => $employeeRole->id,
            'email' => 'luna@example.test',
        ]);
        $employee = Employee::create([
            'employee_code' => 'EMP-VALID-01',
            'first_name' => 'Luna',
            'last_name' => 'Ng',
            'email' => 'luna@example.test',
            'phone' => '555-0010',
            'address' => '55 Market Street',
            'date_of_birth' => '1996-02-01',
            'gender' => 'Female',
            'position_id' => 1,
            'department_id' => 1,
            'employment_status' => 'Active',
            'date_hired' => '2024-01-15',
        ]);
        $leaveType = LeaveType::create([
            'leave_type_name' => 'Vacation Leave',
            'default_days' => 10,
            'is_active' => true,
        ]);

        $this->actingAs($employeeUser)
            ->post(route('leave_requests.store'), ['employee_id' => $employee->id])
            ->assertSessionHasErrors(['leave_type_id', 'start_date', 'end_date', 'reason']);

        $this->actingAs($employeeUser)
            ->post(route('leave_requests.store'), [
                'employee_id' => $employee->id,
                'leave_type_id' => $leaveType->id,
                'start_date' => now()->addDays(3)->toDateString(),
                'end_date' => now()->addDay()->toDateString(),
                'reason' => 'Date validation check',
            ])
            ->assertSessionHasErrors(['start_date', 'end_date']);

        $this->get(route('leave_requests.create'))
            ->assertOk()
            ->assertSee('<option value="'.$employee->id.'" selected>', false)
            ->assertSee('Date validation check');
    });
});
