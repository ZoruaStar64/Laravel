@extends('layouts/frontend')

@section('content')

<div class="container rounded-lg bg-slate-700 p-4 mx-auto my-14 text-center">
        <div class="container rounded-lg bg-slate-600 py-2">
            <h2 class="text-white text-2xl">{{$todos->name}}</h2>
            <h3 class="text-cyan-500 text-xl">Category : {{$todos->category}}</h3>
            <p class="text-lg mb-4">{{$todos->description}}</p>
            <a href="../edit/{{$todos->id}}"><i class="fa fa-edit text-green-600 text-2xl m-2"></i></a>
            <a href="../delete/{{$todos->id}}"><i class="fa fa-trash-alt text-red-600 text-2xl m-2"></i></a>
        </div>
    </div>

@endsection