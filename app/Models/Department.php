<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{

    protected $fillable = ['name', 'alias', 'address'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
