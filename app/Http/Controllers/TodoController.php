<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data= Todo::get();
       $incomplete= $data->where('status','0')->count('status');
       $complete= $data->where('status','1')->count('status');


        return view('Todo.index',[
            'todos' => $data,
            'incomplete' => $incomplete,
            'complete' => $complete
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
        try {
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'description' => 'nullable|max:255',
            ]);
            Todo::create($validatedData);
            return to_route('todo.index')->with('success', 'Todo created successfully.');
        }
        catch (\Exception $e) {
            return to_route('todo.index')->with('error', $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return response()->json($todo,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
       return response()->json($todo,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable|max:255',
        ]);

        $todo->update($validatedData);
        return to_route('todo.index')->with('success', 'Todo updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return to_route('todo.index')->with('success', 'Todo deleted successfully.');
    }

    public function status ($id)

    {
        $todo = Todo::find($id);
        $todo->status == 1 ? $todo->update(['status' => 0]) : $todo->update(['status' => 1]);

        return to_route('todo.index')->with('success', 'Todo updated successfully.');
    }
}
