<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $fillable = [
        'nama_paket',
        'harga_paket',
        'note',
    ];

    protected $casts = [
        'harga_paket' => 'decimal:2',
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

    public function fotos()
    {
        return $this->hasMany(Foto::class, 'id_paket');
    }

    public static function booted()
    {
        static::deleting(function ($paket) {
            $paket->tempats()->each(function ($tempat) {
                $tempat->fotos()->delete();
            });
            $paket->tempats()->delete();
            $paket->konsumsis()->delete();
            $paket->akomodasis()->delete();
            $paket->transportasis()->delete();
        });
    }
}
