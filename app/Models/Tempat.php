<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tempat extends Model
{
    protected $fillable = [
        'id_paket',
        'nama_tempat'
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket');
    }

    public function fotos()
    {
        return $this->hasMany(Foto::class, 'id_tempat');
    }
}
