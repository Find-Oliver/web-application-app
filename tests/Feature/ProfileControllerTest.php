<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

describe('ProfileController', function () {
    beforeEach(function () {
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
            $table->foreignId('role_id')->nullable()->constrained('roles')->onDelete('set null');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_picture')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Storage::fake('public');
    });

    afterEach(function () {
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    });

    it('allows authenticated users to view and update their profile with an avatar upload', function () {
        $role = Role::create(['role_name' => 'Employee', 'is_active' => true]);
        $user = User::factory()->create([
            'role_id' => $role->id,
            'name' => 'Ava Stone',
            'email' => 'ava@example.test',
            'phone' => '555-0102',
            'address' => '1 Main Street',
            'date_of_birth' => '1993-04-21',
            'gender' => 'Female',
        ]);

        $this->actingAs($user)
            ->get(route('profile.show'))
            ->assertOk()
            ->assertSee('Ava Stone');

        $file = UploadedFile::fake()->image('avatar.jpg', 200, 200);

        $this->actingAs($user)
            ->put(route('profile.update'), [
                'name' => 'Ava Stone',
                'email' => 'ava@example.test',
                'phone' => '555-0111',
                'address' => '2 Main Street',
                'date_of_birth' => '1993-04-21',
                'gender' => 'Female',
                'profile_picture' => $file,
            ])
            ->assertRedirect(route('profile.show'));

        $user->refresh();
        $this->assertNotNull($user->profile_picture);
        $this->assertTrue(Storage::disk('public')->exists($user->profile_picture));
    });
});
