<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // FIX: get() tidak menerima argumen — gunakan latest()->get() untuk semua data
        $galleries = Gallery::with(['tempat.paket', 'fasilitas.paket'])->latest()->get();
        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // FIX: relasi di model Paket bernama 'tempats' bukan 'tempat'
        $pakets = Paket::with(['tempats', 'fasilitas'])->latest()->get();
        return view('admin.gallery.create', compact('pakets'));
    }

    public function show(Gallery $gallery)
    {
        $gallery->load(['tempat', 'fasilitas']);
        return view('admin.gallery.show', compact('gallery'));
    }

    /**
     * AJAX: Get tempat & fasilitas for a given paket.
     */
    public function getRelationsByPaket(Request $request)
    {
        $paket = Paket::with(['tempats', 'fasilitas'])->find($request->paket_id);

        if (!$paket) {
            return response()->json(['tempats' => [], 'fasilitas' => []]);
        }

        return response()->json([
            'tempats' => $paket->tempats->map(fn($t) => ['id' => $t->id, 'nama' => $t->nama_tempat]),
            'fasilitas' => $paket->fasilitas->map(fn($f) => ['id' => $f->id, 'nama' => $f->nama_fasilitas]),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * Supports images & videos. No FFMpeg — just file size limits.
     */
    public function store(Request $request)
    {
        $request->validate([
            'media'        => 'required|array',
            'media.*'      => 'file|mimes:jpeg,png,jpg,gif,svg,webp,mp4,mov,avi|max:51200', // 50MB max
            'id_fasilitas' => 'nullable|exists:fasilitas,id',
            'id_tempat'    => 'nullable|exists:tempats,id',
        ]);

        foreach ($request->file('media') as $file) {
            $mime = $file->getMimeType();
            $type = str_starts_with($mime, 'video/') ? 'video' : 'image';

            // Compress images using GD (no external library needed)
            if ($type === 'image') {
                $path = $this->compressAndStoreImage($file);
            } else {
                // Store video directly (no FFMpeg)
                $path = $file->store('galleries', 'public');
            }

            Gallery::create([
                'path'         => $path,
                'type'         => $type,
                'id_fasilitas' => $request->id_fasilitas,
                'id_tempat'    => $request->id_tempat,
            ]);
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Media berhasil ditambahkan');
    }

    /**
     * Compress image using GD and store it.
     */
    private function compressAndStoreImage($file): string
    {
        $extension = strtolower($file->getClientOriginalExtension());
        $filename = 'galleries/' . uniqid() . '_' . time() . '.jpg';

        // Create image resource from uploaded file
        $image = match ($extension) {
            'png' => imagecreatefrompng($file->getRealPath()),
            'gif' => imagecreatefromgif($file->getRealPath()),
            'webp' => imagecreatefromwebp($file->getRealPath()),
            default => imagecreatefromjpeg($file->getRealPath()),
        };

        if (!$image) {
            // Fallback: store without compression
            return $file->store('galleries', 'public');
        }

        // Resize if too large (max 1920px width)
        $width = imagesx($image);
        $height = imagesy($image);
        $maxWidth = 1920;

        if ($width > $maxWidth) {
            $newHeight = (int) ($height * ($maxWidth / $width));
            $resized = imagecreatetruecolor($maxWidth, $newHeight);

            // Preserve transparency for PNG
            if ($extension === 'png') {
                imagealphablending($resized, false);
                imagesavealpha($resized, true);
            }

            imagecopyresampled($resized, $image, 0, 0, 0, 0, $maxWidth, $newHeight, $width, $height);
            imagedestroy($image);
            $image = $resized;
        }

        // Save as JPEG with 75% quality
        $storagePath = storage_path('app/public/' . $filename);
        $dir = dirname($storagePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        imagejpeg($image, $storagePath, 75);
        imagedestroy($image);

        return $filename;
    }


    /**
     * Remove the specified resource from storage.
     * FIX: hapus file dari disk storage sebelum delete record
     */
    public function destroy(Gallery $gallery)
    {
        // FIX: hapus file dari storage saat foto dihapus
        if (Storage::disk('public')->exists($gallery->path)) {
            Storage::disk('public')->delete($gallery->path);
        }

        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Media berhasil dihapus');
    }
}
