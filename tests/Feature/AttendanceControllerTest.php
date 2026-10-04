<?php

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

describe('AttendanceController', function () {
    beforeEach(function () {
        Schema::dropIfExists('attendance');
        Schema::dropIfExists('employees');
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
            $table->string('emergency_contact_phone')->nullable();
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
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->unique(['employee_id', 'attendance_date']);
        });
    });

    afterEach(function () {
        Schema::dropIfExists('attendance');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    });

    it('supports admin attendance management and one record per employee per day', function () {
        $adminRole = Role::create(['role_name' => 'Admin', 'is_active' => true]);
        $admin = User::factory()->create(['role_id' => $adminRole->id]);
        $employee = Employee::create([
            'employee_code' => 'EMP-ATT-01',
            'first_name' => 'Avery',
            'last_name' => 'Jones',
            'email' => 'avery@example.test',
            'phone' => '555-0110',
            'address' => '10 Main Street',
            'date_of_birth' => '1990-01-01',
            'gender' => 'Other',
            'position_id' => 1,
            'department_id' => 1,
            'employment_status' => 'Active',
            'date_hired' => '2020-01-01',
        ]);
        $data = [
            'employee_id' => $employee->id,
            'attendance_date' => today()->toDateString(),
            'time_in' => '08:30',
            'time_out' => '17:00',
            'status' => 'Present',
            'remarks' => 'On time',
        ];

        $this->actingAs($admin)
            ->get(route('attendance.index'))
            ->assertOk()
            ->assertSee('Attendance');
        $this->get(route('attendance.create'))->assertOk();
        $this->post(route('attendance.store'), $data)
            ->assertRedirect(route('attendance.index'));

        $record = Attendance::firstOrFail();
        $this->assertDatabaseHas('attendance', [
            'employee_id' => $employee->id,
            'status' => 'Present',
        ]);
        $this->assertSame(today()->toDateString(), $record->attendance_date->toDateString());
        $this->get(route('attendance.edit', $record))->assertOk();

        $this->put(route('attendance.update', $record), [...$data, 'status' => 'Late'])
            ->assertRedirect(route('attendance.index'));
        $this->assertDatabaseHas('attendance', ['id' => $record->id, 'status' => 'Late']);

        $this->post(route('attendance.store'), $data)
            ->assertSessionHasErrors(['attendance_date']);

        $this->delete(route('attendance.destroy', $record))
            ->assertRedirect(route('attendance.index'));
        $this->assertDatabaseMissing('attendance', ['id' => $record->id]);
    });

    it('denies employee accounts access to the admin attendance log', function () {
        $employeeRole = Role::create(['role_name' => 'Employee', 'is_active' => true]);
        $employeeUser = User::factory()->create(['role_id' => $employeeRole->id]);

        $this->actingAs($employeeUser)
            ->get(route('attendance.index'))
            ->assertForbidden();
    });
});
