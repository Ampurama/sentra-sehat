<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Http\Requests\StoreObatRequest;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obats = Obat::latest()->paginate(10);
        return view('obat.index', compact('obats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('obat.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreObatRequest $request)
    {
        $validatedData = $request->validated();

        try {
            Obat::create($validatedData);
            return redirect()->route('obat.index')->with('success', 'Data Obat berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan data. Terjadi kesalahan server.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Obat $obat)
    {
        return view('obat.show', compact('obat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Obat $obat)
    {
        return view('obat.edit', compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreObatRequest $request, Obat $obat)
    {
        $validatedData = $request->validated();

        try {
            $obat->update($validatedData);
            return redirect()->route('obat.show', $obat->id)->with('success', 'Data Obat berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Obat $obat)
    {
        $obat->delete();
        return redirect()->route('obat.index')->with('success', 'Data Obat berhasil dihapus.');
    }
}
