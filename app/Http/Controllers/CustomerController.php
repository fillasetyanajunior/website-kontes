<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function profileCustomers()
    {
        $data['title']      = 'Customer Profile';
        $data['customer']   = Customer::where('user_id', request()->user()->id)->first();
        return view('customer.profile', $data);
    }
    public function profileUpdate(Request $request, Customer $customer)
    {
        if ($request->hasfile('avatar')) {

            if ($customer->avatar != null) {
                Storage::delete('profile/' . $customer->avatar);
            }

            $file = $request->file('avatar');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('profile', $name);

            Customer::where('id', $customer->id)
                ->update([
                    'name'      => $request->name,
                    'email'     => $request->email,
                    'tagline'   => $request->tagline,
                    'aboutme'   => $request->aboutme,
                    'avatar'    => $name,
                ]);
            User::where('id', $customer->user_id)
                ->update([
                    'name'      => $request->name,
                    'email'     => $request->email,
                    'avatar'    => $name,
                ]);
        } else {
            Customer::where('id', $customer->id)
                ->update([
                    'name'      => $request->name,
                    'email'     => $request->email,
                    'tagline'   => $request->tagline,
                    'aboutme'   => $request->aboutme,
                ]);
            User::where('id', $customer->user_id)
                ->update([
                    'name'  => $request->name,
                    'email' => $request->email,
                ]);
        }

        return redirect()->back()->with('status', 'Profile Berhasil Di Update');
    }
}
