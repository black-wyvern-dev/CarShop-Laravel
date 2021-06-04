<?php

use Illuminate\Database\Seeder;

class AttributesFuelTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\AttributeList::create(['attributeID'=>6, 'name'=>'Petrol']);
        \App\AttributeList::create(['attributeID'=>6, 'name'=>'Diesel']);
        \App\AttributeList::create(['attributeID'=>6, 'name'=>'LPG']);
        \App\AttributeList::create(['attributeID'=>6, 'name'=>'Bi Fuell']);
        \App\AttributeList::create(['attributeID'=>6, 'name'=>'Electric']);
        \App\AttributeList::create(['attributeID'=>6, 'name'=>'Hybrid']);

    }
}
