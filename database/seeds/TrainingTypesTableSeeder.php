<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainingTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('training_types')->insert([
            ['name'=>'Equipment and PPE'],
            ['name'=>'Audit and Review'],
            ['name'=>'Incident Management'],
            ['name'=>'Risk Assessment'],
            ['name'=>'Supplier Management']
        
        ]);
    }
}
