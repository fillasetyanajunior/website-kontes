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
            'messenger_color'   => '#2180f3',
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
            'messenger_color'   => '#2180f3',
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
            'messenger_color'   => '#2180f3',
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
            'messenger_color'   => '#2180f3',
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
            'messenger_color'   => '#2180f3',
            'avatar'            => 'default.jpg',
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
        DB::table('customers')->insert([
            'user_id'           => 4,
            'customer_id'       => 'CUS-0002',
            'name'              => 'Customer2',
            'email'             => 'customer2@customer.com',
            'avatar'            => 'default.jpg',
        ]);
        DB::table('workers')->insert([
            'user_id'           => 3,
            'worker_id'         => 'WKRS0001',
            'name'              => 'Worker',
            'email'             => 'worker@worker.com',
            'description'       => 'asdwaw',
            'location'          => '-',
            'avatar'            => 'default.jpg',
            'paypal'            => 265156984,
            'status_account'    => 'verified',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);
        DB::table('workers')->insert([
            'user_id'           => 5,
            'worker_id'         => 'WKRS0002',
            'name'              => 'Worker2',
            'email'             => 'worker2@worker.com',
            'description'       => 'asdwaw',
            'location'          => '-',
            'avatar'            => 'default.jpg',
            'paypal'            => 265156984,
            'status_account'    => 'verified',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        $catagories = [
            [
                'name'          => 'Logo Desain',
                'icon'          => '-',
                'harga'         => '60',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Web Desain',
                'icon'          => '-',
                'harga'         => '80',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];
        $sortcatagories = [
            [
                'name'          => 'Logo Desain',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Web Desain',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Direct Project',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];
        $subcatagories = [
            [
                'catagori_id' => '1',
                'name'          => 'Logo Desain 1',
                'icon'          => '-',
                'description'   => 'wadawdaawdesfrdgd',
                'harga'         => '600',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'catagori_id' => '2',
                'name'          => 'Web Desain 1',
                'icon'          => '-',
                'description'   => 'sseftessfjyjgh',
                'harga'         => '800',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];
        $job = [
            [
                'name'          => 'Multimedia',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Web Upgrade',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];
        $opsi = [
            [
                'name'          => 'Paket 1',
                'description'   => 'wadawdaawdesfrdgd',
                'harga'         => '300',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'PAket 2',
                'description'   => 'sseftessfjyjgh',
                'harga'         => '500',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];
        $opsiupgrade = [
            [
                'name'          => '7 Hari',
                'description'   => 'wadawdaawdesfrdgd',
                'harga'         => '30',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Desainer Pro',
                'description'   => 'sseftessfjyjgh',
                'harga'         => '100',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];
        DB::table('catagories')->insert($catagories);
        DB::table('sort_catagories')->insert($sortcatagories);
        DB::table('sub_catagories')->insert($subcatagories);
        DB::table('opsi_packages')->insert($opsi);
        DB::table('opsi_package_upgrades')->insert($opsiupgrade);
        DB::table('job_catagories')->insert($job);

        $this->call([
            IconSeeder::class,
        ]);
    }
}
