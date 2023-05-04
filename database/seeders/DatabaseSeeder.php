<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
        ]);
        $this->call(ActivitySeeder::class);
        $this->call(ElectionTypeSeeder::class);
        $this->call(ElectionsSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(SchoolGradeSeeder::class);
        $this->call(SectionTypeSeeder::class);
        $this->call(SchoolGradeSeeder::class);
    }
}
