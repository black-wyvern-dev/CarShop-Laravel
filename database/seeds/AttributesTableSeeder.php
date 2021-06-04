<?php

use Illuminate\Database\Seeder;

class AttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Attribute::create(['slug' =>'make', 'name' => 'Make']);
        \App\Attribute::create(['slug' =>'model', 'name' => 'Model']);
        \App\Attribute::create(['slug' =>'body', 'name' => 'Body']);
        \App\Attribute::create(['slug' =>'odometer', 'name' => 'Odometer']);
        \App\Attribute::create(['slug' =>'miles/kms', 'name' => 'Miles/kms']);
        \App\Attribute::create(['slug' =>'fuel-type', 'name' => 'Fuel type']);
        \App\Attribute::create(['slug' =>'engine', 'name' => 'Engine']);
        \App\Attribute::create(['slug' =>'year', 'name' => 'Year']);
        \App\Attribute::create(['slug' =>'price', 'name' => 'Price']);
        \App\Attribute::create(['slug' =>'fuel-consumption', 'name' => 'Fuel consumption']);
        \App\Attribute::create(['slug' =>'transmission', 'name' => 'Transmission']);
        \App\Attribute::create(['slug' =>'drive', 'name' => 'Drive']);
        \App\Attribute::create(['slug' =>'fuel-economy', 'name' => 'Fuel economy']);
        \App\Attribute::create(['slug' =>'exterior-color', 'name' => 'Exterior Color']);
        \App\Attribute::create(['slug' =>'interior-color', 'name' => 'Interior Color']);
        \App\Attribute::create(['slug' =>'upholstery', 'name' => 'Upholstery']);
        \App\Attribute::create(['slug' =>'steering', 'name' => 'Steering']);


    }
}
