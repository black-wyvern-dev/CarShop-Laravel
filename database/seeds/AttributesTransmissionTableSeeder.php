<?php

use Illuminate\Database\Seeder;

class AttributesTransmissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\AttributeList::create(['attributeID'=>11, 'name'=>'Manual']);
        \App\AttributeList::create(['attributeID'=>11, 'name'=>'Automatic']);
        \App\AttributeList::create(['attributeID'=>11, 'name'=>'Semi Automatic']);
        \App\AttributeList::create(['attributeID'=>11, 'name'=>'Dual-clutch']);
        \App\AttributeList::create(['attributeID'=>11, 'name'=>'F1 Paddle']);
        \App\AttributeList::create(['attributeID'=>11, 'name'=>'Tiptronic']);
        \App\AttributeList::create(['attributeID'=>11, 'name'=>'Variomatic']);

    }
}
