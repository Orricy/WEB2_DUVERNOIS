<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
		'user_id', 'name', 'creator',
		'adress_creator', 'email_creator', 'phone_creator',
		'contact', 'adress_contact', 'email_contact',
		'phone_contact', 'identity', 'type',
		'context', 'demand', 'goal',
		'other', 'status',
	];

    public function user(){
    	return $this->belongsTo('App\Models\User');
    }
}
