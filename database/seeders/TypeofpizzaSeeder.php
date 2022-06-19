<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeofpizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeofpizza = [
            [
                'name'=>'Original',
                'description'=>'Easy, crispy, and delicious, this vegetarian onion pizza is a real treat for any pizza lover. The soft marinated onions release their sweetness in the oven pairing beautifully with creamy mozzarella and savory olives.',

                'ingredients'=>'Contains cheese, tomato sauce along with few other toppings',
                'image'=>'',
                'is_active'=>true,
            ],
       
            [
                'name'=>'Gimme the Meat',
                'description'=>'Pepperoni pizza is an American pizza variety which includes 
                one of the countrys most beloved toppings. Pepperoni is actually a 
                corrupted form of peperoni, 
                which denotes a large pepper in Italian, but nowadays it denotes a 
                spicy salami, usually made with a mixture of beef, pork, and spices',

                'ingredients'=>'Contains Pepperoni, ham, chicken, minced beef, sausage, bacon',
                'image'=>'',
                'is_active'=>true,
            ],
         
            [
                'name'=>'Veggie Delight',
                'description'=>'Hot, cheesy pizza loaded with your favorite veggies is one of the most fun and easy dinners to order',
                'ingredients'=>'Contains Onions, green peppers, mushrooms, sweetcorn',
                'image'=>'',
                'is_active'=>true,
            ],
           
            [
                'name'=>'Make Mine Hot',
                'description'=>'Really delicious pizza which is loaded with your favorite toppings specially made for you',
                'ingredients'=>'Contains Chicken, onions, green peppers, jalapeno peppers',
                'image'=>'',
                'is_active'=>true,
            ],
            [
                'name'=>'Create Your Own Pizza',
                'description'=>'Now you can create your own pizza with your favorite toppings',
                'ingredients'=>'Contains Cheese, tomato sauce along with your selected toppings',
                'image'=>'',
                'is_active'=>true,
            ],
            

        ];

        foreach ($typeofpizza as $typeofpizza) {
            \App\Models\Typeofpizza::create($typeofpizza);
        }
    }
}
