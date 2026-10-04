<?php

use App\Models\ActivityLog;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

describe('Activity log', function () {
    beforeEach(function () {
        Schema::dropIfExists('activity_logs');
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

        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('action');
            $table->string('subject');
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->longText('description')->nullable();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
        });
    });

    afterEach(function () {
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    });

    it('shows recent activity to admin users', function () {
        $adminRole = Role::create(['role_name' => 'Admin', 'is_active' => true]);
        $admin = User::factory()->create(['role_id' => $adminRole->id]);

        ActivityLog::create([
            'user_id' => $admin->id,
            'action' => 'login',
            'subject' => 'user',
            'subject_id' => $admin->id,
            'description' => 'Admin logged in successfully.',
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Laravel Test',
        ]);

        $this->actingAs($admin)
            ->get(route('activity_logs.index'))
            ->assertOk()
            ->assertSee('Activity Logs')
            ->assertSee('Admin logged in successfully.');
    });
});
