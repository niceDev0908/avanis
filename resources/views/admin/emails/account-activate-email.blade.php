<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center" style="border: 1px solid; border-color: #808052;">
    <tr>
        <td>
            @include('admin.emails.layouts.header')
            <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
                <tbody>
                    <tr>
                        <td style="text-align: center; font-size: 16px; padding-top: 20px;">
                            <p style="padding: 0px 10px;">Dear {{$active_data['message']}}</p>
                            <p style="padding: 0px 10px;">We are pleased to let you know that your Avanis membership has been approved.</p>
                            <p style="padding: 0px 10px;">You can now login using your email address and password <a href="{{route('login')}}">here</a>.</p>
                            <p style="padding: 0px 10px;">In future, please use the ‘messages’ function on your user dashboard to contact the Avanis support team.</p>
                            <p style="padding: 0px 10px;">If you experience any difficulties accessing your account, you can email us on support@avanis.co.uk</p>
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