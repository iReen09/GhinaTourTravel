<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paket;
use App\Models\Tempat;
use App\Models\Konsumsi;
use App\Models\Akomodasi;
use App\Models\Transportasi;
use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PaketController extends Controller
{
    public function index()
    {
        $pakets = Paket::with(['tempats', 'konsumsis', 'akomodasis', 'transportasis', 'fotos'])
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
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'harga_paket' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'fotos' => 'nullable|array',
            'fotos.*' => 'nullable|image|max:2048',
            'tempats' => 'nullable|array',
            'tempats.*' => 'nullable|string|max:255',
            'konsumsis' => 'nullable|array',
            'konsumsis.*' => 'nullable|string|max:255',
            'akomodasis' => 'nullable|array',
            'akomodasis.*' => 'nullable|string|max:255',
            'transportasis' => 'nullable|array',
            'transportasis.*' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($validated) {
            $paket = Paket::create([
                'nama_paket' => $validated['nama_paket'],
                'harga_paket' => $validated['harga_paket'],
                'note' => $validated['note'] ?? null,
            ]);

            $this->saveRelatedModels($paket, $validated);
            $this->saveFotos($paket, $validated);
        });

        return redirect()->route('admin.paket.index')
            ->with('success', 'Paket berhasil ditambahkan');
    }

    public function show(Paket $paket)
    {
        $paket->load(['tempats.fotos', 'konsumsis', 'akomodasis', 'transportasis', 'fotos']);
        return view('admin.paket.show', compact('paket'));
    }

    public function edit(Paket $paket)
    {
        $paket->load(['tempats.fotos', 'konsumsis', 'akomodasis', 'transportasis', 'fotos']);
        return view('admin.paket.edit', compact('paket'));
    }

    public function update(Request $request, Paket $paket)
    {
        $validated = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'harga_paket' => 'required|numeric|min:0',
            'note' => 'nullable|string',
            'fotos' => 'nullable|array',
            'fotos.*' => 'nullable|image|max:2048',
            'tempats' => 'nullable|array',
            'tempats.*' => 'nullable|string|max:255',
            'konsumsis' => 'nullable|array',
            'konsumsis.*' => 'nullable|string|max:255',
            'akomodasis' => 'nullable|array',
            'akomodasis.*' => 'nullable|string|max:255',
            'transportasis' => 'nullable|array',
            'transportasis.*' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($paket, $validated) {
            $paket->update([
                'nama_paket' => $validated['nama_paket'],
                'harga_paket' => $validated['harga_paket'],
                'note' => $validated['note'] ?? null,
            ]);

            $paket->konsumsis()->delete();
            $paket->akomodasis()->delete();
            $paket->transportasis()->delete();
            $paket->tempats()->each(function ($tempat) {
                $tempat->fotos()->delete();
            });
            $paket->tempats()->delete();
            
            // Delete old direct fotos
            foreach ($paket->fotos as $foto) {
                if ($foto->path) {
                    Storage::disk('public')->delete($foto->path);
                }
            }
            $paket->fotos()->delete();

            $this->saveRelatedModels($paket, $validated);
            $this->saveFotos($paket, $validated);
        });

        return redirect()->route('admin.paket.index')
            ->with('success', 'Paket berhasil diperbarui');
    }

    public function destroy(Paket $paket)
    {
        $paket->delete();

        return redirect()->route('admin.paket.index')
            ->with('success', 'Paket berhasil dihapus');
    }

    private function saveRelatedModels(Paket $paket, array $data)
    {
        if (!empty($data['tempats'])) {
            foreach (array_filter($data['tempats']) as $namaTempat) {
                Tempat::create([
                    'id_paket' => $paket->id,
                    'nama_tempat' => $namaTempat,
                ]);
            }
        }

        if (!empty($data['konsumsis'])) {
            foreach (array_filter($data['konsumsis']) as $fasilitas) {
                Konsumsi::create([
                    'id_paket' => $paket->id,
                    'fasilitas_konsumsi' => $fasilitas,
                ]);
            }
        }

        if (!empty($data['akomodasis'])) {
            foreach (array_filter($data['akomodasis']) as $fasilitas) {
                Akomodasi::create([
                    'id_paket' => $paket->id,
                    'fasilitas_akomodasi' => $fasilitas,
                ]);
            }
        }

        if (!empty($data['transportasis'])) {
            foreach (array_filter($data['transportasis']) as $fasilitas) {
                Transportasi::create([
                    'id_paket' => $paket->id,
                    'fasilitas_transportasi' => $fasilitas,
                ]);
            }
        }
    }

    private function saveFotos(Paket $paket, array $data)
    {
        if (!empty($data['fotos'])) {
            foreach ($data['fotos'] as $foto) {
                if ($foto) {
                    $path = $foto->store('fotos', 'public');
                    Foto::create([
                        'id_paket' => $paket->id,
                        'path' => $path,
                    ]);
                }
            }
        }
    }
}
