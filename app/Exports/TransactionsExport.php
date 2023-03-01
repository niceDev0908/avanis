<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;

class TransactionsExport implements FromCollection, WithHeadings {

    use Exportable;

    function __construct($params) {
        $this->params = $params;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection() {
        $this->params['product_type'] = ($this->params['product_type'] == "") ? ['RSA', 'CFP'] : [$this->params['product_type']];
        $this->params['from_date'] = ($this->params['from_date'] == "") ? "1970-01-01" : $this->params['from_date'];
        $this->params['to_date'] = ($this->params['to_date'] == "") ? date('Y-m-d') : $this->params['to_date'];
        
        $data = DB::table('receivables')
                ->selectRaw('first_name, last_name, product_type, DATE_FORMAT(`date`, "%d-%m-%Y"), amount, intermediary_code, company, business_type')
                ->leftJoin('users', 'users.id', '=', 'receivables.user_id')
                ->where('users.status', 1)
                ->where('users.deleted_at', NULL)
                ->where('receivables.deleted_at', NULL)
                ->whereIn('product_type', $this->params['product_type'])
                ->whereBetween('receivables.date', array($this->params['from_date'], $this->params['to_date']))
                ->get();

        return collect($data);
    }

    public function headings(): array {
        return [
            'First Name',
            'Last Name',
            'Product Type',
            'Date',
            'Amount',
            'Intermediary Code',
            'Company',
            'Business Type',
        ];
    }

}
