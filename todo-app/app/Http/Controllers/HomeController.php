    <?php

// app/Http/Controllers/HomeController.php
namespace App\Http\Controllers;

use App\Models\Item; // Model untuk data yang ingin dicari
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Menampilkan halaman utama
        return view('pages.home');
    }

    public function search(Request $request)
    {
        // Mengambil input pencarian
        $searchTerm = $request->input('search');
        
        // Menemukan data yang sesuai dengan pencarian
        $results = Item::where('name', 'like', "%{$searchTerm}%")->get();
        
        // Mengirimkan hasil pencarian ke view
        return view('home', compact('results'));
    }
}