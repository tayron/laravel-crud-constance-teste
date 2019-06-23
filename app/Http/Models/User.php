<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    
    public function profile() {
        return $this->belongsTo('App\Http\Models\Profile','id','profile_id');
    }    
}
