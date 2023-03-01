<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceivableRecipient extends Model {

    use SoftDeletes;

    public function receivable() {
        return $this->belongsTo('App\Receivable');
    }

}
