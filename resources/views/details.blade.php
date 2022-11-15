@extends('layouts/frontend')

@section('content')
<script type="text/javascript" src="/tagColorChooser.js"></script>

<div class="container rounded-lg bg-slate-700 p-4 mx-auto my-14 text-center">
    <div class="container rounded-lg bg-slate-600 py-2">
        <h2 class="text-white text-2xl">{{$todos->name}}</h2>
        <h3 class="text-cyan-500 text-xl">Category : {{$todos->category->name}}</h3>
        <p class="text-lg mb-4">{{$todos->description}}</p>
        <div class="flex flex-row justify-center my-3 text-white">
            <p class="text-xl">Tags : @foreach($todos->tags as $tag)
            <h1 class="p-2 mx-2 text-lg rounded-lg" id="{{$todos->id . $tag->id}}" style="background-color: {{$tag->color}}">#{{ $tag->name }}</h1>
            <script>
                decideTextColor("{{$todos->id . $tag->id}}", "{{$tag->color}}");
            </script>
            @endforeach
            </p>
        </div>
        <div class="flex flex-row justify-center my-2">
            <a href="/todos/{{$todos->id}}/edit"><i class="fa fa-edit text-green-600 text-2xl mr-6"></i></a>
            <form action="/todos/{{$todos->id}}" method="post">
                @csrf
                {{ method_field('delete') }}
                <button class="" type="submit"><i class="fa fa-trash-alt text-red-600 text-2xl"></i></button>
            </form>
        </div>
    </div>
</div>

@section('activity')
    | details
@endsection
@section('database-active')
    border-2 rounded-lg border-red-700 bg-slate-800
@endsection
@endsection