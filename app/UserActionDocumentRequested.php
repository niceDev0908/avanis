<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserActionDocumentRequested extends Model {

    protected $table = 'user_action_document_requested';

    use SoftDeletes;

    public function action_document() {
        return $this->belongsTo('App\UserActionDocument', 'user_action_document_id');
    }

}
