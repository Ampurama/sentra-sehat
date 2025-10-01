<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use App\Models\Sektor;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyakits = Penyakit::with('sektor')->latest()->paginate(10);
        return view('penyakit.index', compact('penyakits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sektors = Sektor::all();
        return view('penyakit.create', compact('sektors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sektor_id' => 'required|exists:sektors,id',
            'name' => 'required|string|max:255',
            'icd_code' => 'nullable|string|max:255',
            'spesialisasi' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'symptoms' => 'nullable|string',
            'prevalence' => 'nullable|numeric|min:0|max:1',
        ]);

        try {
            Penyakit::create($validatedData);
            return redirect()->route('penyakit.index')->with('success', 'Data Penyakit berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan data. Terjadi kesalahan server.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Penyakit $penyakit)
    {
        $penyakit->load('tindakanIntervensis.pasien');

        // Get unique patients with their latest intervention date
        $patients = collect();
        foreach ($penyakit->tindakanIntervensis as $intervensi) {
            $pasienId = $intervensi->pasien_id;
            if (!$patients->has($pasienId)) {
                $patients[$pasienId] = [
                    'pasien' => $intervensi->pasien,
                    'latest_date' => $intervensi->tgl_tindakan
                ];
            } elseif ($intervensi->tgl_tindakan > $patients[$pasienId]['latest_date']) {
                $patients[$pasienId]['latest_date'] = $intervensi->tgl_tindakan;
            }
        }
        $patients = $patients->values();

        return view('penyakit.show', compact('penyakit', 'patients'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penyakit $penyakit)
    {
        $sektors = Sektor::all();
        return view('penyakit.edit', compact('penyakit', 'sektors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penyakit $penyakit)
    {
        $validatedData = $request->validate([
            'sektor_id' => 'required|exists:sektors,id',
            'name' => 'required|string|max:255',
            'icd_code' => 'nullable|string|max:255',
            'spesialisasi' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'symptoms' => 'nullable|string',
            'prevalence' => 'nullable|numeric|min:0|max:1',
        ]);

        try {
            $penyakit->update($validatedData);
            return redirect()->route('penyakit.show', $penyakit->id)->with('success', 'Data Penyakit berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penyakit $penyakit)
    {
        $penyakit->delete();
        return redirect()->route('penyakit.index')->with('success', 'Data Penyakit berhasil dihapus.');
    }
}
