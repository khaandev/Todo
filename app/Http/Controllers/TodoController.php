<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::get();

        return Inertia::render('app/todo/Index',['todos' =>$todos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return Inertia::render('app/todo/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            'title' => 'required|max:225',
            'description' => 'max:225',
             'due_date'    => 'required|date|after_or_equal:today',

        ]);

        $validate['user_id'] = auth()->id();



        Todo::create($validate);



        return redirect()->route('todos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {

        return Inertia::render('app/todo/Edit',[
            'todo' => $todo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {

        $validated = $request->validate([
            'title' => 'required|max:225',
            'description' => 'max:225',
            'due_date'    => 'required|date|after_or_equal:today',

        ]);

        $validated['user_id'] = auth()->id();

        $todo->update($validated);


        return redirect()->route('todos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todos.index');

    }
}
