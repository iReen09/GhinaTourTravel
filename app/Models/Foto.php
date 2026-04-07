<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $fillable = [
        'id_paket',
        'id_tempat',
        'path'
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket');
    }

    public function tempat()
    {
        return $this->belongsTo(Tempat::class, 'id_tempat');
    }
}
