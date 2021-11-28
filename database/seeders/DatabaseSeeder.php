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
            'phone'             => '6285157163319@c.us',
            'kodenegara'        => '62',
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
            'phone'             => '6285157163319@c.us',
            'kodenegara'        => '62',
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
            'phone'             => '6285157163319@c.us',
            'kodenegara'        => '62',
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
            'phone'             => '6285157163319@c.us',
            'kodenegara'        => '62',
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
            'phone'             => '6285157163319@c.us',
            'kodenegara'        => '62',
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
                'name'          => '10 Days',
                'description'   => 'wadawdaawdesfrdgd',
                'harga'         => 30,
                'hari'          => 10,
                'icon'          => '10days.png',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Designer Pro',
                'description'   => 'sseftessfjyjgh',
                'harga'         => 100,
                'hari'          => 0,
                'icon'          => 'designerpro.png',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => '20 Days',
                'description'   => 'sseftessfjyjgh',
                'harga'         => 100,
                'hari'          => 20,
                'icon'          => '20days.png',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Guaranteed',
                'description'   => 'sseftessfjyjgh',
                'harga'         => 0,
                'hari'          => 0,
                'icon'          => 'guaranteedtoworker.png',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Non Disclosure Agreement (NDA)',
                'description'   => 'sseftessfjyjgh',
                'harga'         => 10,
                'hari'          => 0,
                'icon'          => 'nda.png',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Urgent',
                'description'   => 'sseftessfjyjgh',
                'harga'         => 10,
                'hari'          => -1,
                'icon'          => 'urgent.png',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
            [
                'name'          => 'Extended',
                'description'   => 'sseftessfjyjgh',
                'harga'         => 5,
                'hari'          => 1,
                'icon'          => 'extended.png',
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
            KodeNegara::class,
            ColorCodeSeeder::class,
        ]);
    }
}
