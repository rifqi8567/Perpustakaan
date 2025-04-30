<?php

namespace App\Http\Controllers;

use App\Models\Favorit;
use Illuminate\Http\Request;

class FavoritController extends Controller
{
    public function destroy($id)
{
    try {
        $favorit = Favorit::findOrFail($id);
        $favorit->delete();
        return redirect()->route('favorit.index')->with('successMessage', 'Buku berhasil dihapus dari daftar favorit.');
    } catch (\Exception $e) {
        return redirect()->route('favorit.index')->with('errorMessage', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

}
