@extends('layouts/frontend')


<!-- this causes the tasks database page's body/main to appear -->
@section('content')
@vite('resources/js/bootstrap.js')
<script>
function isDarkOrLight(bgColor) {
    var color = (bgColor.charAt(0) === '#') ? bgColor.substring(1, 7) : bgColor;
    var r = parseInt(color.substring(0, 2), 16); // hexToR
    var g = parseInt(color.substring(2, 4), 16); // hexToG
    var b = parseInt(color.substring(4, 6), 16); // hexToB
    return (((r * 0.299) + (g * 0.587) + (b * 0.114)) > 9) ?
      true : false;
  }
let bgColor = '';
</script>
    <div class="bg-slate-700 mx-auto my-8 px-4 py-8 container">
        <div class="flex mx-auto justify-evenly text-white">
            <a href="/todos"><span class="mb-0 text-2xl">Tasks</span></a>
            
            @if(session()->has('success'))
                <div class="rounded-none bg-green-500 p-2">
                    {{ session()->get('success') }}
                </div>
            @endif

            <a href="/todos/create"><button class="rounded-full bg-slate-600 px-4 text-2xl">Create new Task</button></a>

        </div>

        <div class="flex justify-evenly mt-3 mx-auto text-white">

            <ul class="container rounded-lg bg-slate-500 w-1/2 mx-2 flex flex-wrap flex-row list-group">
                <!-- This displays every finished task in the database -->
                @foreach($finishedTodos as $todo)

                <div class="container rounded-lg bg-slate-600 px-4 py-4 mx-auto my-4 w-11/12">
                    <li class="relative">
                        <a class="text-cyan-500 text-xl" href="/todos/{{$todo->id}}">{{ $todo->name }}</a>
 
                    <!-- This checks if a task has been checked and displays an image fitting to the result -->
                    @if($todo->checked == true)

                    <form action="/todos/check/{{$todo->id}}" method="post" class="absolute top-0 right-0">
                        @csrf
                            <input type="hidden" name="checked" value="{{$todo->checked}}">
                            <button type="submit" class="">
                            <i class="fa fa-check-circle text-xl text-green-400"></i>
                        </button>
                    </form>

                    @endif

                    <div class="flex flex-row justify-start">
                        @foreach ($todo->tags as $tag)
                        <script>
                            
                            bgColor = '{{$tag->color}}';
                            console.log(bgColor);
                            textColor = isDarkOrLight(bgColor) ? 'black' : 'white';
                            console.log(textColor);
                            color = ''
                        </script>
                            <h1 class="p-2 mr-2 my-1 rounded-lg" style="color: isDarkOrLight(color); background-color: {{$tag->color}}; ">#{{ $tag->name }}</h1>
                        @endforeach
                    </div>

                    </li>
                    <li class="text-cyan-600 text-xl">{{ $todo->category->name }}</li>
                    <li class="text-white text-lg">{{ $todo->description }}</li>

                    <div class="flex flex-row">
                    <a href="/todos/{{$todo->id}}/edit"><i class="fa fa-edit text-green-600 text-xl mr-6"></i></a>
                    <form action="/todos/{{$todo->id}}" method="post">
                        @csrf
                    {{ method_field('delete') }}
                    <button class="" type="submit"><i class="fa fa-trash-alt text-red-600 text-xl"></i></button>
                    </form>
                    </div>

                </div>
                @endforeach
            </ul>
                
            <ul class="container rounded-lg bg-slate-500 w-1/2 mx-2 flex flex-wrap flex-row list-group">
            <!-- This displays every unfinished task in the database -->
                @foreach($unfinishedTodos as $todo)
                <div class="container rounded-lg bg-slate-600 px-4 py-4 mx-auto my-4 w-11/12">
                    <li class="relative">
                        <a class="text-cyan-500 text-xl" href="/todos/{{$todo->id}}">{{ $todo->name }}</a>
                   <!-- This checks if a task has not been checked and displays an image fitting to the result -->
                    @if($todo->checked == false)
                    
                    <form action="/todos/check/{{$todo->id}}" method="post" class="absolute top-0 right-0">
                        @csrf
                            <input type="hidden" name="checked" value="{{$todo->checked}}">
                            <button type="submit" class="">
                            <i class="fa fa-times-circle text-xl text-red-400"></i>
                        </button>
                    </form>
                @endif
                
                <div class="flex flex-row justify-start">
                        @foreach ($todo->tags as $tag)
                        <script>
                            color = '{{$tag->color}}';
                            console.log(color);
                            textColor = isDarkOrLight(color) ? 'black' : 'white';
                            console.log(textColor);
                            color = ''
                        </script>
                            <h1 class="p-2 mr-2 my-1 rounded-lg" style="color: isDarkOrLight(color); background-color: {{$tag->color}}">#{{ $tag->name }}</h1>
                        @endforeach
                    </div>

                    </li>
                    <li class="text-cyan-600 text-xl">{{ $todo->category->name }}</li>
                    <li class="text-white text-lg">{{ $todo->description }}</li>

                    <div class="flex flex-row">
                    <a href="/todos/{{$todo->id}}/edit"><i class="fa fa-edit text-green-600 text-xl mr-6"></i></a>
                    <form action="/todos/{{$todo->id}}" method="post">
                        @csrf
                    {{ method_field('delete') }}
                    <button class="" type="submit"><i class="fa fa-trash-alt text-red-600 text-xl"></i></button>
                    </form>
                    </div>

                </div>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

<!-- this causes the styling around the database button link to appear once active -->
@section('database-active')
    border-2 rounded-lg border-red-700 bg-slate-800
@endsection