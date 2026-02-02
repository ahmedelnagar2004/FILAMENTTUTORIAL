<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enum\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'role' => Role::SUBSCRIBER->value,
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role' => Role::ADMIN->value,
        ]);

        User::factory()->create([
            'name' => 'Editor User',
            'email' => 'editor@example.com',
            'password' => 'password',
            'role' => Role::EDITOR->value,
        ]);

        User::factory()->create([
            'name' => 'Subscriber User',
            'email' => 'subscriber@example.com',
            'password' => 'password',
            'role' => Role::SUBSCRIBER->value,
        ]);
    }
}
