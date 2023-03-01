<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receivables extends Model {

    use SoftDeletes;

    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function user_action(){
    	return $this->hasMany('App\UserAction', 'receivable_id');
    }

}
