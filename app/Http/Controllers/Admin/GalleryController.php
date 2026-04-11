<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::latest()->get(10);
        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    public function show(Gallery $id)
    {
        return view('admin.gallery.show', compact('id'));
    }

    public function edit(Gallery $id)
    {
        return view('admin.gallery.edit', compact('id'));
    }

    public function update(Request $request, Gallery $id)
    {
        $request->validate([
            'keterangan' => 'nullable|string|max:255'
        ]);

        $id->update(['keterangan' => $request->keterangan]);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery berhasil diperbarui');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // multiple image upload
        $request->validate([
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'keterangan' => 'nullable|string|max:255'
        ]);

        foreach ($request->file('images') as $image) {
            $path = $image->store('galleries', 'public');
            Gallery::create(['path' => $path, 'keterangan' => $request->keterangan]);
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery berhasil ditambahkan');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $id)
    {
        $id->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery berhasil dihapus');
    }
}
