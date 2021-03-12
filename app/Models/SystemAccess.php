<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SystemAccess extends Model
{
    use HasFactory, SoftDeletes;

    public function system()
    {
        return $this->belongsTo(Systems::class); 
    }

    public function user_empid()
    {
        return $this->belongsTo(User::class); 
    }
}
