<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        DB::table('users')->insert([
            'name'              => 'Admin',
            'email'             => 'admin@admin.com',
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make("12345678"),
            'role'              => 'admin',
            'avatar'            => 'default.jpg',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name'              => 'Customer',
            'email'             => 'customer@customer.com',
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make("12345678"),
            'role'              => 'customer',
            'avatar'            => 'default.jpg',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name'              => 'Worker',
            'email'             => 'worker@worker.com',
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make("12345678"),
            'role'              => 'worker',
            'avatar'            => 'default.jpg',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name'              => 'Customer2',
            'email'             => 'customer2@customer.com',
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make("12345678"),
            'role'              => 'customer',
            'avatar'            => 'default.jpg',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name'              => 'Worker2',
            'email'             => 'worker2@worker.com',
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make("12345678"),
            'role'              => 'worker',
            'avatar'            => 'default.jpg',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);
        DB::table('workers')->insert([
            'user_id'           => 3,
            'worker_id'         => 'WKRS0001',
            'name'              => 'Worker',
            'email'             => 'worker@worker.com',
            'avatar'            => 'default.jpg',
            'description'       => 'asdwaw',
            'paypal'            => 265156984,
            'status_account'    => 'verified',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);
        DB::table('customers')->insert([
            'user_id'           => 2,
            'customer_id'       => 'CUS-0001',
            'name'              => 'Customer',
            'email'             => 'customer@customer.com',
            'avatar'            => 'default.jpg',
        ]);
        DB::table('workers')->insert([
            'user_id'           => 5,
            'worker_id'         => 'WKRS0002',
            'name'              => 'Worker2',
            'email'             => 'worker2@worker.com',
            'avatar'            => 'default.jpg',
            'description'       => 'asdwaw',
            'paypal'            => 265156984,
            'status_account'    => 'verified',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);
        DB::table('customers')->insert([
            'user_id'           => 4,
            'customer_id'       => 'CUS-0002',
            'name'              => 'Customer2',
            'email'             => 'customer2@customer.com',
            'avatar'            => 'default.jpg',
        ]);
    }
}
