<?php

namespace App\Http\Controllers;

use App\Models\KesehatanLingkungan;
use App\Models\Sektor;
use App\Models\Wilayah;
use Illuminate\Http\Request;

class KesehatanLingkunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kesehatanLingkungans = KesehatanLingkungan::with(['sektor', 'wilayah'])->latest()->paginate(10);
        return view('kesehatan_lingkungan.index', compact('kesehatanLingkungans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sektors = Sektor::all();
        $wilayahs = Wilayah::all();
        return view('kesehatan_lingkungan.create', compact('sektors', 'wilayahs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sektor_id' => 'required|exists:sektors,id',
            'wilayah_id' => 'required|exists:wilayah,id',
            'description' => 'nullable|string',
            'air_quality' => 'nullable|numeric|min:0|max:500',
            'sanitation_level' => 'nullable|string',
            'waste_management' => 'nullable|string',
        ]);

        try {
            KesehatanLingkungan::create($validatedData);
            return redirect()->route('kesehatan_lingkungan.index')->with('success', 'Data Kesehatan Lingkungan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan data. Terjadi kesalahan server.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(KesehatanLingkungan $kesehatanLingkungan)
    {
        return view('kesehatan_lingkungan.show', compact('kesehatanLingkungan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KesehatanLingkungan $kesehatanLingkungan)
    {
        $sektors = Sektor::all();
        $wilayahs = Wilayah::all();
        return view('kesehatan_lingkungan.edit', compact('kesehatanLingkungan', 'sektors', 'wilayahs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KesehatanLingkungan $kesehatanLingkungan)
    {
        $validatedData = $request->validate([
            'sektor_id' => 'required|exists:sektors,id',
            'wilayah_id' => 'required|exists:wilayah,id',
            'description' => 'nullable|string',
            'air_quality' => 'nullable|numeric|min:0|max:500',
            'sanitation_level' => 'nullable|string',
            'waste_management' => 'nullable|string',
        ]);

        try {
            $kesehatanLingkungan->update($validatedData);
            return redirect()->route('kesehatan_lingkungan.show', $kesehatanLingkungan->id)->with('success', 'Data Kesehatan Lingkungan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KesehatanLingkungan $kesehatanLingkungan)
    {
        $kesehatanLingkungan->delete();
        return redirect()->route('kesehatan_lingkungan.index')->with('success', 'Data Kesehatan Lingkungan berhasil dihapus.');
    }
}
