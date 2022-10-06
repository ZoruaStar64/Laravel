<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagPostRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;
use App\Models\Tag;

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

    public function update(Todo $todo, StoreTagPostRequest $request, $todoID) {
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

        $currentTodo = Todo::with('category')
        ->with('tags')
        ->withCount('tags')
        ->where('id', '=', $todoID)
        ->first();

        try {
            $data = $request->validated();
        } catch (ValidationException $e) {
            return redirect('/todos/' . $todoID . '/edit');
        }
        $tagEntities = [];
        $validTags = $data['tags'];
        foreach ($validTags as $tag) {
            $tagEntity = Tag::where('name', $tag['name'])->first();

            if (null === $tagEntity) {
                $tagEntity = Tag::create([
                    'name' => $tag['name'],
                    'color' => $tag['color']
                ]);

                $tagEntities[] = $tagEntity;
                continue;
            }

            if ($tagEntity->color !== $tag['color']) {
                $tagEntity->color = $tag['color'];
                $tagEntity->save();
                $tagEntities[] = $tagEntity;
                continue;
            }

            $tagEntities[] = $tagEntity;
        }
       

        $tagIDS = array_map(function($tag) {
            return $tag->id;
        }, $tagEntities);
        
        $currentTodo->tags()->sync($tagIDS);
        $currentTodo->save();
        
        $unusedTags = Tag::doesntHave('todos')->get();
        // $unusedTags = $allUnusedTags-;
        
        if ($unusedTags !== null) {
        foreach($unusedTags as $unusedTag) {
            $unusedTag->delete();
        }
    }

        session()->flash('success', 'Todo updated succesfully!');
        return redirect('/todos');
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