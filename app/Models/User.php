<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public function department()
    {
        return $this->belongsTo(Department::class, 'dep_id');
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class, 'desig_id');
    }
}
