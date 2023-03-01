<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center" style="border: 1px solid; border-color: #808052;">
    <tr>
        <td>
            @include('admin.emails.layouts.header')
            <table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
                <tbody>
                    <tr>
                        <td style="text-align: center; font-size: 16px; padding-top: 20px;">
                            <p style="padding: 0px 10px;">Dear Admin</p>
                            <p style="padding: 0px 10px;"><strong><span style="color: #0378B5;">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span> has {{$details['action']}} asset.</strong></p>
                            
                            <p style="padding: 0px 10px;"><strong>Asset Description : </strong> {{$details['assets']->description}}</p>
                            <p style="padding: 0px 10px;"><strong>Value : </strong> {{$details['assets']->value}}</p>
                            <p style="padding: 0px 10px;"><strong>Currency : </strong> {{$details['assets']->currency}}</p>
                            <p style="padding: 0px 10px;"><strong>Current Price Per Unit : </strong> {{$details['assets']->current_price_per_unit}}</p>
                            <p style="padding: 0px 10px;"><strong>Total Value of Holding : </strong> {{$details['assets']->total_value_of_holding}}</p>
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