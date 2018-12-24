<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Category::insert([

	     	[
		        'name' => 'Business'
	     	],
		    [
		        'name'=> 'Education'
		    ],

		    [
		        'name'=> 'Family'
		    ],

		    [
		        'name'=> 'Sport'
		    ],

		    [
		        'name'=> 'Food & Beverages'
		    ],

		    [
		        'name'=> 'Gift & Donations'
		    ],

		    [
		        'name'=> 'Health'
		    ],

		    [
		        'name'=> 'Insurances'
		    ],

		    [
		        'name'=> 'Shopping'
		    ],

		    [
		        'name'=> 'Transportation'
		    ],

		    [
		        'name'=> 'Travel'
		    ],

		    [
		        'name'=> 'Accessories'
		    ],

		    [
		        'name'=> 'Cafe'
		    ],

		    [
		        'name'=> 'Books'
		    ],

		    [
		        'name'=> 'Doctors'
		    ],

		    [
		        'name'=> 'Electricity'
		    ],

		    [
		        'name'=> 'Footwear'
		    ],

		    [
		        'name'=> 'Pets'
		    ],

		    [
		        'name'=> 'Maintenance'
		    ],

		    [
		        'name'=> 'Water'
		    ],

		    [
		        'name'=> 'Personal Care'
		    ],

		    [
		        'name'=> 'Pharmacy'
		    ],

		    [
		        'name'=> 'Television'
		    ],

		    [
		        'name'=> 'Internet'
		    ],

		    [
		        'name'=> 'Event'
		    ],

		    [
		        'name'=> 'Award'
		    ],

		    [
		        'name'=> 'Gifts'
		    ],

		    [
		        'name'=> 'Salary'
		    ],

		    [

		        'name'=> 'Selling'
		    ],

		    [
		        'name'=> 'Loan'
		    ],

		    [
		        'name'=> 'Repayment'
		    ],
		]);
    }
}
