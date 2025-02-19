<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Menampilkan daftar tugas (tasks) dan daftar tugas (task lists)
    public function index(Request $request)
    {
        $query = $request->input('query'); // Ambil parameter pencarian dari request

        if ($query) {
            // Cari tugas berdasarkan nama atau deskripsi yang cocok dengan query
            $tasks = Task::where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->latest()
                ->get();

            // Cari daftar tugas yang cocok atau mengandung tugas yang cocok
            $lists = TaskList::where('name', 'like', "%{$query}%")
                ->orWhereHas('tasks', function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                })
                ->with('tasks')
                ->get();

            // Jika tidak ada task yang cocok, load semua tasks dalam list
            if ($tasks->isEmpty()) {
                $lists->load('tasks');
            } else {
                // Filter task berdasarkan pencarian dalam list
                $lists->load(['tasks' => function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                }]);
            }
        } else {
            // Jika tidak ada pencarian, ambil semua tugas dan daftar tugas
            $tasks = Task::latest()->get();
            $lists = TaskList::with('tasks')->get();
        }

        // Data yang dikirim ke view
        $data = [
            'title' => 'Home',
            'lists' => $lists,
            'tasks' => $tasks,
            'priorities' => Task::PRIORITIES
        ];

        return view('pages.home', $data); // Tampilkan halaman home dengan data
    }

    // Menyimpan tugas baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'max:255',
            'list_id' => 'required'
        ]);

        // Buat tugas baru
        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'priority' => $request->priority,
            'list_id' => $request->list_id
        ]);

        return redirect()->back(); // Kembali ke halaman sebelumnya
    }

    // Menandai tugas sebagai selesai
    public function complete($id)
    {
        Task::findOrFail($id)->update([
            'is_completed' => true
        ]);

        return redirect()->back(); // Kembali ke halaman sebelumnya
    }

    // Menghapus tugas
    public function destroy($id)
    {
        Task::findOrFail($id)->delete();

        return redirect()->route('home'); // Kembali ke halaman utama
    }

    // Menampilkan detail tugas
    public function show($id)
    {
        $data = [
            'title' => 'Task',
            'lists' => TaskList::all(),
            'task' => Task::findOrFail($id),
        ];

        return view('pages.details', $data); // Tampilkan halaman detail tugas
    }

    // Mengubah daftar tugas (memindahkan tugas ke list lain)
    public function changeList(Request $request, Task $task)
    {
        // Validasi input
        $request->validate([
            'list_id' => 'required|exists:task_lists,id',
        ]);

        // Update list_id tugas
        Task::findOrFail($task->id)->update([
            'list_id' => $request->list_id
        ]);

        return redirect()->back()->with('success', 'List berhasil diperbarui!');
    }

    // Memperbarui data tugas
    public function update(Request $request, Task $task)
    {
        // Validasi input
        $request->validate([
            'list_id' => 'required',
            'name' => 'required|max:100',
            'description' => 'max:255',
            'priority' => 'required|in:low,medium,high' // Prioritas harus salah satu dari low, medium, atau high
        ]);

        // Update tugas dengan data baru
        Task::findOrFail($task->id)->update([
            'list_id' => $request->list_id,
            'name' => $request->name,
            'description' => $request->description,
            'priority' => $request->priority
        ]);

        return redirect()->back()->with('success', 'Task berhasil diperbarui!');
    }
}

// index() → Menampilkan daftar tugas dan task list (bisa dengan pencarian).
// store() → Menyimpan tugas baru setelah validasi.
// complete() → Menandai tugas sebagai selesai.
// destroy() → Menghapus tugas berdasarkan ID.
// show() → Menampilkan detail tugas tertentu.
// changeList() → Memindahkan tugas ke daftar tugas lain.
// update() → Memperbarui tugas dengan validasi prioritas.