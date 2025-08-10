<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   
    public function run()
    {
        $names = [
            'Suman Karki',
            'Bishal Shrestha',
            'Nirajan Bhandari',
            'Sunita Basnet',
            'Rita Thapa',
            'Manoj Adhikari',
            'Anita Sharma',
            'Deepak Poudel',
            'Ramesh Maharjan',
            'Saraswati Joshi'
        ];

        foreach ($names as $name) {
            $email = strtolower(str_replace(' ', '', $name)) . '@gmail.com';

            User::create([
                'name' => $name,
                'email' => $email,
                'password' => "Password",
                'role' => 'teacher'
            ]);
        }
         User::create([
                'name' => "puskar",
                'email' => "puskar@gmail.com",
                'password' => "Password",
                'role' => 'admin'
            ]);
    }
}

