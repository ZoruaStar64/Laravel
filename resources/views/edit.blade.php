@extends('layouts/frontend')

@section('content')
<div class="container rounded-lg bg-slate-700 p-4 mx-auto my-14">
    <form action="/todos/{{$todos->id}}" method="post" class="mx-auto p-4">
        @csrf
        <div class="form-group m-3">
            <label class="text-white text-xl" for="name">Task Name</label>
            <br>
            <input type="text" class="form-control mt-2 px-3 py-2 rounded-lg w-96" name="name" value="{{$todos->name}}">
        </div>
        <div class="form-group m-3">
            <label class="text-white text-xl" for="category">Task Category</label>
            <br>
            <input type="text" class="form-control mt-2 px-3 py-2 rounded-lg w-96" name="category" value="{{$todos->category}}">
        </div>
        <div class="form-group m-3">
            <label class="text-white text-xl" for="description">Task Description</label>
            <br>
            <textarea class="form-control mt-2 px-3 py-2 rounded-lg w-96" name="description" rows="3">{{$todos->description}}</textarea>
        </div>
        <div class="form-group m-3">
            <input type="submit" class="rounded-full bg-slate-600 px-4 text-2xl text-white py-2" value="Update">
        </div>
    </form>
</div>
@endsection