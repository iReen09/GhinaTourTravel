<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $fillable = [
        'nama_paket',
        'harga_paket',
        'durasi',
        'deskripsi',
        'pax',
        'note',
    ];


    public function tempats()
    {
        return $this->hasMany(Tempat::class, 'id_paket');
    }

    public function konsumsis()
    {
        return $this->hasMany(Konsumsi::class, 'id_paket');
    }

    public function akomodasis()
    {
        return $this->hasMany(Akomodasi::class, 'id_paket');
    }

    public function transportasis()
    {
        return $this->hasMany(Transportasi::class, 'id_paket');
    }
}
