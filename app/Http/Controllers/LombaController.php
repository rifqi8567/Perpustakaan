<?php

namespace App\Http\Controllers;

use App\Models\Lomba;
use App\Http\Requests\StoreLombaRequest;
use App\Http\Requests\UpdateLombaRequest;
use Illuminate\Http\Request;

class LombaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Lomba::all();
        return view('books.index',[
            'data' => $data
        ]);
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
    public function store(StoreLombaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Lomba $lomba)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Lomba::find($id);
        return view('books.lomba',[
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'judul' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
            'kuotes' => 'nullable|string|max:255',
            'hadiah' => 'nullable|string|max:255',
        ]);
    
        try {
    
           {
    
               
            // Cari buku berdasarkan ID
            $data = Lomba::findOrFail($id);
    
            // Update data buku
            $data->judul = $validated['judul'];
            $data->subtitle = $validated['subtitle'];
            $data->deskripsi = $validated['deskripsi'];
            $data->kuotes = $validated['kuotes'];
            $data->hadiah = $validated['hadiah'];
            $data->save();
            }
            // Redirect ke halaman list buku dengan pesan sukses
            return redirect()->route('view.lomba')->with('successMessage', 'Data buku berhasil diperbarui.');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, redirect dengan pesan error
            return redirect()->route('view.lomba')->with('errorMessage', 'Terjadi kesalahan: ' . $e->getMessage());
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lomba $lomba)
    {
        //
    }
}
