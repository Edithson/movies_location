<?php

namespace Database\Seeders;

use App\Models\Type;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Type::factory()->create([
            'intitule' => 'Client',
        ]);
        Type::factory()->create([
            'intitule' => 'Gérant',
        ]);
        Type::factory()->create([
            'intitule' => 'Administrateur',
        ]);
        Type::factory()->create([
            'intitule' => 'Programmeur',
        ]);

        User::factory()->create([
            'name' => 'Edithson',
            'email' => 'moafogaus@gmail.com',
            'type_id' => 4
        ]);
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'type_id' => 3
        ]);
    }
}
