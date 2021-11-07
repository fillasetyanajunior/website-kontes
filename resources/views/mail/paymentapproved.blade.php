@extends('layouts.layouts_email')
@section('content')
<td width="4" height="4" style="background:url({{url("assets//email/shadow-left-top.png")}}) no-repeat 100% 0;">
    <p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p>
</td>
@php
    $project = DB::table('projects')->where('id',$id)->first();
    $wallets = DB::table('detail_projects')->where('contest_id',$id)->first();

    if ($project->catagories_project == 'catagories') {
        $discon = (15/100) * $project->harga;
        $total  = $project->harga - 40 - $discon;
        $totalwallet = $harga - $discon;
    } else {
        $walletbid = explode('/'.$wallets->description);
        $discon = (15/100) * $walletbid[2];
        $totalwallet  = $walletbid[2] - $discon;
    }

@endphp
<td colspan="3" rowspan="3" bgcolor="#f0f2ea" style="padding:0 0 30px;">
    <!-- begin content -->
    <img src="{{url('assets/email/bg1.png')}}" width="600" height="400"
        alt="summer‘s coming trimm your sheeps" style="display:block; border:0; margin:0 0 44px; background:#eeeeee;">
    <p
        style="margin:0 30px 33px; text-align:center; text-transform:uppercase; font-size:24px; line-height:30px; font-weight:bold; color:#484a42;">
        Email Handover Confirm And Payment Approved
    </p>
    <p
        style="margin:0 30px 33px; text-align:left; text-transform:capitalize; font-size:14px; line-height:30px; font-weight:bold; color:#484a42;">
        the handover has been confirmed successfully and we will immediately send the payment to you
    </p>
    <p
        style="margin:0 30px 25px; text-align:left; text-transform:capitalize; font-size:14px; line-height:30px; color:#484a42;">
        Here are the payment details that we will send from the contest {{$project->name}}.
    </p>
    <br>
    <table style="margin:0 30px 33px; width: 90%;margin-bottom: 1rem;color: #212529; border-collapse: collapse;">
        <tbody>
            <tr>
                <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                    <p style="font-size:16px; color:#333333; ">Total Wallet</p>
                </td>
                <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                    <p style="font-size:16px; color:#333333; ">{{$totalwallet}}</p>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
