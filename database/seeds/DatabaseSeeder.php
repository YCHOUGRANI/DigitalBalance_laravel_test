<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call([UsersTableSeeder::class,TrainingTypesTableSeeder::class,TrainingTableSeeder::class]);
       // $this->call(UsersTableSeeder::class);
        $this->call(TrainingTypesTableSeeder::class);
        $this->call(TrainingsTableSeeder::class);
        
    }
}
