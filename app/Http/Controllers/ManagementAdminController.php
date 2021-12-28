<?php

namespace App\Http\Controllers;

use App\Models\KodeTelponNegara;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ManagementAdminController extends Controller
{
    public function Admin()
    {
        $data['title'] = 'Management Admin';
        $data['admin'] = User::where('role','admin')->simplePaginate(20);
        $data['kodenegara'] = KodeTelponNegara::all();
        return view('admin.admin.admin',$data);
    }
    public function AdminStore(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => 'required', 'string',
            'phone' => ['required', 'numeric'],
        ]);

        $kodes = KodeTelponNegara::where('code', $request->kodenegara)->first();
        $kode = explode(' ', $kodes->code);
        if (count($kode) > 1) {
            $code = rand($kode[0], $kode[1]);
        } else {
            $code = $kodes->code;
        }

        User::create([
            'name'              => $request->name,
            'email'             => $request->email,
            'email_verified_at' => Carbon::now(),
            'password'          => Hash::make($request->password),
            'role'              => 'admin',
            'avatar'            => 'default.jpg',
            'phone'             => $code . $request->phone . '@c.us',
            'kodenegara'        => $request->kodenegara,
            'messenger_color'   => '#2180f3',
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        return redirect()->back()->with('status','Add Admin Success');
    }
    public function AdminEdit(User $user)
    {
        return response()->json([
            'user' => $user
        ]);
    }
    public function AdminUpdate(Request $request,User $user)
    {
        $kodes = KodeTelponNegara::where('code', $request->kodenegara)->first();
        $kode = explode(' ', $kodes->code);
        if (count($kode) > 1) {
            $code = rand($kode[0], $kode[1]);
        } else {
            $code = $kodes->code;
        }

        User::where('id',$user->id)
            ->update([
                'name'              => $request->name,
                'email'             => $request->email,
                'role'              => 'admin',
                'phone'             => $code . $request->phone . '@c.us',
                'kodenegara'        => $request->kodenegara,
        ]);

        return redirect()->back()->with('status', 'Update Admin Success');
    }
    public function AdminDelete(User $user)
    {
        User::destroy($user->id);
        return redirect()->back()->with('status', 'Delete Admin Success');
    }
}
