<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogVisitor
{
    public function handle($request, Closure $next)
    {

        if (!session()->has('logged_visit')) {
            session(['logged_visit' => true]);

            // Logika penambahan visitor
        }
        // Dapatkan tanggal hari ini
        $today = now()->toDateString();

        // Periksa apakah sudah ada record untuk hari ini
        $visitor = Visitor::where('date', $today)->first();

        if ($visitor) {
            // Jika sudah ada, tambahkan jumlah pengunjung
            $visitor->increment('count');
        } else {
            // Jika belum ada, buat record baru
            Visitor::create([
                'date' => $today,
                'count' => 1,
            ]);
        }

        return $next($request);
    }
}
