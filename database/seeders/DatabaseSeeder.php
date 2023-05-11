<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        /*Role::create(['name' => 'admin']);
        Role::create(['name' => 'promoter']);

        $admin= \App\Models\User::factory()->create([
            'username' => 'admin',
            'name' => 'Administrador',
            'email' => 'admin@example.com',
        ]);

        $admin->assignRole('admin');

        $this->call(ActivitySeeder::class);
        $this->call(ElectionTypeSeeder::class);
        $this->call(ElectionsSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(SchoolGradeSeeder::class);
        $this->call(SectionTypeSeeder::class);
        $this->call(SchoolGradeSeeder::class);
        $this->call(StructureSeeder::class);*/
        //$this->call(StructureMunicipalitySeeder::class);
        
        //$this->call(UserPromoterSeeder::class);
        $this->call(UserPromoterMunicipalitySeeder::class);
    }
}
