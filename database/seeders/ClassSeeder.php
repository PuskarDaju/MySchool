<?php

namespace Database\Seeders;

use App\Models\ClassModel;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name=[
            '1st sem',"2nd sem","3rd sem","4th sem"];
            foreach($name as $n){
                ClassModel::create([
                    "name"=>$n
                ]);
            }
    }

}
