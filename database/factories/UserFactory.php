<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Enums\RoleEnum; 
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'lastname' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->e164PhoneNumber(),
            'birthday' => fake()->dateTimeBetween('-70 years', '-18 years')
                ->format('Y-m-d'),
            'email_verified_at' => now(),
            'password' => Hash::make(static::$password ??= 'qwerty'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Configure the factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function ($user) {
            if (! $user->hasAnyRole(RoleEnum::values())) {
                $user->assignRole(RoleEnum::CUSTOMER->value);
            }
        });
    }

    /**
     * Admin state.
     */
    public function admin(): static
    {
        return $this->state(fn ($attributes) => [
            'email' => 'admin@admin.com',
        ])->afterCreating(function ($user) {
            $user->syncRoles([RoleEnum::ADMIN->value]);
        });
    }

    /**
     * Moderator state.
     */
    public function moderator(): static
    {
        return $this->state(fn ($attributes) => [
            'email' => 'moderator@admin.com', 
        ])->afterCreating(function ($user) {
            $user->syncRoles([RoleEnum::MODERATOR->value]);
        });
    }

    /**
     * State for custom email.
     */
    public function withEmail(string $email): static
    {
        return $this->state(fn ($attributes) => [
            'email' => $email,
        ]);
    }
}
