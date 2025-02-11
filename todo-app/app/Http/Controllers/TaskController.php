<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    
    public function index() {
        $data = [
            'title' => 'Home',
            'lists' => TaskList::all(),
            'tasks' => Task::orderBy('created_at', 'desc')->get(),
            'priorities' => Task::PRIORITIES
        ];

        return view('pages.home', $data);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'required|max:100',
            'priority' => 'required|in:low,medium,high',
            'list_id' => 'required'
        ]);

        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'priority' => $request->priority,
            'list_id' => $request->list_id
        ]);


        return redirect()->back();
    }

    public function complete($id) {
        Task::findOrFail($id)->update([
            'is_completed' => true
        ]);

        return redirect()->back();
    }

    public function destroy($id) {
        Task::findOrFail($id)->delete();

        return redirect()->back();
    }
    public function edit(Task $task)
{
    // Logika untuk menampilkan halaman edit tugas
    return view('tasks.edit', compact('task'));
}

    public function show($id) {
        $task = Task::findOrFail($id);

        $data = [
            'title' => 'Details',
            'task' => $task,
        ];

        return view('pages.details', $data);
}
public function update(Request $request, $id)
{
    // Mencari task berdasarkan ID
    $task = Task::findOrFail($id);

    // Validasi data yang dikirimkan
    $validatedData = $request->validate([
        'name' => 'required|max:255',  // Gantilah sesuai dengan kolom yang ada
        'description' => 'nullable|max:500',
    ]);

    // Update data task
    $task->name = $validatedData['name'];
    $task->description = $validatedData['description'];
    $task->save();  // Menyimpan perubahan ke database

    // Redirect ke halaman yang sesuai, bisa juga menambahkan flash message atau status
    return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
}
}