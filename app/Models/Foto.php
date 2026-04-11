<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable = [
        'id_tempat',
        'path'
    ];


    public function tempat()
    {
        return $this->belongsTo(Tempat::class, 'id_tempat');
    }
}
