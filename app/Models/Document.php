<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    protected $fillable = ['title', 'description', 'status', 'id_user', 'id_typedoc', 'view_count'];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function typeDoc() {
        return $this->belongsTo(TypeDocument::class);
    }

    public function documentFiles() {
        return $this->hasMany(DocumentFile::class, 'id_document');
    }

    public function countFiles() {
        return $this->documentFiles()->count();
    }
}
