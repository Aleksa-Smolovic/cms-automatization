<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	use SoftDeletes;
	
	protected $guarded = [];

	public function users() {
		return $this->hasMany(User::class);
	}
}
