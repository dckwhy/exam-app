<?php

namespace Database\Seeders;

use App\Models\Oldster;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
                'role' => 'admin'
            ],
            [
                'name' => 'Parent',
                'email' => 'parent@parent.com',
                'password' => Hash::make('parent'),
                'role' => 'parent'
            ],
            [
                'name' => 'Student',
                'email' => 'student@student.com',
                'password' => Hash::make('student'),
                'role' => 'student'
            ],
        ];
        User::insert($users);
        Oldster::create([
            'user_id' => 2
        ]);
        Student::create([
            'place_of_birth' => 'Tes',
            'date_of_birth' => '2000-02-02',
            'gender' => 'Male',
            'phone' => '',
            'address' => '',
            'school_origin' => '',
            'user_id' => 3,
            'oldster_id' => 1
        ]);
    }
}
