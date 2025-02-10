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

    public function show($id) {
        $task = Task::findOrFail($id);

        $data = [
            'title' => 'Details',
            'task' => $task,
            
        ];          

        return view('pages.details', $data);
    }
}
