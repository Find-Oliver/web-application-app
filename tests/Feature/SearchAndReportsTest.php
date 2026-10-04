<?php

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

describe('Search and reports', function () {
    beforeEach(function () {
        Schema::dropIfExists('attendance');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('positions');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name');
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
            $table->string('email')->unique();
            $table->string('phone');
            $table->text('address');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->foreignId('department_id')->constrained('departments');
            $table->foreignId('position_id')->constrained('positions');
            $table->string('employment_status')->default('Active');
            $table->date('date_hired');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->date('attendance_date');
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->string('status')->default('Absent');
            $table->timestamps();
            $table->unique(['employee_id', 'attendance_date']);
        });
    });

    afterEach(function () {
        Schema::dropIfExists('attendance');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('positions');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    });

    it('supports employee search and a report overview for admins', function () {
        $adminRole = Role::create(['role_name' => 'Admin', 'is_active' => true]);
        $admin = User::factory()->create(['role_id' => $adminRole->id]);

        $department = DB::table('departments')->insertGetId(['department_name' => 'Operations', 'description' => 'Ops', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]);
        $position = DB::table('positions')->insertGetId(['position_name' => 'Coordinator', 'description' => 'Coord', 'is_active' => true, 'created_at' => now(), 'updated_at' => now()]);

        $employee = Employee::create([
            'employee_code' => 'EMP-101',
            'first_name' => 'Rina',
            'last_name' => 'Mendoza',
            'email' => 'rina@example.test',
            'phone' => '555-0101',
            'address' => '20 Blue Ave',
            'date_of_birth' => '1991-02-10',
            'gender' => 'Female',
            'department_id' => $department,
            'position_id' => $position,
            'employment_status' => 'Active',
            'date_hired' => '2023-05-15',
        ]);

        Attendance::create([
            'employee_id' => $employee->id,
            'attendance_date' => today(),
            'time_in' => '08:00:00',
            'time_out' => '17:00:00',
            'status' => 'Present',
        ]);

        $this->actingAs($admin)
            ->get(route('employees.index', ['search' => 'Mendoza']))
            ->assertOk()
            ->assertSee('Rina Mendoza');

        $this->actingAs($admin)
            ->get(route('reports.index'))
            ->assertOk()
            ->assertSee('Attendance Summary');
    });
});
