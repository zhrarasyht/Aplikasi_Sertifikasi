<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\SkemaSertifikasi;
use App\Models\User;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');

        if($search){
            $pesertas = Peserta::with('skemaSertifikasi')
                ->where('nama_peserta', 'like', "%$search%") //Cari sesuai nama peserta
                ->orWhere('nisn', 'like', "%$search%") //atau Mencari sesuai NISN
                ->get(); //mengambil data
        }else{
            $pesertas = Peserta::with('skemaSertifikasi')->get(); //Mengambil peserta + skema
        }

        return view('peserta.index', compact('pesertas', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $skemas = SkemaSertifikasi::all();

        $users = User::where('role', 'user')
            ->orderBy('name')
            ->get();

        return view('peserta.create', compact('skemas', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_peserta' => 'required|string|max:50',
            'nisn' => 'required|numeric|digits:10|unique:pesertas',
            'no_telepon' => 'nullable|regex:/^[0-9]{1,13}$/',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'skema_sertifikasi_id' => 'required|exists:skema_sertifikasis,id',
            'user_id' => 'nullable|exists:users,id|unique:pesertas,user_id',
        ]);

        Peserta::create($request->all());

        return redirect()->route('peserta.index')
            ->with('success', 'Data peserta berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $peserta = Peserta::with('skemaSertifikasi')->findOrFail($id);

        return view('peserta.show', compact('peserta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $peserta = Peserta::findOrFail($id);
        $skemas = SkemaSertifikasi::all();

        $users = User::where('role', 'user')
            ->orderBy('name')
            ->get();

        return view('peserta.edit', compact('peserta', 'skemas', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $peserta = Peserta::findOrFail($id);

        $request->validate([
            'nama_peserta' => 'required|string|max:50',
            'nisn' => 'required|numeric|digits:10|unique:pesertas,nisn,' . $peserta->id,
            'no_telepon' => 'nullable|regex:/^[0-9]{1,13}$/',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'skema_sertifikasi_id' => 'required|exists:skema_sertifikasis,id',
            'user_id' => 'nullable|exists:users,id|unique:pesertas,user_id,' . $peserta->id,
        ]);

        $peserta->update($request->all());

        return redirect()->route('peserta.index')
            ->with('success', 'Data peserta berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peserta = Peserta::findOrFail($id);
        $peserta->delete();

        return redirect()->route('peserta.index')
            ->with('success', 'Data peserta berhasil dihapus.');
    }
}
