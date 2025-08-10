<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subs=[
            [
                "Society and Technology",
                "Mathmatics I",
                "English I",
                "Digital Logic",
                "Computer Fundamental and Application"
            ],
            [
                "C Programming",
                "Final Accounting",
                "English II",
                "Mathematics II",
                "Microprocessor and Computer Architechture"
            ],[
                "Data Structure and Algorithm",
                "Probability and Statistics",
                "System Analysis and Design",
                "OOP in java",
                "web Technology"
            ],[
                "Operating System",
                "Numerical Method",
                "Software Engineering",
                "Scripting Language",
                "Database Mangement System"
            ]
        ];

        foreach($subs as $class){
            $class_id=1;
            foreach($class as $subject){
                Subject::create([
                    "name"=>$subject,
                    "class_id"=>$class_id,
                ]);
                
            }
            $class_id++;
        }
    }
}
