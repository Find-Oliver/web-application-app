<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

describe('RoleController', function () {
    beforeEach(function () {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');

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
    });

    afterEach(function () {
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    });

    it('renders the roles index page for an authenticated admin', function () {
        $adminRole = Role::create([
            'role_name' => 'Admin',
            'description' => 'System administrator',
            'is_active' => true,
        ]);

        $role = Role::create([
            'role_name' => 'HR Manager',
            'description' => 'Handles HR operations',
            'is_active' => true,
        ]);

        $admin = User::factory()->create([
            'role_id' => $adminRole->id,
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        $response = $this->actingAs($admin)->get('/roles');

        $response->assertOk();
        $response->assertSee('HR Manager');
        $response->assertSee('Manage Roles');
    });
});
