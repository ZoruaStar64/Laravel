@extends('layouts/frontend')

<!-- this causes the tasks database page's body/main to appear -->
@section('content')
<div class="bg-slate-700 mx-auto my-8 px-4 py-8 container">
<div class="flex mx-auto justify-evenly text-white">
        <a href="/database"><span class="mb-0 text-2xl">Tasks</span></a>
        
@if(session()->has('success'))
    <div class="rounded-none bg-green-500">
        {{ session()->get('success') }}
    </div>
@endif

        <a href="/create"><button class="rounded-full bg-slate-600 px-4 text-2xl">Create new Task</button></a>

    </div>

<div class="grid mt-3">
        <div class=" mx-auto text-white">

            <ul class="flex flex-wrap flex-row list-group">
                <!-- This displays every task in the database -->
                @foreach($todos as $todo)

                <div class="container rounded-lg bg-slate-600 px-4 py-4 mx-auto mb-4 mr-32 basis-1/3">
                    <li class="relative">
                        <a class="text-cyan-500 text-xl" href="details/{{$todo->id}}">{{ $todo->name }}</a>
                    <!-- This checks if a task has not been checked and displays an image fitting to the result -->
                    @if($todo->checked == false)
                    
                    <form action="/check/{{$todo->id}}" method="post" class="absolute top-0 right-0">
                        @csrf
                            <input type="hidden" name="checked" value="{{$todo->checked}}">
                            <button type="submit" class="">
                            <i class="fa fa-times-circle text-xl text-red-400"></i>
                        </button>
                    </form>

                    @endif
                    <!-- This checks if a task has been checked and displays an image fitting to the result -->
                    @if($todo->checked == true)

                    <form action="/check/{{$todo->id}}" method="post" class="absolute top-0 right-0">
                        @csrf
                            <input type="hidden" name="checked" value="{{$todo->checked}}">
                            <button type="submit" class="">
                            <i class="fa fa-check-circle text-xl text-green-400"></i>
                        </button>
                    </form>

                    @endif
                    </li>
                    <li class="text-cyan-600 text-xl">{{ $todo->category }}</li>
                    <li class="text-white text-lg">{{ $todo->description }}</li>
                    <a href="../edit/{{$todo->id}}"><i class="fa fa-edit text-green-600 text-xl mr-6"></i></a>
                    <a href="../delete/{{$todo->id}}"><i class="fa fa-trash-alt text-red-600 text-xl"></i></a>
                </div>

                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection

<!-- this causes the styling around the database button link to appear once active -->
@section('database-active')
    border-2 rounded-lg border-red-700 bg-slate-800
@endsection