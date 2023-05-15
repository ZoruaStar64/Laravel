<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\StoreTrustRequest;
use Illuminate\Validation\ValidationException;
use App\Models\Todo;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;

class TodoController extends Controller
{
    public function index() {
        $loggedInUser = auth()->user();
        $allCategories = Category::all();
        if($loggedInUser ==! null) {
            $allTodos = Todo::where('user_id', '=', $loggedInUser->id)->with('category')->with('tags')->get(); //This is complaining because of the ==! null but it legit doesn't work otherwise so don't change the if statement
        }
        else {
            $allTodos = Todo::with('category')->with('tags')->get();
        }
        
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

    public function store(StorePostRequest $request) {
        try {
           $data = $request->validated();
        } catch (ValidationException $e) {
            return response()->json($e->errors());
        }
        $loggedInUser = auth()->user();
        $todo = Todo::create($data);
        $todo->save();

        $newTodo = Todo::with('category')
        ->with('tags')
        ->where('id', '=', $todo->id)
        ->first();

        try {
            $data = $request->validated();
        } catch (ValidationException $e) {
            return redirect('/todos/' . $todo->id . '/edit');
        }
        if(empty($data['tags'])) {
            session()->flash('success', 'Todo without Tags created succesfully!');
            return redirect('/todos');
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
        
        $newTodo->tags()->sync($tagIDS);
        $newTodo->save();
        $newTodo->user_id = $loggedInUser['id'];
        $newTodo->save();

        session()->flash('success', 'Todo with Tags created succesfully!');
        return redirect('/todos');
    }

    public function details(Todo $todo) {    
        return view('details',[
            'todos' => $todo,
        ]);
    }

    public function trustPage(Todo $todo) {
        $otherUsers = User::whereNot(function ($query) {
            $loggedInUser = auth()->user();
            $query->where('id', '=', $loggedInUser->id);
        })->get();
        return view('trustUser')->with('currentTodo', $todo)->with('otherUsers', $otherUsers);
    }

    public function trustUsers(StoreTrustRequest $request, $todoID) {
        try {
            $data = $request->validated();
         } catch (ValidationException $e) {
             return response()->json($e->errors());
         }
         dd($data, $todoID);
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
    public function removeUnusedTags() {
        $unusedTags = Tag::doesntHave('todos')->get();

        if ($unusedTags !== null) {
        foreach($unusedTags as $unusedTag) {
            $unusedTag->delete();
        }
    }
}
    public function update(StorePostRequest $request, $todoID) {
        $todo = Todo::with('category')->where('id', '=', $todoID)->first();
        
        try {
            $data = $request->validated();
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
        if(empty($data['tags'])) {
            if($currentTodo->tags_count === 0) {
                return redirect('/todos');
            }
            $currentTodo->tags()->detach();
            $this->removeUnusedTags();
            return redirect('/todos');
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

        $this->removeUnusedTags();

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
        $todo->tags()->detach();
        $todo->delete();

        session()->flash('success', 'Todo deleted succesfully!');
        return redirect('/todos');
    }
}