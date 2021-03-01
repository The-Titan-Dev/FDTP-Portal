<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleAccess extends Model
{
    use HasFactory;

    public function role_access()
    {
        return $this->belongsTo(Role::class); 
    }
}
