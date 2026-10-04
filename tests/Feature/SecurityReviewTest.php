<?php

use App\Models\Notification;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

describe('Security review', function () {
    beforeEach(function () {
        Schema::dropIfExists('notifications');
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

        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->text('message');
            $table->string('type')->default('info');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
    });

    afterEach(function () {
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    });

    it('blocks non-admin users from admin-only pages', function () {
        $employeeRole = Role::create(['role_name' => 'Employee', 'is_active' => true]);
        $employee = User::factory()->create(['role_id' => $employeeRole->id]);

        $this->actingAs($employee)
            ->get(route('employees.index'))
            ->assertForbidden();

        $this->actingAs($employee)
            ->get(route('reports.index'))
            ->assertForbidden();
    });

    it('prevents users from marking another user\'s notification as read', function () {
        $adminRole = Role::create(['role_name' => 'Admin', 'is_active' => true]);
        $employeeRole = Role::create(['role_name' => 'Employee', 'is_active' => true]);

        $admin = User::factory()->create(['role_id' => $adminRole->id]);
        $employee = User::factory()->create(['role_id' => $employeeRole->id]);

        $notification = Notification::create([
            'user_id' => $admin->id,
            'title' => 'Payroll update',
            'message' => 'Your payroll entry is ready.',
            'type' => 'info',
        ]);

        $this->actingAs($employee)
            ->patch(route('notifications.read', $notification))
            ->assertForbidden();
    });
});
