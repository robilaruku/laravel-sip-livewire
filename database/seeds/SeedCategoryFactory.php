<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


class SeedCategoryFactory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $ran = array('Active', 'Inactive');

        for ($i=0; $i < 100; $i++) { 
            \DB::table('categories')->insert([
            'name' => Str::random(10),
            'status' => Arr::random($ran),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),

        ]);
        }

    }
}
