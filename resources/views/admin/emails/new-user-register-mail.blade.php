<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center" style="border: 1px solid; border-color: #808052;">
    <tr>
        <td>
            @include('admin.emails.layouts.header')
            <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
                <tbody>
                    <tr>
                        <td style="text-align: center; font-size: 16px; padding-top: 20px;">
                            <p style="padding: 0px 10px;">Dear Admin</p>
                            <p style="padding: 0px 10px;"><strong><span style="color: #0378B5;">{{$first_name}} {{$last_name}}</span> registered in Avanis.</strong></p>
                            <p style="padding: 0px 10px;">To view the full detail of user please log in to your account dashboard and view details and verify this user.</p>
                            <p style="padding: 0px 10px;">If you’re having trouble clicking the "Log In" button, copy and paste the URL below into your web browser.</p>
                            <a href="{{$data['body']}}" style="text-decoration: none;"><span style="color: #0378B5">{{$data['body']}}</span></a>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center; padding: 15px;">
                            <a href="{{$data['body']}}" style="background-color: #0378B5; border: none; color: white; padding: 14px 16px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 27px;">Log In Now</a>
                        </td>
                    </tr>
                    <tr>
                        <td style="line-height: 100px; text-align: center; font-size: 16px;">
                            <p>Best wishes, Avanis Team.</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            @include('admin.emails.layouts.footer')
        </td>
    </tr>
</table>