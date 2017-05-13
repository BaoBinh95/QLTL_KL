<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeDocument extends Model
{
    protected $fillable = ['name'];

    public function documents() {
        return $this->hasMany(Document::class);
    }
}
