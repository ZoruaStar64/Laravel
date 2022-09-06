<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index(Todo $todo) {
        $allTodos = Todo::all();
        $finishedTodos = $allTodos->filter(function($todo, $key) {
            return $todo->checked == 1;
        });
        $unfinishedTodos =  $allTodos->filter(function($todo, $key) {
            return $todo->checked == 0;
        });
        return view('database')->with('finishedTodos', $finishedTodos)->with('unfinishedTodos', $unfinishedTodos);
    }

    public function create() {
        return view('create');
    }


    public function store() {
        try {
           $data = $this->validate(request(), [
                'name' => ['required'],
                'category' => ['required'],
                'description' => ['required']
            ]);
        } catch (ValidationException $e) {
            return response()->json($e->errors());
        }

        $todo = Todo::create($data);
        $todo->save();

        session()->flash('success', 'Todo created succesfully!');

        return redirect('/database');
    }

    public function details(Todo $todo) {
        return view('details')->with('todos', $todo);
    }

    public function edit(Todo $todo) {
        return view('edit')->with('todos', $todo);
    }

    public function update(Todo $todo) {
        
        try {
            $data = $this->validate(request(), [
                'name' => ['required'],
                'category' => ['required'],
                'description' => ['required'],
            ]);
        } catch (ValidationException $e) {
            return response()->json($e->errors());
        }

        $todo->name = $data['name'];
        $todo->category = $data['category'];
        $todo->description = $data['description'];

        $todo->save();

        session()->flash('success', 'Todo updated succesfully!');

        return redirect('/database');
    }

    public function check(Todo $todo) {
        try {
           $data = $this->validate(request(), [
                'checked' => ['required', "numeric", "max:1"],
            ]);
        } catch (ValidationException $e) {
            return response()->json($e->errors());
        }


        $todo->checked = (int)!$data['checked'];
        $todo->save();

        session()->flash('success', "Task succesfully checked/unchecked!");
        return redirect('/database');
    }

    public function delete(Todo $todo) {
        
        $todo->delete();

        session()->flash('success', 'Todo deleted succesfully!');

        return redirect('/database');
    }
}
