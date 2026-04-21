<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use App\Models\Paket;
use App\Models\Tempat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::with(['fasilitas', 'tempats.galleries'])
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
            'durasi'          => 'required|string|max:255',
            'rundown'       => 'nullable|string',
            'note'            => 'nullable|string',

            // Nested Tempat
            'tempats'                  => 'nullable|array',
            'tempats.*.nama_tempat'    => 'required|string|max:255',

            // Other relations (text only)
            'fasilitas'                => 'nullable|array',
            'fasilitas.*.nama_fasilitas' => 'required|string',
            'fasilitas.*.tipe_fasilitas' => 'required|string|in:konsumsi,akomodasi,transportasi',
        ]);

        DB::beginTransaction();

        try {
            $paket = Paket::create($request->only([
                'nama_paket', 'harga_paket', 'durasi', 'rundown', 'note'
            ]));

            // === Handle Tempat ===
            if ($request->has('tempats')) {
                foreach ($request->tempats as $tempat) {
                    $paket->tempats()->create([
                        'nama_tempat' => $tempat['nama_tempat'],
                    ]);
                }
            }

            // === Handle Fasilitas ===
            if ($request->has('fasilitas')) {
                foreach ($request->fasilitas as $fasilitas) {
                    $paket->fasilitas()->create([
                        'nama_fasilitas' => $fasilitas['nama_fasilitas'],
                        'tipe_fasilitas' => $fasilitas['tipe_fasilitas'],
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
        $paket->load(['fasilitas']);
        return view('admin.paket.show', compact('paket'));
    }

    public function edit(Paket $paket)
    {
        $paket->load(['fasilitas']);
        return view('admin.paket.edit', compact('paket'));
    }

    public function update(Request $request, Paket $paket)
    {
        // For now, basic update (you can extend it later with delete + re-upload logic)
        $request->validate([
            'nama_paket'      => 'required|string|max:255',
            'harga_paket'     => 'required|numeric',
            'durasi'          => 'required|string|max:255',
            'rundown'       => 'nullable|string',
            'note'            => 'nullable|string',

            // Nested Tempat
            'tempats'                  => 'nullable|array',
            'tempats.*.nama_tempat'    => 'required|string|max:255',

            // Other relations (text only)
            'fasilitas'                => 'nullable|array',
            'fasilitas.*.nama_fasilitas' => 'required|string',
            'fasilitas.*.tipe_fasilitas' => 'required|string|in:konsumsi,akomodasi,transportasi',
        ]);

        $paket->update($request->only([
            'nama_paket', 'harga_paket', 'durasi', 'rundown', 'note'
        ]));

        // Handle Tempats safely
        $this->syncChildWithImages($paket, 'tempats', $request->tempats ?? [], Tempat::class);
    
        // Handle Fasilitas safely
        $this->syncChildWithImages($paket, 'fasilitas', $request->fasilitas ?? [], Fasilitas::class);

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

    /**
     * Sync child records (tempat or fasilitas) while preserving existing images
     */
    private function syncChildWithImages(Paket $paket, string $relation, array $incomingData, string $modelClass)
    {
        if (empty($incomingData)) {
            // If user removed all, delete everything (images will cascade)
            $paket->{$relation}()->delete();
            return;
        }
    
        $incomingIds = collect($incomingData)
            ->pluck('id')
            ->filter()                    // remove null/empty ids
            ->all();
    
        // Delete only the records that were removed by user
        $paket->{$relation}()
              ->whereNotIn('id', $incomingIds)
              ->delete();                 // this will also delete their galleries via cascade
    
        // Update or Create each item
        foreach ($incomingData as $item) {
            if (!empty($item['id'])) {
                // Update existing
                $modelClass::where('id', $item['id'])
                           ->where('id_paket', $paket->id)   // security
                           ->update([
                               'nama_tempat'    => $item['nama_tempat'] ?? null,     // for tempat
                               'nama_fasilitas' => $item['nama_fasilitas'] ?? null,  // for fasilitas
                               'tipe_fasilitas' => $item['tipe_fasilitas'] ?? null,
                           ]);
            } else {
                // Create new
                $paket->{$relation}()->create([
                    'nama_tempat'    => $item['nama_tempat'] ?? null,
                    'nama_fasilitas' => $item['nama_fasilitas'] ?? null,
                    'tipe_fasilitas' => $item['tipe_fasilitas'] ?? null,
                ]);
            }
        }
    }
}