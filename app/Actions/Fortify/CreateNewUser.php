<?php

namespace App\Actions\Fortify;

use App\Models\Customer;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'role' => ['required'],
        ])->validate();

        if ($input['role'] == 1) {
            $role = "worker";
        } else {
            $role = "customer";
        }

        $id = User::create([
            'name'              => $input['name'],
            'email'             => $input['email'],
            'password'          => Hash::make($input['password']),
            'role'              => $role,
            'avatar'            => 'default.jpg',
            'messenger_color'   => '#2180f3',
        ]);

        $location = geoip()->getLocation($_SERVER['REMOTE_ADDR']);

        if ($input['role'] == 1) {
            $no = Worker::orderBy('worker_id', 'DESC')->first();
            if ($no == null) {
                $idworker = 'WRKS0001';
            } else {
                $nama = substr($no->worker_id, 5, 4);
                $tambah = (int) $nama + 1;
                if (strlen($tambah) == 1) {
                    $idworker = 'WRKS' . "000" . $tambah;
                } elseif (strlen($tambah) == 2) {
                    $idworker = 'WRKS' . "00" . $tambah;
                } elseif (strlen($tambah) == 3) {
                    $idworker = 'WRKS' . "0" . $tambah;
                } else {
                    $idworker = 'WRKS' . $tambah;
                }
            }

            Worker::create([
                'user_id'           => $id->id,
                'worker_id'         => $idworker,
                'name'              => $input['name'],
                'email'             => $input['email'],
                'status_account'    => 'unverified',
                'avatar'            => 'default.jpg',
                'location'          => $location->country . ',' . $location->city . ',' . $location->state_name,
            ]);

        }else{
            $no = Customer::orderBy('customer_id', 'DESC')->first();
            if ($no == null) {
                $idcustomer = 'CUS-0001';
            } else {
                $nama = substr($no->customer_id, 5, 4);
                $tambah = (int) $nama + 1;
                if (strlen($tambah) == 1) {
                    $idcustomer = 'CUS-' . "000" . $tambah;
                } elseif (strlen($tambah) == 2) {
                    $idcustomer = 'CUS-' . "00" . $tambah;
                } elseif (strlen($tambah) == 3) {
                    $idcustomer = 'CUS-' . "0" . $tambah;
                } else {
                    $idcustomer = 'CUS-' . $tambah;
                }
            }

            Customer::create([
                'user_id'       => $id->id,
                'customer_id'   => $idcustomer,
                'name'          => $input['name'],
                'email'         => $input['email'],
                'avatar'            => 'default.jpg',
            ]);
        }
        return $id;
    }
}
