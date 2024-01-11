<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert(array (
            0=>array (
                'id' => 1,
                'name' => 'Managemnt',
                'code' => 'MGT',
                'created_at' => '2021-01-08 07:43:22',
                'updated_at' => '2021-01-08 07:43:22',
                'deleted_at' => NULL,
            ),
            1=>array (
                'id' => 2,
                'name' => 'Human Resource',
                'code' => 'HR',
                'created_at' => '2021-01-08 07:43:22',
                'updated_at' => '2021-01-08 07:43:22',
                'deleted_at' => NULL,
            ),
            2=>array (
                'id' => 3,
                'name' => 'Finance',
                'code' => 'FIN',
                'created_at' => '2021-01-08 07:43:22',
                'updated_at' => '2021-01-08 07:43:22',
                'deleted_at' => NULL,
            ),
            3=>array (
                'id' => 4,
                'name' => 'Sales',
                'code' => 'SAL',
                'created_at' => '2021-01-08 07:43:22',
                'updated_at' => '2021-01-08 07:43:22',
                'deleted_at' => NULL,
            ),
            4=>array (
                'id' => 5,
                'name' => 'Marketing',
                'code' => 'MKT',
                'created_at' => '2021-01-08 07:43:22',
                'updated_at' => '2021-01-08 07:43:22',
                'deleted_at' => NULL,
            )));
    }
}
