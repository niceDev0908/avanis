<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center" style="border: 1px solid; border-color: #808052;">
    <tr>
        <td>
            @include('admin.emails.layouts.header')
            <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
                <tbody>
                    <tr>
                        <td style="text-align: center; font-size: 16px; padding-top: 20px;">
                            <p style="padding: 0px 10px;">Dear Admin</p>
                            <p style="padding: 0px 10px;"><strong><span style="color: #0378B5;">{{$data['name']}}</span> has uploaded the requested document for action <span style="color: #0378B5;">{{$data['action_document_title']}}</span>.</strong></p>
                            <p style="padding: 0px 10px;">To view the document log in to your account and view details.</p>
                            <p style="padding: 0px 10px;">If you’re having trouble clicking the "View Document" button, copy and paste the URL below into your web browser.</p>
                            <a href="{{$data['action_url']}}" style="text-decoration: none;"><span style="color: #0378B5">{{$data['action_url']}}</span></a>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center; padding: 15px;">
                            <a href="{{$data['action_url']}}" style="background-color: #0378B5; border: none; color: white; padding: 14px 16px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer; border-radius: 27px;">View Document</a>
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