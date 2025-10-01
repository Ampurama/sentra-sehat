<?php

namespace App\Http\Controllers;

use App\Models\KesehatanAnakIbu;
use App\Models\Sektor;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class KesehatanAnakIbuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kesehatanAnakIbus = KesehatanAnakIbu::with(['sektor', 'penduduk'])->latest()->paginate(10);
        return view('kesehatan_anak_ibu.index', compact('kesehatanAnakIbus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sektors = Sektor::all();
        $penduduks = Penduduk::all();
        return view('kesehatan_anak_ibu.create', compact('sektors', 'penduduks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sektor_id' => 'required|exists:sektors,id',
            'penduduk_id' => 'required|exists:penduduk,id',
            'child_vaccinations_complete' => 'boolean',
            'maternal_checkups_count' => 'nullable|integer|min:0',
            'birth_weight' => 'nullable|numeric|min:0|max:10',
            'last_checkup' => 'nullable|date',
        ]);

        try {
            KesehatanAnakIbu::create($validatedData);
            return redirect()->route('kesehatan_anak_ibu.index')->with('success', 'Data Kesehatan Anak dan Ibu berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan data. Terjadi kesalahan server.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(KesehatanAnakIbu $kesehatanAnakIbu)
    {
        return view('kesehatan_anak_ibu.show', compact('kesehatanAnakIbu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KesehatanAnakIbu $kesehatanAnakIbu)
    {
        $sektors = Sektor::all();
        $penduduks = Penduduk::all();
        return view('kesehatan_anak_ibu.edit', compact('kesehatanAnakIbu', 'sektors', 'penduduks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KesehatanAnakIbu $kesehatanAnakIbu)
    {
        $validatedData = $request->validate([
            'sektor_id' => 'required|exists:sektors,id',
            'penduduk_id' => 'required|exists:penduduk,id',
            'child_vaccinations_complete' => 'boolean',
            'maternal_checkups_count' => 'nullable|integer|min:0',
            'birth_weight' => 'nullable|numeric|min:0|max:10',
            'last_checkup' => 'nullable|date',
        ]);

        try {
            $kesehatanAnakIbu->update($validatedData);
            return redirect()->route('kesehatan_anak_ibu.show', $kesehatanAnakIbu->id)->with('success', 'Data Kesehatan Anak dan Ibu berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KesehatanAnakIbu $kesehatanAnakIbu)
    {
        $kesehatanAnakIbu->delete();
        return redirect()->route('kesehatan_anak_ibu.index')->with('success', 'Data Kesehatan Anak dan Ibu berhasil dihapus.');
    }
}
