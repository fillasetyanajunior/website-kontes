<?php

namespace App\Actions\Fortify;

use App\Models\Customer;
use App\Models\EmailList;
use App\Models\KodeTelponNegara;
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
        // dd($input['kodenegara']);
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(EmailList::class),
            ],
            'password' => $this->passwordRules(),
            'role' => ['required'],
            'phone' => ['required','numeric'],
            'tos' => ['required'],
        ])->validate();

        if ($input['role'] == 1) {
            $role = "worker";
        } else {
            $role = "customer";
        }

        $kodes = KodeTelponNegara::where('code',$input['kodenegara'])->first();
        $kode = explode(' ',$kodes->code);
        if (count($kode) > 1) {
            $code = rand($kode[0], $kode[1]);
        } else {
            $code = $kodes->code;
        }


        $id = User::create([
            'name'              => $input['name'],
            'email'             => $input['email'],
            'password'          => Hash::make($input['password']),
            'role'              => $role,
            'avatar'            => 'default.jpg',
            'phone'             => $code . $input['phone'] . '@c.us',
            'kodenegara'        => $input['kodenegara'],
            'messenger_color'   => '#2180f3',
        ]);

        EmailList::create([
            'email' => $input['email'],
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
                'avatar'        => 'default.jpg',
                'location'      => $location->country . ',' . $location->city . ',' . $location->state_name,
            ]);
        }
        return $id;
    }
}
