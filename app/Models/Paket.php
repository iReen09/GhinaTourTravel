<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $fillable = [
        'nama_paket',
        'harga_paket',
        'pax',
        'note',
    ];


    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }

    /**
     * Get the first foto (alias for backward compatibility).
     */
    public function foto()
    {
        return $this->fotos()->first();
    }

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

    public function getHargaPerPaxAttribute($value)
    {
        if ($value) {
            return $value;
        }
        // Calculate price per pax if only total price and pax are available
        if ($this->harga_paket && $this->minimal_peserta) {
            return $this->harga_paket / $this->minimal_peserta;
        }
        return $this->harga_paket ?? 0;
    }

    public function getDurasiAttribute($value)
    {
        return $value ?? '1 Hari';
    }

    public function getDeskripsiAttribute($value)
    {
        return $value ?? 'Paket wisata pilihan dengan fasilitas lengkap.';
    }

    public function getMinimalPesertaAttribute($value)
    {
        return $value ?? 50;
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
