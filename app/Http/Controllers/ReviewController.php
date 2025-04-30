<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'buku_id' => $id,
            'user_id' => Auth::id(),
            'rating' => $validated['rating'],
            'review' => $validated['review'],
        ]);

        return redirect()->back()->with('successMessage', 'Review berhasil ditambahkan.');
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);

        $review->delete();

        return redirect()->back()->with('successMessage', 'Review berhasil dihapus.');
    }

    public function edit($id)
    {
        // Menemukan review berdasarkan ID
        $review = Review::findOrFail($id);

        // Memastikan pengguna memiliki izin untuk mengedit review
        $this->authorize('update', $review);

        // Ambil data buku terkait (ini opsional, jika kamu ingin mengirimkan data buk u)
        $book = $review->book;

        // Kirimkan data review dan buku ke view
        return view('books.edit2', compact('review'));
    }
    
    public function update(Request $request, $id)
    {
        // Cari review berdasarkan ID
        $review = Review::findOrFail($id);
    
        // Validasi izin pengguna
        $this->authorize('update', $review);
    
        // Validasi input form
        try {
            $validatedData = $request->validate([
                'review' => 'required|string|max:1000',
                'rating' => 'required|integer|min:1|max:5',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }
        
    
        // Update data review
        $review->update($validatedData);
    
        // Pastikan relasi buku tersedia
        $book = $review->book; // Relasi `book` harus ada di model Review
        if (!$book) {
            return redirect()->back()->with('errorMessage', 'Buku terkait tidak ditemukan.');
        }
    
        // Redirect ke detail buku
        return redirect()->route('detail.buku', ['id' => $book->id])
            ->with('successMessage', 'Review berhasil diperbarui!');
    }
    
}
