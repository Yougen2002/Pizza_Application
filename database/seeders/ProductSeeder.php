<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = [
            [
                'typeofpizza_id' => 1,

                'size' => 'small',
                'price' => 8.00,
                'description' => 'Contains cheese, tomato sauce along with few other toppings',
                'image' => '/images/pizza34.jpg',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,

            ],
            [
                'typeofpizza_id' => 1,

                'size' => 'medium',
                'price' => 9.00,
                'description' => 'Contains cheese, tomato sauce along with few other toppings',
                'image' => '/images/pizza34.jpg',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
            ],

            [
                'typeofpizza_id' => 1,

                'size' => 'large',
                'price' => 11.00,
                'description' => 'Contains cheese, tomato sauce along with few other toppings',
                'image' => '/images/pizza34.jpg',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
            ],

            [
                'typeofpizza_id' => 2,
                'size' => 'small',
                'price' => 11.00,
                'description' => 'contains Pepperoni, ham, chicken, minced beef, sausage, bacon',
                'image' => '/images/pizza23.jpg',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
            ],
            [
                'typeofpizza_id' => 2,

                'size' => 'medium',
                'price' => 14.50,
                'description' => 'Contains Pepperoni, ham, chicken, minced beef, sausage, bacon',
                'image' => '/images/pizza23.jpg',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
            ],
            [
                'typeofpizza_id' => 2,

                'size' => 'large',
                'price' => 16.50,
                'description' => 'Contains Pepperoni, ham, chicken, minced beef, sausage, bacon',
                'image' => '/images/pizza23.jpg',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
            ],
            [
                'typeofpizza_id' => 3,

                'size' => 'small',
                'price' => 10.00,
                'description' => 'Contains Onions, green peppers, mushrooms, sweetcorn',
                'image' => '/images/pizza56.jpg',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
            ],
            [
                'typeofpizza_id' => 3,
                'size' => 'medium',
                'price' => 13.00,
                'description' => 'Contains Onions, green peppers, mushrooms, sweetcorn',
                'image' => '/images/pizza56.jpg',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
            ],
            [
                'typeofpizza_id' => 3,
                'size' => 'large',
                'price' => 15.00,
                'description' => 'Contains Onions, green peppers, mushrooms, sweetcorn',
                'image' => '/images/pizza56.jpg',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
            ],
            [
                'typeofpizza_id' => 4,
                'size' => 'small',
                'price' => 11.00,
                'description' => 'Contains Chicken, onions, green peppers, jalapeno peppers',
                'image' => '/images/pizza45.jpg',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
            ],
            [
                'typeofpizza_id' => 4,
                'size' => 'medium',
                'price' => 13.00,
                'description' => 'Contains Chicken, onions, green peppers, jalapeno peppers',
                'image' => '/images/pizza45.jpg',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
            ],
            [
                'typeofpizza_id' => 4,
                'size' => 'large',
                'price' => 15.00,
                'description' => 'Contains Chicken, onions, green peppers, jalapeno peppers',
                'image' => '/images/pizza45.jpg',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
            ],
            //13
            [
                'typeofpizza_id' => 5,
                'size' => 'small',
                'price' => 8.00,
                'description' => 'Make your own small pizza',
                'image' => '/images/pizza2.jpg',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
            ],
             //14
            [
                'typeofpizza_id' => 5,
                'size' => 'medium',
                'price' => 9.00,
                'description' => 'Make your own medium pizza',
                'image' => '/images/pizza2.jpg',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
            ],
             //15
            [
                'typeofpizza_id' => 5,
                'size' => 'large',
                'price' => 11.00,
                'description' => 'Make your own large pizza',
                'image' => '/images/pizza2.jpg',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
            ],
        ];

        foreach ($product as $product) {
            \App\Models\Product::create($product);
        }
    }
}
