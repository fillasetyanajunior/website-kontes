<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap');
    </style>
    <title></title>
</head>

<body
    style="font-family: 'Roboto Condensed', sans-serif; background-color:#f0f2ea; margin:0; padding:0; color:#333333;">
    <table width="100%" bgcolor="#ffffff" cellpadding="0" cellspacing="0" border="0">
        <tbody>
            <tr>
                <td style="padding:40px 0;">
                    <!-- begin main block -->
                    <table cellpadding="0" cellspacing="0" width="608" border="0" align="center">
                        <tbody>
                            <tr>
                                <td>
                                    <a href="{{url('/')}}"
                                        style="display:block; width:407px; height:100px; margin:0 auto 30px;">
                                        <img src="{{url('assets/utama/img/logo/Logo.jpg')}}" width="407" height="100"
                                            alt="Pixelbuddha" style="display:block; border:0; margin:0;">
                                    </a>
                                    {{-- <p style="margin:0 0 36px; text-align:center; font-size:14px; line-height:20px; text-transform:uppercase; color:#626658;">
                                    what is the most fascinating thing about summer?
                                </p> --}}
                                    <!-- begin wrapper -->
                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td width="8" height="4" colspan="2"
                                                    style="background:url({{url("assets/email/shadow-top-left.png")}}) no-repeat 100% 100%;">
                                                    <p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p>
                                                </td>
                                                <td height="4"
                                                    style="background:url({{url("assets//email/shadow-top-center.png")}}) repeat-x 0 100%;">
                                                    <p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p>
                                                </td>
                                                <td width="8" height="4" colspan="2"
                                                    style="background:url({{url("assets//email/shadow-top-right.png")}}) no-repeat 0 100%;">
                                                    <p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p>
                                                </td>
                                            </tr>

                                            <tr>
                                                @yield('content')
                                                <p
                                                    style="margin:0; border-top:2px solid #e5e5e5; font-size:5px; line-height:5px; margin:0 30px 20px;">
                                                    &nbsp;</p>
                                                {{-- <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tbody>
                                                        <tr valign="top">
                                                            <td width="30">
                                                                <p style="margin:0; font-size:1px; line-height:1px;">
                                                                    &nbsp;</p>
                                                            </td>
                                                            <td>
                                                                <p
                                                                    style="margin:0 0 4px; font-weight:bold; color:#333333; font-size:14px; line-height:22px;">
                                                                    Bookwisata Indonesia</p>
                                                                <p
                                                                    style="margin:0; color:#333333; font-size:11px; line-height:18px;">
                                                                    Jl. Wonosari Km.7 Brojogaten Gg. Sukun No. 36
                                                                    Banguntapan Bantul Daerah Istimewa
                                                                    Yogyakarta,Indonesia. P: 24/7 <br>
                                                                    Help &amp; customer support: +62 274 - 443165 | WA.
                                                                    +62 81 5791 3168 | E: info@bookwisata.com<br>
                                                                    Website: <a href="{{url('/')}}"
                                                                        style="color:#6d7e44; text-decoration:none; font-weight:bold;">www.Bookwisata.com</a>
                                                                </p>
                                                            </td>
                                                            <td width="150">
                                                                <p style="margin:0; font-size:1px; line-height:1px;">
                                                                    &nbsp;</p>
                                                            </td>
                                                            <td width="120">
                                                                <a href="https://www.facebook.com/pixelbuddha"
                                                                    style="float:left; width:24px; height:24px; margin:6px 8px 10px 0;">
                                                                    <img src="{{url("assets/email/facebook.png")}}"
                                                                        width="24" height="24" alt="facebook"
                                                                        style="display:block; margin:0; border:0; background:#eeeeee;">
                                                                </a>
                                                                <a href="https://twitter.com/PixelBuddha"
                                                                    style="float:left; width:24px; height:24px; margin:6px 8px 10px 0;">
                                                                    <img src="{{url("assets/email/twitter.png")}}"
                                                                        width="24" height="24" alt="twitter"
                                                                        style="display:block; margin:0; border:0; background:#eeeeee;">
                                                                </a>
                                                                <a href="http://blog.pixelbuddha.net/"
                                                                    style="float:left; width:24px; height:24px; margin:6px 8px 10px 0;;">
                                                                    <img src="{{url("assets/email/tumblr.png")}}"
                                                                        width="24" height="24" alt="tumblr"
                                                                        style="display:block; margin:0; border:0; background:#eeeeee;">
                                                                </a>
                                                                <a href="{{url('/')}}rss"
                                                                    style="float:left; width:24px; height:24px; margin:6px 0 10px 0;">
                                                                    <img src="{{url("assets/email/rss.png")}}"
                                                                        width="24" height="24" alt="rss"
                                                                        style="display:block; margin:0; border:0; background:#eeeeee;">
                                                                </a>
                                                                <p
                                                                    style="margin:0; font-weight:bold; clear:both; font-size:12px; line-height:22px;">
                                                                    <a href="{{url('/')}}"
                                                                        style="color:#6d7e44; text-decoration:none;">Visit
                                                                        website</a><br>
                                                                    <a href="{{url('/')}}"
                                                                        style="color:#6d7e44; text-decoration:none;">Mobile
                                                                        version</a>
                                                                </p>
                                                            </td>
                                                            <td width="30">
                                                                <p style="margin:0; font-size:1px; line-height:1px;">
                                                                    &nbsp;</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table> --}}
                                                <!-- end content -->
                                </td>
                                <td width="4" height="4"
                                    style="background:url({{url("assets/email/shadow-right-top.png")}}) no-repeat 0 0;">
                                    <p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p>
                                </td>
                            </tr>

                            <tr>
                                <td width="4"
                                    style="background:url({{url("assets/email/shadow-left-center.png")}}) repeat-y 100% 0;">
                                    <p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p>
                                </td>
                                <td width="4"
                                    style="background:url({{url("assets/email/shadow-right-center.png")}}) repeat-y 0 0;">
                                    <p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p>
                                </td>
                            </tr>

                            <tr>
                                <td width="4" height="4"
                                    style="background:url({{url("assets/email/shadow-left-bottom.png")}}) repeat-y 100% 100%;">
                                    <p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p>
                                </td>
                                <td width="4" height="4"
                                    style="background:url({{url("assets/email/shadow-right-bottom.png")}}) repeat-y 0 100%;">
                                    <p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p>
                                </td>
                            </tr>

                            <tr>
                                <td width="4" height="4"
                                    style="background:url({{url("assets/email/shadow-bottom-corner-left.png")}}) no-repeat 100% 0;">
                                    <p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p>
                                </td>
                                <td width="4" height="4"
                                    style="background:url({{url("assets/email/shadow-bottom-left.png")}}) no-repeat 100% 0;">
                                    <p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p>
                                </td>
                                <td height="4"
                                    style="background:url({{url("assets/email/shadow-bottom-center.png")}}) repeat-x 0 0;">
                                    <p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p>
                                </td>
                                <td width="4" height="4"
                                    style="background:url({{url("assets/email/shadow-bottom-right.png")}}) no-repeat 0 0;">
                                    <p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p>
                                </td>
                                <td width="4" height="4"
                                    style="background:url({{url("assets/email/shadow-bottom-corner-right.png")}}) no-repeat 0 0;">
                                    <p style="margin:0; font-size:1px; line-height:1px;">&nbsp;</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- end wrapper-->
                    <p
                        style="margin:0; padding:34px 0 0; text-align:center; font-size:11px; line-height:13px; color:#333333;">
                        Don‘t want to recieve further emails? You can unsibscribe <a href="{{url('/')}}"
                            style="color:#333333; text-decoration:underline;">here</a>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- end main block -->
    </td>
    </tr>
    </tbody>
    </table>
</body>

</html>
