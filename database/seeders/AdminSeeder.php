<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //ชุมชน
        // $communityRole = Role::create(['name' => 'community']);
        //นักวิจัย
        // $researcherRole = Role::create(['name' => 'researcher']);
        //ผู้ดูแลระบบ
        // $adminRole = Role::create(['name' => 'admin']);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'role_id' => 3,
        ]);
    }
}
