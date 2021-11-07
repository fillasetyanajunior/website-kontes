@extends('layouts.layouts_email')
@section('content')
<td width="4" height="4" style="background:url({{url("assets//email/shadow-left-top.png")}}) no-repeat 100% 0;">
    <p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p>
</td>
<td colspan="3" rowspan="3" bgcolor="#f0f2ea" style="padding:0 0 30px;">
    <!-- begin content -->
    <img src="{{url('assets/email/bg1.png')}}" width="600" height="400"
        alt="summer‘s coming trimm your sheeps" style="display:block; border:0; margin:0 0 44px; background:#eeeeee;">
    <p
        style="margin:0 30px 33px; text-align:center; text-transform:uppercase; font-size:24px; line-height:30px; font-weight:bold; color:#484a42;">
        Email Code Discount
    </p>
    <p
        style="margin:0 30px 33px; text-align:left; text-transform:capitalize; font-size:14px; line-height:30px; font-weight:bold; color:#484a42;">
        The code below is only used once:
    </p>
    <p
        style="margin:0 30px 25px; text-align:left; text-transform:capitalize; font-size:14px; line-height:30px; color:#484a42;">
        here is the code we share:
    </p>
    <br>
    <table style="margin:0 30px 33px; width: 90%;margin-bottom: 1rem;color: #212529; border-collapse: collapse;">
        <tbody>
            <tr>
                <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                    <p style="font-size:16px; color:#333333; ">Code Discount</p>
                </td>
            </tr>
            @php
                $code = DB::table('codes')->get();
            @endphp
            @foreach ($code as $itemcode)
            <tr>
                <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                    <p style="font-size:16px; color:#333333; ">{{$itemcode->code}}</p>
                </td>
                <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                    <p style="font-size:16px; color:#333333; ">{{$itemcode->choices}}</p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection