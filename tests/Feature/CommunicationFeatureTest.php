<?php

use App\Models\Announcement;
use App\Models\Notification;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

describe('Communication features', function () {
    beforeEach(function () {
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('announcements');
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

        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('announcements');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    });

    it('shows announcements for admins and notifications for users', function () {
        $adminRole = Role::create(['role_name' => 'Admin', 'is_active' => true]);
        $employeeRole = Role::create(['role_name' => 'Employee', 'is_active' => true]);

        $admin = User::factory()->create(['role_id' => $adminRole->id]);
        $employee = User::factory()->create(['role_id' => $employeeRole->id]);

        Announcement::create([
            'title' => 'New policy update',
            'content' => 'Please review the updated attendance policy.',
            'created_by' => $admin->id,
            'is_active' => true,
        ]);

        Notification::create([
            'user_id' => $employee->id,
            'title' => 'Welcome',
            'message' => 'Your profile is ready.',
            'type' => 'info',
        ]);

        $this->actingAs($admin)
            ->get(route('announcements.index'))
            ->assertOk()
            ->assertSee('Announcements')
            ->assertSee('New policy update');

        $this->actingAs($employee)
            ->get(route('notifications.index'))
            ->assertOk()
            ->assertSee('Notifications')
            ->assertSee('Welcome');
    });
});
