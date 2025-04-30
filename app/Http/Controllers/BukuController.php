<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use App\Models\createbuku;
use App\Models\Lomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Favorit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Lomba::all();
        return view('books.index', [
            'data' => $data
        ]);
    }
    public function view(Request $request)
    {
        // Ambil filter dari request
        $searchQuery = $request->input('search');
        $tahunFilter = $request->input('tahun');
        $penerbitFilter = $request->input('penerbit');
        $sort = $request->input('sort');
    
        // Query buku
        $query = createbuku::query();
    
        // Filter berdasarkan search, tahun, atau penerbit
        if ($searchQuery) {
            $query->where('judul_buku', 'like', "%{$searchQuery}%")
                  ->orWhere('nama_penerbit', 'like', "%{$searchQuery}%")
                  ->orWhere('tahun_diterbitkan', 'like', "%{$searchQuery}%");
        }
        if ($tahunFilter) {
            $query->where('tahun_diterbitkan', $tahunFilter);
        }
        if ($penerbitFilter) {
            $query->where('nama_penerbit', $penerbitFilter);
        }
    
        // Sortir berdasarkan pilihan
        if ($sort == 'judul_buku_asc') {
            $query->orderBy('judul_buku', 'asc');
        } elseif ($sort == 'judul_buku_desc') {
            $query->orderBy('judul_buku', 'desc');
        } elseif ($sort == 'tahun_asc') {
            $query->orderBy('tahun_diterbitkan', 'asc');
        } elseif ($sort == 'tahun_desc') {
            $query->orderBy('tahun_diterbitkan', 'desc');
        }
    
        // Ambil data buku dengan pagination
        $data = $query->paginate(8)->appends($request->except('page'));

    
        // Ambil data favorit untuk user yang sedang login
        $favorit = Favorit::with('buku')->where('user_id', Auth::id())->get();
    
        // Kirim data ke view
        return view('books.data', [
            'data' => $data,
            'searchQuery' => $searchQuery,
            'tahunFilter' => $tahunFilter,
            'penerbitFilter' => $penerbitFilter,
            'sort' => $sort,
            'tahunOptions' => createbuku::select('tahun_diterbitkan')->distinct()->pluck('tahun_diterbitkan'),
            'penerbitOptions' => createbuku::select('nama_penerbit')->distinct()->pluck('nama_penerbit'),
            'favorit' => $favorit, // Tambahkan data favorit ke view
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_buku' => 'required|string|max:255',
            'nama_penerbit' => 'required|string|max:255',
            'tahun_diterbitkan' => 'required|string|max:255',
            'jumlah_halaman' => 'nullable|string|max:255',
            'upload_file' => 'nullable|string|max:255',
            'upload_gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'judul_buku.required' => 'Judul Buku wajib diisi.',
            'nama_penerbit.required' => 'Nama penerbit wajib diisi.',
            'tahun_diterbitkan.required' => 'Tahun Diterbitkan wajib diisi.',
            'upload_gambar.required' => 'Gambar wajib diisi.',
        ]);

        try {
            $imagePath = $request->file('upload_gambar')->store('images', 'public');

            $data = createbuku::create([
                'judul_buku' => $validated['judul_buku'],
                'nama_penerbit' => $validated['nama_penerbit'],
                'tahun_diterbitkan' => $validated['tahun_diterbitkan'],
                'jumlah_halaman' => $validated['jumlah_halaman'],
                'upload_file' => $validated['upload_file'],
                'upload_gambar' => $imagePath,
            ]);

            return redirect()->route('form.buku')->with('successMessage', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->route('form.buku')->with('errorMessage', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     */
    public function detail($id)
    {
        // Cari data berdasarkan ID
        $data = createbuku::find($id);
    
        // Jika data tidak ditemukan, hentikan eksekusi dan tampilkan pesan
        if (!$data) {
            dd("Data dengan ID $id tidak ditemukan.");
        }
    
        // Debugging untuk memastikan ID ditemukan
        // dd($data->id);
    
        // Jika data ditemukan, lanjutkan dengan mengembalikan view
        return view('books.detail', ['data' => $data]);
    }


    /**
     * Show the form for editing the specified resource.
     */




    public function edit($id)
    {

        // Cari data berdasarkan ID
        $data = createbuku::findOrFail($id);

        // Tampilkan view edit dengan data yang ditemukan
        return view('books.edit1', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input form
        $validated = $request->validate([
            'judul_buku' => 'nullable|string|max:255',
            'nama_penerbit' => 'nullable|string|max:255',
            'tahun_diterbitkan' => 'nullable|string|max:255',
            'jumlah_halaman' => 'nullable|string|max:255',
            'upload_file' => 'nullable|string|max:255',
            'upload_gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try { {


                // Cari buku berdasarkan ID
                $data = createbuku::findOrFail($id);

                // Update data buku
                $data->judul_buku = $validated['judul_buku'];
                $data->nama_penerbit = $validated['nama_penerbit'];
                $data->tahun_diterbitkan = $validated['tahun_diterbitkan'];
                $data->jumlah_halaman = $validated['jumlah_halaman'];
                $data->upload_file = $validated['upload_file'];
                $data->save();
            }
            // Redirect ke halaman list buku dengan pesan sukses
            return redirect()->route('data.buku')->with('successMessage', 'Data buku berhasil diperbarui.');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, redirect dengan pesan error
            return redirect()->route('data.buku')->with('errorMessage', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            // Hapus data yang terkait di tabel `favorits`
            DB::table('favorits')->where('buku_id', $id)->delete();

            // Hapus data dari tabel `createbukus`
            DB::table('createbukus')->where('id', $id)->delete();

            // Redirect dengan pesan sukses
            return redirect()->back()->with('successMessage', 'Buku berhasil dihapus.');
        } catch (\Exception $e) {
            // Redirect dengan pesan kesalahan
            return redirect()->back()->with('errorMessage', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }

    public function addToFavorit($id)
    {
        try {
            // Periksa apakah sudah ada di favorit
            $existingFavorit = Favorit::where('user_id', Auth::id())
                ->where('buku_id', $id)
                ->first();

            if ($existingFavorit) {
                return redirect()->back()->with('errorMessage', 'Buku ini sudah ada di daftar favorit.');
            }

            // Tambahkan ke favorit
            Favorit::create([
                'user_id' => Auth::id(),
                'buku_id' => $id,
            ]);

            return redirect()->back()->with('successMessage', 'Buku berhasil ditambahkan ke favorit.');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function showFavorit()
    {
        $favorit = Favorit::with('buku')
        ->where('user_id', Auth::id())
        ->get();
    
        
        return view('books.favorit', [
            'favorit' => $favorit,
        ]);
    }
    


    
}
