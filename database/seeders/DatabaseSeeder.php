<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Skip seeding in production environment
        if (app()->environment('production')) {
            $this->command->info('⚠️  Automatic seeding is disabled in production');
            $this->command->info('💡 Run seeders manually if needed: railway run php artisan db:seed');
            return;
        }

        // Development seeding only
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->command->info('✅ Development database seeded successfully!');
    }
}
