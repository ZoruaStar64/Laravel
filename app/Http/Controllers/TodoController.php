<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index(Todo $todo) {
        $todo = Todo::all();
        return view('database')->with('todos', $todo);
    }

    public function create() {
        return view('create');
    }
    public function store() {
        try {
            $this->validate(request(), [
                'name' => ['required'],
                'category' => ['required'],
                'description' => ['required']
            ]);
        } catch (ValidationException $e) {

        }

        $data = request()->all();

        $todo = new Todo();

        $todo->name = $data['name'];
        $todo->category = $data['category'];
        $todo->description = $data['description'];
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
            $this->validate(request(), [
                'name' => ['required'],
                'category' => ['required'],
                'description' => ['required'],
            ]);
        } catch (ValiditionException $e) {

        }

        $data = request()->all();

        $todo->name = $data['name'];
        $todo->category = $data['category'];
        $todo->description = $data['description'];
        $todo->save();

        session()->flash('success', 'Todo updated succesfully!');

        return redirect('/database');
    }

    public function check(Todo $todo) {
        try {
            $this->validate(request(), [
                'checked' => ['required'],
            ]);
        } catch (ValiditionException $e) {

        }
        $data = request()->all();
        if($data['checked'] == 0) {
            $data['checked'] = 1;
        } elseif($data['checked'] == 1) {
            $data['checked'] = 0;
        }

        $todo->checked = $data['checked'];
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
