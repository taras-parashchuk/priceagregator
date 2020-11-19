<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class setting extends Model
{
    //
	public function user()
		{
		   return $this->belongsTo(User::class);				
		}
}
