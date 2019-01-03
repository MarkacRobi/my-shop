<?php

use Illuminate\Database\Seeder;
use App\Item;


class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Item::create([
            'title' => 'Women\'s Blouse',
            'body' => 'Best Blouse ever!',
            'price' => '16.00',
            'user_id' => '2',
            'item_image' => 'http://bestjquery.com/tutorial/product-grid/demo9/images/img-1.jpg',
        ]);
        Item::create([
            'title' => 'Men\'s Plain Tshirt',
            'body' => 'Best Tshirt ever!',
            'price' => '5.00',
            'user_id' => '2',
            'item_image' => 'http://bestjquery.com/tutorial/product-grid/demo9/images/img-3.jpg',
        ]);
        Item::create([
            'title' => 'Men\'s Plain Tshirt',
            'body' => 'Best Tshirt ever!',
            'price' => '10.00',
            'user_id' => '2',
            'item_image' => 'http://bestjquery.com/tutorial/product-grid/demo9/images/img-5.jpg',
        ]);
        Item::create([
            'title' => 'Men\'s Plain Tshirt',
            'body' => 'Best Tshirt ever!',
            'price' => '12.00',
            'user_id' => '2',
            'item_image' => 'http://bestjquery.com/tutorial/product-grid/demo9/images/img-7.jpg',
        ]);
    }
}
