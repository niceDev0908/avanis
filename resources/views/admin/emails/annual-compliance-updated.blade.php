<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center" style="border: 1px solid; border-color: #808052;">
    <tr>
        <td>
            @include('admin.emails.layouts.header')
            <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
                <tbody>
                    <tr>
                        <td style="text-align: center; font-size: 16px; padding-top: 20px;">
                            <p style="padding: 0px 10px;">Hello,</p>
                            <p style="padding: 0px 10px;">{{ $data['name'] }}, has updated the annual compliance. Click on the below link to view.</p>
                            <p style="padding: 0px 10px;">If you’re having trouble clicking the "View Annual Compliance" button, copy and paste the URL below into your web browser.</p>
                            <a href="" style="text-decoration: none;"><span style="color: #0378B5">{{$data['link']}}</span></a>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center; padding: 15px;">
                            <a href="{{$data['link']}}" style="background-color: #0378B5; border: none; color: white; padding: 14px 16px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 27px;">Reset Password</a>
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