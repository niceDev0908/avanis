<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class UserReport implements FromCollection, WithHeadings {

    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    function __construct($params) {
        $this->params = $params;
    }

    public function collection()
    {
        $this->params['u_from_date'] = ($this->params['u_from_date'] == "") ? "1970-01-01" : $this->params['u_from_date'];
        $this->params['u_to_date'] = ($this->params['u_to_date'] == "") ? date('Y-m-d') : $this->params['u_to_date'];
        
        $data = User::whereBetween('created_at', [$this->params['u_from_date'], $this->params['u_to_date']])
            ->select('first_name','last_name','company','username','email','address','address2','town','county','country','created_at','postcode','phone_number','intermediary_code','product_type','business_type','avanis_fee','planning_fee', 'date_of_rsa')
            ->get();
        
        return collect($data);
    }
    
    public function headings(): array {
        return [
            'First Name',
            'Last Name',
            'Company',
            'Username',
            'Email',
            'Address',
            'Address2',
            'Town',
            'County',
            'Country',
            'Register date',
            'Postcode',
            'Phone Number',
            'Application Code',
            'Product Type',
            'Business Type',
            'Avanis Fee (%)',
            'Planning Fee (%)',
            'Onboarding Date'
        ];
    }
}
