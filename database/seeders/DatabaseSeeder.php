<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'nama_role' => 'Administrator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_role' => 'Super Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_role' => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_role' => 'User',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);


        DB::table('positions')->insert([
            [
                'nama_posisi' => 'Manager',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama_posisi' => 'Sales',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama_posisi' => 'Staf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('types')->insert([
            [
                'nama_tipe' => 'Product',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_tipe' => 'Jasa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('companies')->insert([
            [
                'nama_company' => 'Indo Global Cyber Technology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_company' => 'Maxy Academy',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);


        DB::table('industri_types')->insert([
            [
                'nama_industri_type' => 'Financial Services',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_industri_type' => 'Information Techonology',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('company_scales')->insert([
            [
                'nama_company_scale' => 'Large Business (> 250 Employee)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_company_scale' => 'Medium-sized Business (50 <= Employee < 250)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_company_scale' => 'Small Business (< 50 Employee)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
