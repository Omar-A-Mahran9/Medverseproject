<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
