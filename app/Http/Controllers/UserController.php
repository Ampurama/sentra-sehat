<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:super_admin');
    }

    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = User::with(['role', 'wilayah'])->paginate(15);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new puskesmas admin user.
     */
    public function createPuskesmasAdmin()
    {
        $kecamatans = Wilayah::select('nama_kecamatan')->distinct()->get();
        return view('users.create_puskesmas_admin', compact('kecamatans'));
    }

    /**
     * Store a newly created puskesmas admin user.
     */
    public function storePuskesmasAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nik' => 'required|string|max:20|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'nama_kecamatan' => 'required|string|exists:wilayah,nama_kecamatan',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $rolePuskesmas = Role::where('name', 'puskesmas_admin')->first();
        if (!$rolePuskesmas) {
            return redirect()->back()->with('error', 'Role puskesmas_admin tidak ditemukan.');
        }

        $wilayah = Wilayah::where('nama_kecamatan', $request->nama_kecamatan)->first();
        if (!$wilayah) {
            return redirect()->back()->with('error', 'Wilayah tidak ditemukan.');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'password' => Hash::make($request->password),
            'role_id' => $rolePuskesmas->id,
            'wilayah_id' => $wilayah->id,
        ]);

        return redirect()->route('home')->with('success', 'Admin Puskesmas berhasil ditambahkan.');
    }

    /**
     * Show the form for creating a new kades user.
     */
    public function createKades()
    {
        $desas = Wilayah::all();
        return view('users.create_kades', compact('desas'));
    }

    /**
     * Store a newly created kades user.
     */
    public function storeKades(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nik' => 'required|string|max:20|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'wilayah_id' => 'required|exists:wilayah,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $roleKades = Role::where('name', 'kades')->first();
        if (!$roleKades) {
            return redirect()->back()->with('error', 'Role kades tidak ditemukan.');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nik' => $request->nik,
            'password' => Hash::make($request->password),
            'role_id' => $roleKades->id,
            'wilayah_id' => $request->wilayah_id,
        ]);

        return redirect()->route('home')->with('success', 'Kepala Desa berhasil ditambahkan.');
    }

    /**
     * Show the form for editing a user.
     */
    public function edit($id)
    {
        $user = User::with(['role', 'wilayah'])->findOrFail($id);

        // Only allow editing of puskesmas_admin, kades, and patient roles
        if (!in_array($user->role->name, ['puskesmas_admin', 'kades', 'patient'])) {
            abort(403, 'Tidak dapat mengedit pengguna dengan role ini.');
        }

        if ($user->role->name == 'puskesmas_admin') {
            $kecamatans = Wilayah::select('nama_kecamatan')->distinct()->get();
            return view('users.edit_puskesmas_admin', compact('user', 'kecamatans'));
        } elseif ($user->role->name == 'kades') {
            $desas = Wilayah::all();
            return view('users.edit_kades', compact('user', 'desas'));
        } else {
            $desas = Wilayah::all();
            return view('users.edit_patient', compact('user', 'desas'));
        }
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, $id)
    {
        $user = User::with('role')->findOrFail($id);

        // Only allow editing of puskesmas_admin, kades, and patient roles
        if (!in_array($user->role->name, ['puskesmas_admin', 'kades', 'patient'])) {
            abort(403, 'Tidak dapat mengedit pengguna dengan role ini.');
        }

        if ($user->role->name == 'puskesmas_admin') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'nik' => 'required|string|max:20|unique:users,nik,' . $user->id,
                'nama_kecamatan' => 'required|string|exists:wilayah,nama_kecamatan',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'nik' => 'required|string|max:20|unique:users,nik,' . $user->id,
                'wilayah_id' => 'required|exists:wilayah,id',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($user->role->name == 'puskesmas_admin') {
            $wilayah = Wilayah::where('nama_kecamatan', $request->nama_kecamatan)->first();
            $user->wilayah_id = $wilayah->id;
        } else {
            $user->wilayah_id = $request->wilayah_id;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->nik = $request->nik;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified user.
     */
    public function destroy($id)
    {
        $user = User::with('role')->findOrFail($id);

        // Only allow deletion of puskesmas_admin, kades, and patient roles
        if (!in_array($user->role->name, ['puskesmas_admin', 'kades', 'patient'])) {
            abort(403, 'Tidak dapat menghapus pengguna dengan role ini.');
        }

        // Prevent deletion of the current logged-in user
        if ($user->id == auth()->id()) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
