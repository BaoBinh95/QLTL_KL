<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentFile extends Model
{
    protected $fillable = ['content','id_document'];

    public $timestamps = true;

    public function document() {
        return $this->belongsTo(Document::class, 'id_document');
    }
}
