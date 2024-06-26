<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable=['first_name', 'last_name', 'company','email', 'phone'];

    public function company()
    {
     return $this->belongsTo(Comment::class,'id','company');
    }
}
