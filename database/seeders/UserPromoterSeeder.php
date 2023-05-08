<?php

namespace Database\Seeders;

use App\Models\StructureCoordinator;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserPromoterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promoters= StructureCoordinator::with('member')->where('position_id', 5)->get();

        foreach($promoters as $promoter){
            $user= User::factory()->create([
                'name' => $promoter->member->firstname.' '.$promoter->member->lastname,
                'username' => $promoter->member->electoral_key,
                'email' => $promoter->member->email,
                'password' => Hash::make($promoter->member->electoral_key),
            ]);

            $user->assignRole('promoter');
        }
    }
}
