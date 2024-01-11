<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\CitySeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\StatesTableSeeder;
use Database\Seeders\CountriesTableSeeder;
use Database\Seeders\CitiesTableChunkOneSeeder;
use Database\Seeders\CitiesTableChunkTwoSeeder;
use Database\Seeders\CitiesTableChunkFiveSeeder;
use Database\Seeders\CitiesTableChunkFourSeeder;
use Database\Seeders\CitiesTableChunkThreeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(UserSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(CitiesTableChunkOneSeeder::class);
        $this->call(CitiesTableChunkTwoSeeder::class);
        $this->call(CitiesTableChunkThreeSeeder::class);
        $this->call(CitiesTableChunkFourSeeder::class);
        $this->call(CitiesTableChunkFiveSeeder::class);
        
    }
}
