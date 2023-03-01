<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAction extends Model
{
    use SoftDeletes;

    public function user(){
    	return $this->belongsTo('App\User');
    }
    
    public function receivable(){
    	return $this->belongsTo('App\Receivable');
    }
    
    public function user_action_documents(){
    	return $this->hasMany('App\UserActionDocument');
    }
}
