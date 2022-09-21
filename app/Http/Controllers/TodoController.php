<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;

class TodoController extends Controller
{
    public function index() {
        $allCategories = Category::all();
        $allTodos = Todo::with('category')->with('tags')->get();
     
        $finishedTodos = $allTodos->filter(function($todo, $key) {
            return $todo->checked == 1;
        });
        $unfinishedTodos =  $allTodos->filter(function($todo, $key) {
            return $todo->checked == 0;
        });
        return view('database')->with('finishedTodos', $finishedTodos)->with('unfinishedTodos', $unfinishedTodos)->with('categories', $allCategories);
    }

    public function create() {
        $allCategories = Category::all();
        return view('create',[
            'categories' => $allCategories
        ]);
    }

    public function store() {
        try {
           $data = $this->validate(request(), [
                'name' => ['required'],
                'categories_id' => ['required', "numeric"],
                'description' => ['required']
            ]);
        } catch (ValidationException $e) {
            return response()->json($e->errors());
        }

        $todo = Todo::create($data);
        $todo->save();

        session()->flash('success', 'Todo created succesfully!');
        return redirect('/todos');
    }

    public function details(Todo $todo) {    
        return view('details',[
            'todos' => $todo,
        ]);
    }

    public function edit($todoID) { 
        $allCategories = Category::all();
        $currentTodo = Todo::with('category')
        ->with('tags')
        ->withCount('tags')
        ->find($todoID);

        return view('edit',[
            'todos' => $currentTodo,
            'categories' => $allCategories
        ]);
    }

    public function update(Todo $todo) {
        try {
            $data = $this->validate(request(), [
                'name' => ['required'],
                'categories_id' => ['required', "numeric"],
                'description' => ['required'],
            ]);
        } catch (ValidationException $e) {
            return response()->json($e->errors());
        }

        $todo->name = $data['name'];
        $todo->categories_id = $data['categories_id'];
        $todo->description = $data['description'];

        $todo->save();

        session()->flash('success', 'Todo updated succesfully!');
        return redirect('/todos');
    }

    public function updateTags(Request $request, $todoID) {
        $nullCounter = 0;
        $tagData = $request->input('tags');

        foreach($tagData as $tag) {
        // Check if any tag names are null. if 1 or 2 are null in total, then continue with the remaining tags.
        // IF all tag names are null. return the user to the edit page and flash a fail message.
            if($tag['name'] == NULL) {
                $nullCounter += 1;
                continue;
            }

        // Check if the tag name is to long. if it is then return the user to the edit page and flash a fail message.
        // If it isn't to long, then check with Regex if it doesn't contain any illegal characters or a dash at the end of the string.
        // If it does have any illegal characters or a dash at the end of the string, then return the user to the edit page and flash a fail message.
        // If the name does not have any illegal characters or a dash at the end, then proceed with creating new tags or applying existing ones to the todo.
            if (strlen($tag['name']) > 25) {
                session()->flash('failure', 'Tag name was to long please keep it under 25 letters/numbers');
                return redirect('/todos/' . $todoID . '/edit');
            } else {
                if(preg_match('/^[a-zA-Z][a-zA-Z\d\-]+[a-zA-Z\d]$/', $tag['name'], $output_array) == false) {
                    session()->flash('failure', 'Tag name contained illegal characters stick to letters, numbers and dashes, but dont end with a dash');
                    return redirect('/todos/' . $todoID . '/edit');
                } else {
                // echo $output_array[0] . ' regex <br>';
                $tag['name'] = $output_array[0];
                $newTag = $tag;
                }
                
            } 
            echo $newTag['name'] . $newTag['color'] . ' validated tags <br>';
        }

    if($nullCounter === 3) {
        session()->flash('failure', 'No tag names were inputted');
        return redirect('/todos/' . $todoID . '/edit');
    }
    
        // if tag(s) is/are new create the new tag(s) in the tags table then create the link between the todo and the tag(s)
        // else simply create the link between the tag+todo

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
        return redirect('/todos');
    }

    public function delete(Todo $todo) {
        $todo->delete();

        session()->flash('success', 'Todo deleted succesfully!');
        return redirect('/todos');
    }
}