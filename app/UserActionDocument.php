<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserActionDocument extends Model
{
    use SoftDeletes;
    
    public function user_action(){
    	return $this->belongsTo('App\UserAction', 'user_action_id');
    }
    
    public function user_action_required_document(){
    	return $this->hasMany('App\UserActionDocumentRequested', 'user_action_document_id');
    }
}
