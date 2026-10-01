<?php

namespace App\Http\Controllers;

use App\Models\SkemaSertifikasi;
use Illuminate\Http\Request;
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
            'kode_skema' => 'required|unique:skema_sertifikasis,kode_skema',
            'nama_skema' => 'required',
            'deskripsi' => 'nullable',
        ]);

        SkemaSertifikasi::create($request->all());

        return redirect()->route('skema-sertifikasi.index')
            ->with('succes', 'Skema berhasil ditambahkan');
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
        $skema = SkemaSertifikasi::findOrFail($id);

        $skema->delete();

        return redirect()->route('skema-sertifikasi.index')
            ->with('success', 'Skema berhasil dihapus');
    }
}
