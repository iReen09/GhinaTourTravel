<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $fillable = [
        'nama_paket',
        'harga_paket',
        'durasi',
        'rundown',
        'note',
    ];


    public function tempats()
    {
        return $this->hasMany(Tempat::class, 'id_paket');
    }

    public function fasilitas()
    {
        return $this->hasMany(Fasilitas::class, 'id_paket');
    }

    public function fotos()
    {
        return $this->hasManyThrough(Gallery::class, Tempat::class, 'id_paket', 'id_tempat');
    }

    public function transportasis()
    {
        return $this->hasMany(Fasilitas::class, 'id_paket')->where('tipe_fasilitas', 'transportasi');
    }

    public function akomodasis()
    {
        return $this->hasMany(Fasilitas::class, 'id_paket')->where('tipe_fasilitas', 'akomodasi');
    }

    public function konsumsis()
    {
        return $this->hasMany(Fasilitas::class, 'id_paket')->where('tipe_fasilitas', 'konsumsi');
    }
}
