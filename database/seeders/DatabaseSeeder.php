<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'superAdmin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);
        DB::table('settings')->insert([
            [
                'key'=>'clincprice',
                'value'=>50,
            ],
            [
                'key'=>'app_Name',
                'value'=>'Med-verse',
            ],
            [
                'key'=>'data_format',
                'value'=>'DD/MM/YYYY',
            ],
            [
                'key'=>'paginationlimit',
                'value'=>10,
            ],
        ]);
        DB::table('groupproducts')->insert([
            [
                'Groupname'=>'Generic Medicine',
        
            ],
            [
                'Groupname'=>'Diabetes ',
             
            ],
         
        ]);
        DB::table('packages')->insert([
            [
                'package_name'=>'Individual Basic',
                'price'=>'1000',
                'type'=>'Individuals',
                'Cloud inventory system'=>true,
                'One clinic  (you can add more)'=>true,
                'Reports'=>true,
                'E-store'=>true,
                'Analysis'=>false,
                'Online Consultation (one session)'=>false,
                'Edit account'=>false,
                '4 clinics (you can add more)'=>false,
                'One to one Consultation (one session)'=>false,
 
            ],
            [
                'package_name'=>'Individual Pro',
                'type'=>'Individuals',
                'price'=>'1500',
                'Cloud inventory system'=>true,
                'One clinic  (you can add more)'=>true,
                'Reports'=>true,
                'E-store'=>true,
                'Analysis'=>true,
                'Online Consultation (one session)'=>true,
                'Edit account'=>true,
                '4 clinics (you can add more)'=>false,
                'One to one Consultation (one session)'=>true,
            ],
            [
                'package_name'=>'Clinic Basic',
                'type'=>'Clinics',
                'price'=>'2800',
                'Cloud inventory system'=>true,
                '4 clinics (you can add more)'=>true,
                'Reports'=>true,
                'E-store'=>true,
                'Analysis'=>false,
                'Online Consultation (one session)'=>false,
                'Edit account'=>false,
                'One clinic  (you can add more)'=>false,
                'One to one Consultation (one session)'=>false,
            ],
            [
                'package_name'=>'Clinic Pro',
                'type'=>'Clinics',
                'price'=>'3500',
                'Cloud inventory system'=>true,
                '4 clinics (you can add more)'=>true,
                'Reports'=>true,
                'E-store'=>true,
                'Analysis'=>true,
                'Online Consultation (one session)'=>true,
                'Edit account'=>true,
                'One clinic  (you can add more)'=>true,
                'One to one Consultation (one session)'=>true,
            ],
            [
                'package_name'=>'Student Subscription',
                'type'=>'Individuals',
                'price'=>'0',
                'Cloud inventory system'=>true,
                '4 clinics (you can add more)'=>true,
                'Reports'=>true,
                'E-store'=>true,
                'Analysis'=>true,
                'Online Consultation (one session)'=>true,
                'Edit account'=>true,
                'One clinic  (you can add more)'=>true,
                'One to one Consultation (one session)'=>true,
            ],
            [
                'package_name'=>'One to one Consultation per session',
                'type'=>'others',
                'price'=>'500',
                'Cloud inventory system'=>true,
                '4 clinics (you can add more)'=>true,
                'Reports'=>true,
                'E-store'=>true,
                'Analysis'=>true,
                'Online Consultation (one session)'=>true,
                'Edit account'=>true,
                'One clinic  (you can add more)'=>true,
                'One to one Consultation (one session)'=>true,
            ],
        ]);
    }
}
