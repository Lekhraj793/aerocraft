<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

	protected $fillable = ['id','name','shortname','dialcode','active','created_at','updated_at'];
}
