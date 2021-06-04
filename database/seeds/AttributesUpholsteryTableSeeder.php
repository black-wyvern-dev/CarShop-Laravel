<?php

use Illuminate\Database\Seeder;

class AttributesUpholsteryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\AttributeList::create(['attributeID'=>16, 'name'=>'Cloth']);
        \App\AttributeList::create(['attributeID'=>16, 'name'=>'Leather']);
        \App\AttributeList::create(['attributeID'=>16, 'name'=>'Leather and cloth']);
        \App\AttributeList::create(['attributeID'=>16, 'name'=>'Leatherette']);
        \App\AttributeList::create(['attributeID'=>16, 'name'=>'Mohair']);
        \App\AttributeList::create(['attributeID'=>16, 'name'=>'Other']);
        \App\AttributeList::create(['attributeID'=>16, 'name'=>'Pullman']);
        \App\AttributeList::create(['attributeID'=>16, 'name'=>'Skai']);
        \App\AttributeList::create(['attributeID'=>16, 'name'=>'Vinyl']);
        \App\AttributeList::create(['attributeID'=>16, 'name'=>'Vinyl and cloth']);
    }
}
