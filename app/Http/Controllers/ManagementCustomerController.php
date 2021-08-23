<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class ManagementCustomerController extends Controller
{
    public function index()
    {
        $data['customer'] = Customer::paginate(20);
        return view('admin.customer.customer', $data);
    }
    public function DeleteAccount(Customer $customer)
    {
        Customer::destroy($customer->id);
        User::where('id', $customer->user_id)->delete();
        return redirect()->back()->with('status', 'Account' . $customer->name . 'Berhsil Di Hapus');
    }
}
