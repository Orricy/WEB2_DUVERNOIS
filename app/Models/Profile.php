<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $fillable = [
		'name', 'email', 'password', 'password_confirmation',
	];

    public function user(){
    	return $this->belongsTo('App\Models\User');
    }
}
