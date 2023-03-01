<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center" style="border: 1px solid; border-color: #808052;">
    <tr>
        <td>
            @include('admin.emails.layouts.header')
            <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
                <tbody>
                    <tr>
                        <td style="text-align: center; font-size: 16px; padding-top: 20px;">
                            <p style="padding: 0px 10px;">Dear {{$first_name}} {{$last_name}}</p>
                            <p style="padding: 0px 10px;"><strong>You have received a new message from  <span style="color: #0378B5;">Avanis Support</span></strong></p>
                            <p style="padding: 0px 10px;">To view the message please log in to your membership dashboard by clicking the button below.</p>
                            <p style="padding: 0px 10px;">If you’re having trouble clicking the "Log in" button, copy and paste the URL below into your web browser.</p>
                            <a href="{{$data['body']}}" style="text-decoration: none;">Log In</a>
                            <p style="padding: 0px 10px;"><span style="color: #0378B5">{{$data['body']}}</span></p>
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