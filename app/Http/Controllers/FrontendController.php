<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Foto;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        $pakets = Paket::with(['fotos', 'transportasis', 'akomodasis', 'konsumsis', 'tempats'])
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $fotos = Foto::orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        return view('frontend.index', compact('pakets', 'fotos'));
    }

    /**
     * Display all packages page.
     */
    public function packages()
    {
        $pakets = Paket::with(['fotos', 'transportasis', 'akomodasis', 'konsumsis', 'tempats'])
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('frontend.packages', compact('pakets'));
    }

    /**
     * Display a specific package detail.
     */
    public function packageDetail($id)
    {
        $paket = Paket::with(['fotos', 'transportasis', 'akomodasis', 'konsumsis', 'tempats'])
            ->findOrFail($id);

        $relatedPakets = Paket::with(['fotos'])
            ->where('id', '!=', $id)
            ->take(3)
            ->get();

        return view('frontend.package-detail', compact('paket', 'relatedPakets'));
    }

    /**
     * Display all photos/gallery page.
     */
    public function photos()
    {
        $fotos = Foto::with('paket')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('frontend.photos', compact('fotos'));
    }

    /**
     * Search packages.
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        $pakets = Paket::with(['fotos', 'transportasis', 'akomodasis', 'konsumsis', 'tempats'])
            ->where(function ($q) use ($query) {
                $q->where('nama_paket', 'like', "%{$query}%")
                    ->orWhere('deskripsi', 'like', "%{$query}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('frontend.packages', compact('pakets', 'query'));
    }
}
