<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModeofDeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modeofDelivery = [ 
            [
                'name' => 'Delivery',
                'description' => 'Delivery',
                'image' => '',
                'is_active' => 1,
            ],
            [
                'name' => 'Pickup',
                'description' => 'Pickup',
                'image' => '',
                'is_active' => 1,
            ],
          
        ];
        foreach ($modeofDelivery as $modeofDelivery ) {
            \App\Models\ModeofDelivery::create($modeofDelivery);
        }
    }
}
