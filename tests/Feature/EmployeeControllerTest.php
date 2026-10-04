<?php

use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

describe('EmployeeController', function () {
    beforeEach(function () {
        Schema::dropIfExists('employees');
        Schema::dropIfExists('positions');
        Schema::dropIfExists('departments');
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
            $table->string('employee_code', 50)->unique();
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100);
            $table->string('suffix', 20)->nullable();
            $table->string('email', 100)->unique();
            $table->string('phone', 20);
            $table->text('address');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->foreignId('position_id')->constrained('positions');
            $table->foreignId('department_id')->constrained('departments');
            $table->string('employment_status')->default('Active');
            $table->date('date_hired');
            $table->string('profile_picture')->nullable();
            $table->string('emergency_contact', 100)->nullable();
            $table->string('emergency_contact_phone', 20)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

    });

    afterEach(function () {
        Schema::dropIfExists('employees');
        Schema::dropIfExists('positions');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    });

    it('supports the employee CRUD workflow for admins', function () {
        $adminRole = Role::create(['role_name' => 'Admin', 'is_active' => true]);
        $admin = User::factory()->create(['role_id' => $adminRole->id]);
        $department = Department::create(['department_name' => 'People']);
        $position = Position::create(['position_name' => 'Coordinator']);

        $data = [
            'employee_code' => 'EMP-1001',
            'first_name' => 'Jamie',
            'middle_name' => null,
            'last_name' => 'Rivera',
            'suffix' => null,
            'email' => 'jamie@example.test',
            'phone' => '555-0101',
            'address' => '10 Main Street',
            'date_of_birth' => '1990-05-10',
            'gender' => 'Other',
            'position_id' => $position->id,
            'department_id' => $department->id,
            'employment_status' => 'Active',
            'date_hired' => '2024-01-15',
            'emergency_contact' => 'Alex Rivera',
            'emergency_contact_phone' => '555-0102',
        ];

        $this->actingAs($admin)
            ->get(route('employees.index'))
            ->assertOk()
            ->assertSee('Employees');

        $this->actingAs($admin)
            ->get(route('employees.create'))
            ->assertOk()
            ->assertSee('Add employee');

        $this->actingAs($admin)
            ->post(route('employees.store'), $data)
            ->assertRedirect();

        $employee = Employee::firstOrFail();
        $this->assertDatabaseHas('employees', ['employee_code' => 'EMP-1001', 'email' => 'jamie@example.test']);

        $this->get(route('employees.show', $employee))
            ->assertOk()
            ->assertSee('Jamie Rivera');
        $this->get(route('employees.edit', $employee))->assertOk();

        $this->put(route('employees.update', $employee), [...$data, 'last_name' => 'Santos'])
            ->assertRedirect(route('employees.show', $employee));
        $this->assertDatabaseHas('employees', ['id' => $employee->id, 'last_name' => 'Santos']);

        $this->delete(route('employees.destroy', $employee))
            ->assertRedirect(route('employees.index'));
        $this->assertSoftDeleted('employees', ['id' => $employee->id]);
    });

    it('validates required fields and unique employee identifiers', function () {
        $adminRole = Role::create(['role_name' => 'Admin', 'is_active' => true]);
        $admin = User::factory()->create(['role_id' => $adminRole->id]);
        $department = Department::create(['department_name' => 'People']);
        $position = Position::create(['position_name' => 'Coordinator']);

        $data = [
            'employee_code' => 'EMP-1002',
            'first_name' => 'Taylor',
            'last_name' => 'Morgan',
            'email' => 'taylor@example.test',
            'phone' => '555-0103',
            'address' => '12 Main Street',
            'date_of_birth' => '1992-03-20',
            'gender' => 'Female',
            'position_id' => $position->id,
            'department_id' => $department->id,
            'employment_status' => 'Active',
            'date_hired' => '2024-03-01',
        ];

        $this->actingAs($admin)
            ->post(route('employees.store'), [])
            ->assertSessionHasErrors(['employee_code', 'first_name', 'last_name', 'email']);

        $this->post(route('employees.store'), [...$data, 'email' => 'invalid-email'])
            ->assertSessionHasErrors(['email']);

        $this->post(route('employees.store'), $data)->assertRedirect();
        $this->post(route('employees.store'), $data)->assertSessionHasErrors(['employee_code', 'email']);
    });

    it('denies employee users access to employee administration', function () {
        $employeeRole = Role::create(['role_name' => 'Employee', 'is_active' => true]);
        $employeeUser = User::factory()->create(['role_id' => $employeeRole->id]);

        $this->actingAs($employeeUser)
            ->get(route('employees.index'))
            ->assertForbidden();
    });
});
