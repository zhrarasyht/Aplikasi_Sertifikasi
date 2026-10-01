<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\SkemaSertifikasi;
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
                ->where('nama_peserta', 'like', "%$search")
                ->orWhere('nisn', 'like', "%$search")
                ->get();
        }else{
            $pesertas = Peserta::with('skemaSertifikasi')->get();
        }

        return view('peserta.index', compact('pesertas', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $skemas = SkemaSertifikasi::all();

        return view('peserta.create', compact('skemas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_peserta' => 'required',
            'nisn' => 'required|digits:10|unique:pesertas',
            'jenis_kelamin' => 'required',
            'skema_sertifikasi_id' => 'required|exists:skema_sertifikasis,id',
        ]);

        Peserta::create($request->all());

        return redirect()->route('peserta.index')
            ->with('succes', 'Data peserta berhasil ditambahkan.');
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

        return view('peserta.edit', compact('peserta', 'skemas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $peserta = Peserta::findOrFail($id);

        $request->validate([
            'nama_peserta' => 'required',
            'nisn' => 'required|digits:10|unique:pesertas,nisn,' . $peserta->id,
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'skema_sertifikasi_id' => 'required|exists:skema_sertifikasis,id'
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
