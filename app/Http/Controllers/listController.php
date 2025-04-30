<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class listController extends Controller
{
    public function index()
    {   
        $data = Pendaftaran::all();
        return view('books.list', [
            'data'=>$data
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'password' => 'nullable|string|max:255',
            'school' => 'required|string|max:255',
            'email' => 'required|email|max:5000',
        ], [
            'first_name.required' => 'Nama pendaftar wajib diisi.',
            'last_name.required' => 'Nama pendaftar wajib diisi.',
            'city.required' => 'Kota pendaftar wajib diisi.',
            'password.required' => 'password wajib diisi.',
            'school.required' => 'Sekolah wajib diisi.',
            'email.email' => 'Email Wajib Diisi.',
            'email.email' => 'Email Tidak Valid.',
        ]);

        try {
            // Simpan data ke database
            $data = new Pendaftaran(); // Ganti dengan model yang sesuai
            $data->first_name = $validated['first_name'];
            $data->last_name = $validated['last_name'];
            $data->city = $validated['city'];
            $data->password = $validated['password'];
            $data->school = $validated['school'];
            $data->email = $validated['email'];
            $data->save();
    
            // Update status di tabel lain jika diperlukan
    
            return redirect()->route('book')->with('successMessage', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->route('book')->with(['errorMessage', 'Terjadi kesalahan: ' . $e->getMessage()]);
        
        }

    }
    public function destroy($id)
    {
        try {
            // Cari data berdasarkan ID
            $data = Pendaftaran::findOrFail($id);
            
            // Hapus data dari database
            $data->delete();
    
            // Redirect dengan flash message sukses
            return redirect()->route('book')->with('successMessage', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, redirect dengan flash message error
            return redirect()->route('book')->with('errorMessage', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
{
    // Cari data berdasarkan ID
    $data = Pendaftaran::findOrFail($id);
    
    // Kembalikan ke view dengan membawa data yang ingin diedit
    return view('books.edit', [
        'data' => $data
    ]);
}

public function update(Request $request, $id)
{
    // Validasi data
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'password' => 'nullable|string|max:255',
        'school' => 'required|string|max:255',
        'email' => 'required|email|max:5000',
    ], [
        'first_name.required' => 'Nama pendaftar wajib diisi.',
        'last_name.required' => 'Nama pendaftar wajib diisi.',
        'city.required' => 'Kota pendaftar wajib diisi.',
        'password.required' => 'password wajib diisi.',
        'school.required' => 'Sekolah wajib diisi.',
        'email.email' => 'Email Wajib Diisi.',
        'email.email' => 'Email Tidak Valid.',
    ]);

    try {
        // Cari data berdasarkan ID
        $data = Pendaftaran::findOrFail($id);

        // Update data yang ada
        $data->first_name = $validated['first_name'];
        $data->last_name = $validated['last_name'];
        $data->city = $validated['city'];
        $data->password = $validated['password'];
        $data->school = $validated['school'];
        $data->email = $validated['email'];
        $data->save();

        // Redirect dengan flash message sukses
        return redirect()->route('book')->with('successMessage', 'Data berhasil diperbarui.');
    } catch (\Exception $e) {
        // Jika terjadi kesalahan, redirect dengan flash message error
        return redirect()->route('book')->with('errorMessage', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

}
