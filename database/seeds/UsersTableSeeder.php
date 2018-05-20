<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Admin User
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'user_type' => 'admin',
            'password' => bcrypt('admin'),
            'remember_token' => str_random(10)
        ]);

        //Products
        $products = factory(App\Product::class, 10)->create();

        //Public Users
        $users = factory(App\User::class, 9)
            ->create()
            ->each(function($u) {
                $u->bids()->saveMany(factory(App\Bid::class, 1)->make());
            });
    }
}
