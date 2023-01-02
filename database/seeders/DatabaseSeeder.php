<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::create([
        //     'name' => 'Test User',
        //     'email' => 'abc@abc.com',
        //     'password' => \Illuminate\Support\Facades\Hash::make('123456')
        // ]);
        // DB::table('order_statuses')->insert([
        //     ['name' => 'Placed'],
        //     ['name' => 'Prepared'],
        //     ['name' => 'On the way'],
        //     ['name' => 'Delivered']
        // ]);
        DB::table('settings')->insert([
            'delivery_fee' => 50,
            'gst_percentage' => 10,
        ]);
    }
}
