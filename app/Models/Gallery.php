<?php

namespace App\Models;

use App\Models\Fasilitas;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['path', 'keterangan', 'type', 'id_fasilitas', 'id_tempat'];

    public function fasilitas()
    {
        return $this->belongsTo(Fasilitas::class);
    }

    public function tempat()
    {
        return $this->belongsTo(Tempat::class, 'id_tempat');
    }

    /**
     * Get the paket through tempat relationship.
     */
    public function paket()
    {
        return $this->hasOneThrough(
            \App\Models\Paket::class,
            \App\Models\Tempat::class,
            'id',           // tempats.id
            'id',           // pakets.id
            'id_tempat',    // galleries.id_tempat
            'id_paket'      // tempats.id_paket
        );
    }

    /**
     * Check if the gallery item is a video.
     */
    public function isVideo(): bool
    {
        return $this->type === 'video';
    }
}
