<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Foto;
use App\Models\Gallery;
use App\Models\Paket;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        $pakets = Paket::with(['fasilitas', 'tempats'])
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $fotos = Gallery::orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        return view('customer.index', compact('pakets', 'fotos'));
    }

    /**
     * Display all packages page.
     */
    public function packages()
    {
        $pakets = Paket::with(['fasilitas', 'tempats'])
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('customer.packages', compact('pakets'));
    }

    /**
     * Display a specific package detail.
     */
    public function packageDetail($id)
    {
        $paket = Paket::with(['fasilitas', 'tempats.galleries', 'fotos', 'transportasis', 'akomodasis', 'konsumsis'])
            ->findOrFail($id);


        return view('customer.package-detail', compact('paket'));
    }

    /**
     * Display all photos/gallery page.
     */
    public function photos()
    {
        $fotos = Gallery::orderBy('created_at', 'desc')
            ->paginate(12);

        return view('customer.photos', compact('fotos'));
    }

    /**
     * Search packages.
     */
    public function search(Request $request)
    {
        $query = $request->input('q');

        $pakets = Paket::with(['fasilitas', 'tempats'])
            ->where(function ($q) use ($query) {
                $q->where('nama_paket', 'like', "%{$query}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(9);

        return view('customer.packages', compact('pakets', 'query'));
    }
}
