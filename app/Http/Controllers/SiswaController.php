<?php

namespace App\Http\Controllers;

use App\Models\Hasil;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusans = Jurusan::all();
        $data = Hasil::with('peserta')->get();
        $total_daftar_ulang = Hasil::where('daftar_ulang', '1')->get()->count();
        $total_calon_siswa = Hasil::Count();

        $programsCount = DB::table('jurusans')  // Start from the 'jurusans' table
            ->leftJoin('hasils', 'hasils.id_program', '=', 'jurusans.id')  // Left join with 'hasils' table
            ->select('jurusans.singkatan', DB::raw('count(hasils.id) as count'))  // Count 'hasils' ids
            ->groupBy('jurusans.id', 'jurusans.singkatan')  // Group by jurusan id and name
            ->get();


        return view('pages.admin.siswa.index', compact('data', 'jurusans', 'programsCount', 'total_daftar_ulang', 'total_calon_siswa'));
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
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'program' => 'required|string|max:255',
        ]);

        // Find the student by ID and update the program
        $student = Hasil::findOrFail($id);
        $student->program = $request->input('program');
        $student->save();

        // Redirect or return a response after successful update
        return redirect()->route('siswa.index')
            ->with('success', 'Siswa berhasil diubah');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function toggleDaftarUlang($id)
    {
        $siswa = Hasil::findOrFail($id);
        $siswa->daftar_ulang = !$siswa->daftar_ulang; // Toggle the status
        $siswa->save();

        return redirect()->back()->with('success', 'Daftar ulang status berhasil diupdate.');
    }
}
