<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::with(['tempats.fotos', 'konsumsis', 'akomodasis', 'transportasis'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.paket.index', compact('pakets'));
    }

    public function create()
    {
        return view('admin.paket.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_paket'      => 'required|string|max:255',
            'harga_paket'     => 'required|numeric',
            'durasi'          => 'required|integer',
            'deskripsi'       => 'nullable|string',
            'pax'             => 'required|integer',
            'note'            => 'nullable|string',

            // Nested Tempat + Fotos (files)
            'tempats'                  => 'nullable|array',
            'tempats.*.nama_tempat'    => 'required|string|max:255',
            'tempats.*.fotos'          => 'nullable|array',
            'tempats.*.fotos.*'        => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120', // max 5MB per image

            // Other relations (text only)
            'konsumsis'                => 'nullable|array',
            'konsumsis.*.fasilitas_konsumsi' => 'required|string',

            'akomodasis'               => 'nullable|array',
            'akomodasis.*.fasilitas_akomodasi' => 'required|string',

            'transportasis'            => 'nullable|array',
            'transportasis.*.fasilitas_transportasi' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $paket = Paket::create($request->only([
                'nama_paket', 'harga_paket', 'durasi', 'deskripsi', 'pax', 'note'
            ]));

            // === Handle Tempat + Foto Uploads ===
            if ($request->has('tempats')) {
                foreach ($request->tempats as $index => $tempatData) {
                    $tempat = $paket->tempats()->create([
                        'nama_tempat' => $tempatData['nama_tempat']
                    ]);

                    // Handle multiple photos for this tempat
                    if ($request->hasFile("tempats.{$index}.fotos")) {
                        foreach ($request->file("tempats.{$index}.fotos") as $file) {
                            // Store file in storage/app/public/fotos/
                            $path = $file->store('fotos', 'public');

                            $tempat->fotos()->create([
                                'path' => $path   // e.g. "fotos/abc123.jpg"
                            ]);
                        }
                    }
                }
            }

            // === Other simple relations ===
            if ($request->has('konsumsis')) {
                foreach ($request->konsumsis as $konsumsi) {
                    $paket->konsumsis()->create([
                        'fasilitas_konsumsi' => $konsumsi['fasilitas_konsumsi']
                    ]);
                }
            }

            if ($request->has('akomodasis')) {
                foreach ($request->akomodasis as $akomodasi) {
                    $paket->akomodasis()->create([
                        'fasilitas_akomodasi' => $akomodasi['fasilitas_akomodasi']
                    ]);
                }
            }

            if ($request->has('transportasis')) {
                foreach ($request->transportasis as $transportasi) {
                    $paket->transportasis()->create([
                        'fasilitas_transportasi' => $transportasi['fasilitas_transportasi']
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('admin.paket.index')
                ->with('success', 'Paket berhasil ditambahkan beserta foto-fotonya');

        } catch (\Exception $e) {
            DB::rollBack();

            // Optional: delete uploaded files if transaction fails (advanced)
            return redirect()->back()
                ->withInput()
                ->with('failed', 'Gagal menambahkan paket: ' . $e->getMessage());
        }
    }

    public function show(Paket $paket)
    {
        $paket->load(['tempats.fotos', 'konsumsis', 'akomodasis', 'transportasis']);
        return view('admin.paket.show', compact('paket'));
    }

    public function edit(Paket $paket)
    {
        $paket->load(['tempats.fotos', 'konsumsis', 'akomodasis', 'transportasis']);
        return view('admin.paket.edit', compact('paket'));
    }

    public function update(Request $request, Paket $paket)
    {
        // For now, basic update (you can extend it later with delete + re-upload logic)
        $request->validate([
            'nama_paket' => 'sometimes|string|max:255',
            'harga_paket' => 'sometimes|numeric',
            'durasi' => 'sometimes|integer',
            'deskripsi' => 'nullable|string',
            'pax' => 'sometimes|integer',
            'note' => 'nullable|string',
        ]);

        $paket->update($request->only([
            'nama_paket', 'harga_paket', 'durasi', 'deskripsi', 'pax', 'note'
        ]));

        return redirect()->route('admin.paket.index')
            ->with('success', 'Paket berhasil diperbarui');
    }

    public function destroy(Paket $paket)
    {
        // Optional: delete all related photos from storage
        foreach ($paket->tempats as $tempat) {
            foreach ($tempat->fotos as $foto) {
                if (Storage::disk('public')->exists($foto->path)) {
                    Storage::disk('public')->delete($foto->path);
                }
            }
        }

        $paket->delete();

        return redirect()->route('admin.paket.index')
            ->with('success', 'Paket berhasil dihapus');
    }
}