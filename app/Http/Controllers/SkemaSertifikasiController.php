<?php

namespace App\Http\Controllers;

use App\Models\SkemaSertifikasi;
use Illuminate\Http\Request;
use App\Models\Peserta;
use Illuminate\Validation\Rule;

class SkemaSertifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skemas = SkemaSertifikasi::all();

        return view('skema.index', compact('skemas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('skema.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_skema' => 'required|unique:skema_sertifikasis,kode_skema', //Wajib di isi dan harus Unik
            'nama_skema' => 'required',
            'deskripsi' => 'nullable', //ga boleh kosong
        ]);

        SkemaSertifikasi::create($request->all());

        return redirect()->route('skema-sertifikasi.index')
            ->with('success', 'Skema berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $skema = SkemaSertifikasi::findOrFail($id);

        return view('skema.show', compact('skema'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $skema = SkemaSertifikasi::findOrFail($id);

        return view('skema.edit', compact('skema'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $skema = SkemaSertifikasi::findOrFail($id);

        $request->validate([
            'kode_skema' => [
                'required',
                Rule::unique('skema_sertifikasis', 'kode_skema')
                    ->ignore($skema->id),
            ],
            'nama_skema' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $skema->update($request->all());

        return redirect()->route('skema-sertifikasi.index')
            ->with('success', 'Skema berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari skema sertifikasi berdasarkan ID
    $skema = SkemaSertifikasi::findOrFail($id);

    // Periksa apakah skema masih digunakan oleh peserta
    $masihDigunakan = Peserta::where(
        'skema_sertifikasi_id',
        $skema->id
    )->exists();

    if ($masihDigunakan) {
        return redirect()
            ->route('skema-sertifikasi.index')
            ->with(
                'error',
                'Skema tidak dapat dihapus karena masih digunakan oleh peserta.'
            );
    }

    // Hapus skema jika tidak digunakan
    $skema->delete();

    return redirect()
        ->route('skema-sertifikasi.index')
        ->with('success', 'Skema berhasil dihapus.');
}
}
