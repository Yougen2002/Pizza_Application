<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 
        $deals = [
            [
                'name' => 'Buy One Get One Free for Large Pizza',
                'code' => 'BOGOF',
                'type' =>'number_of_items_validation',
                'size'=> 'large',
                'value' =>2,
                'price_type' => 'percentage',
                'price_value' => '0',
                'description' => 'Buy one get one free when two large pizzas are purchased',
                'is_active'=> 1,
            ],

            [
                'name' => 'Buy One Get One Free for Medium Pizza',
                'code' => 'BOGOF',
                'type' =>'number_of_items_validation',
                'size'=> 'medium',
                'value' =>2,
                'price_type' => 'percentage',
                'price_value' => '0',
                'description' => 'Buy one get one free when two medium pizzas are purchased',
                'is_active'=> 1,
            ],

            [
                'name' => 'Three for Two',
                'code' => '3FOR2',
                'type' =>'number_of_items_validation',
                'size'=> 'medium',
                'value' =>3,
                'price_type' => 'percentage',
                'price_value' => '33',
                'description' => 'Buy two and get one for free',
                'is_active'=> 1,
            ],
            [
                'name' => 'Family Feast',
                'code' => 'FF',
                'type' =>'number_of_items_validation',
                'size'=> 'medium',
                'value' =>4,
                'price_type' => 'fixed',
                'price_value' => '30',
                'description' => 'Four named medium pizzas just for £30',
                'is_active'=> 1,
            ],

            [
                'name' => 'Two Large',
                'code' => '2L',
                'type' =>'number_of_items_validation',
                'size'=> 'large',
                'value' =>2,
                'price_type' => 'fixed',
                'price_value' => '25',
                'description' => 'Two named large pizzas for £25',
                'is_active'=> 1,
            ],
            [
                'name' => 'Two Medium',
                'code' => '2M',
                'type' =>'number_of_items_validation',
                'size'=> 'medium',
                'value' =>2,
                'price_type' => 'fixed',
                'price_value' => '18',
                'description' => 'Two named medium pizzas for £18',
                'is_active'=> 1,
            ],
            [
                'name' => 'Two Small',
                'code' => '2S',
                'type' =>'number_of_items_validation',
                'size'=> 'small',
                'value' =>2,
                'price_type' => 'fixed',
                'price_value' => '12',
                'description' => 'Two named small pizzas for £12',
                'is_active'=> 1,
            ],
            ];
            
            foreach ($deals as $deal) {
                \App\Models\Deal::create($deal);
            }

}
}