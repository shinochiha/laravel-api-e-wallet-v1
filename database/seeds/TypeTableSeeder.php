<?php

use Illuminate\Database\Seeder;
use App\Type;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Type::insert([
        	
        	[
        		'type'	=> 'none'
        	],
        	[
        		'type'	=> 'income'
        	],
        	[
        		'type'	=> 'expense'
        	],
        ]);
    }
}
