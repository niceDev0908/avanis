<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $fillable = ['sender_id','receiver_id','message'];

    public function users_with_sender(){
    	return $this->belongsTo('App\User','sender_id');
    }
}
