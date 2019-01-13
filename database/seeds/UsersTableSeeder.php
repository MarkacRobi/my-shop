<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Adress;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'surname' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => null,
            'role' => 'ADMIN',
            'password' => bcrypt('admin'),
        ]);

        User::create([
            'name' => 'robi',
            'surname' => 'markac',
            'email' => 'robi@gmail.com',
            'phone' => '031666666',
            'role' => 'PRODAJALEC',
            'password' => bcrypt('123456'),
        ]);

        User::create([
            'name' => 'prodajalec',
            'surname' => 'prodajalec',
            'email' => 'prodajalec@gmail.com',
            'phone' => '031666665',
            'role' => 'PRODAJALEC',
            'password' => bcrypt('123456'),
        ]);


        $user1 = User::create([
            'name' => 'Pija',
            'surname' => 'Brglez',
            'email' => 'pija@gmail.com',
            'phone' => '031666664',
            'role' => 'STRANKA',
            'password' => bcrypt('123456'),
        ]);

        $adress = new Adress();
        $adress->city = 'Ljubljana';
        $adress->post_number = '1000';
        $adress->street = 'Slovenska ulica';
        $adress->street_number = '7';
        $adress->user_id = $user1->id;
        $adress->save();

        $user2 = User::create([
            'name' => 'stranka',
            'surname' => 'stranka',
            'email' => 'stranka@gmail.com',
            'phone' => '031666663',
            'role' => 'STRANKA',
            'password' => bcrypt('123456'),
        ]);

        $adress = new Adress();
        $adress->city = 'Maribor';
        $adress->post_number = '2000';
        $adress->street = 'Lazarjeva ulica';
        $adress->street_number = '5';
        $adress->user_id = $user2->id;
        $adress->save();

    }
}
