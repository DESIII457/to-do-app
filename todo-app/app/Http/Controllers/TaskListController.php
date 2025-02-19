<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskListController extends Controller
{
    // Menyimpan daftar tugas baru
    public function store(Request $request) {
        // Validasi input: 'name' wajib diisi & maksimal 100 karakter
        $request->validate([
            'name' => 'required|max:100',
        ]);

        // Membuat daftar tugas baru
        TaskList::create([
            'name' => $request->name,
        ]);

        return redirect()->back(); // Kembali ke halaman sebelumnya
    }

    // Menghapus daftar tugas berdasarkan ID
    public function destroy($id) {
        // Cari daftar tugas berdasarkan ID, jika tidak ada akan error 404
        TaskList::findOrFail($id)->delete();

        return redirect()->back(); // Kembali ke halaman sebelumnya
    }
}

// store() → Menyimpan daftar tugas baru dengan validasi nama maksimal 100 karakter.
// destroy() → Menghapus daftar tugas berdasarkan ID