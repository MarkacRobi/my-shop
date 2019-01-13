<?php

use Illuminate\Database\Seeder;
use App\Item;
use App\Rating;


class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = Item::create([
            'title' => 'Women\'s Blouse',
            'body' => 'Best Blouse ever!',
            'price' => '16.00',
            'user_id' => '2',
            'item_image' => '1.jpg',
        ]);
        $rating = new Rating();
        $rating->item_id = $item->id;
        $rating->save();

        $item = Item::create([
            'title' => 'Men\'s Plain Tshirt',
            'body' => 'Best Tshirt ever!',
            'price' => '5.00',
            'user_id' => '2',
            'item_image' => '2.jpg',
        ]);
        $rating = new Rating();
        $rating->item_id = $item->id;
        $rating->save();

        $item = Item::create([
            'title' => 'Men\'s Plain Tshirt',
            'body' => 'Best Tshirt ever!',
            'price' => '10.00',
            'user_id' => '2',
            'item_image' => '3.jpg',
        ]);
        $rating = new Rating();
        $rating->item_id = $item->id;
        $rating->save();

        $item = Item::create([
            'title' => 'Men\'s Plain Tshirt',
            'body' => 'Best Tshirt ever!',
            'price' => '12.00',
            'user_id' => '2',
            'item_image' => '4.jpg',
        ]);
        $rating = new Rating();
        $rating->item_id = $item->id;
        $rating->save();
    }
}
