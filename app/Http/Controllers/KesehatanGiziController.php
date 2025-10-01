<?php

namespace App\Http\Controllers;

use App\Models\KesehatanGizi;
use App\Models\Sektor;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class KesehatanGiziController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kesehatanGizis = KesehatanGizi::with(['sektor', 'penduduk'])->latest()->paginate(10);
        return view('kesehatan_gizi.index', compact('kesehatanGizis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sektors = Sektor::all();
        $penduduks = Penduduk::all();
        return view('kesehatan_gizi.create', compact('sektors', 'penduduks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sektor_id' => 'required|exists:sektors,id',
            'penduduk_id' => 'required|exists:penduduk,id',
            'bmi' => 'nullable|numeric|min:0|max:100',
            'diet_type' => 'nullable|string',
            'deficiencies' => 'nullable|string',
            'nutritional_status' => 'nullable|string',
        ]);

        try {
            KesehatanGizi::create($validatedData);
            return redirect()->route('kesehatan_gizi.index')->with('success', 'Data Kesehatan Gizi berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan data. Terjadi kesalahan server.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(KesehatanGizi $kesehatanGizi)
    {
        return view('kesehatan_gizi.show', compact('kesehatanGizi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KesehatanGizi $kesehatanGizi)
    {
        $sektors = Sektor::all();
        $penduduks = Penduduk::all();
        return view('kesehatan_gizi.edit', compact('kesehatanGizi', 'sektors', 'penduduks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KesehatanGizi $kesehatanGizi)
    {
        $validatedData = $request->validate([
            'sektor_id' => 'required|exists:sektors,id',
            'penduduk_id' => 'required|exists:penduduk,id',
            'bmi' => 'nullable|numeric|min:0|max:100',
            'diet_type' => 'nullable|string',
            'deficiencies' => 'nullable|string',
            'nutritional_status' => 'nullable|string',
        ]);

        try {
            $kesehatanGizi->update($validatedData);
            return redirect()->route('kesehatan_gizi.show', $kesehatanGizi->id)->with('success', 'Data Kesehatan Gizi berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KesehatanGizi $kesehatanGizi)
    {
        $kesehatanGizi->delete();
        return redirect()->route('kesehatan_gizi.index')->with('success', 'Data Kesehatan Gizi berhasil dihapus.');
    }
}
