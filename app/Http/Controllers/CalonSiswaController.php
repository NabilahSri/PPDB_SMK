<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;

class CalonSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // Ambil data Peserta dengan relasi SiswaRegister, dan filter berdasarkan tahun ajaran aktif
        $data = Peserta::whereHas('siswa_register.gelombang.tahun_ajaran', function ($query) {
            // Hanya ambil tahun ajaran yang aktif (status = true)
            $query->where('status', true);
        })
            ->with('siswa_register.gelombang.tahun_ajaran') // Eager loading untuk relasi
            ->get();

        return view('pages.admin.calon_siswa.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
