<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
    
    <title>Laravel test object</title>
</head>
<?php $loggedInUser = auth()->user(); ?>
<body class="bg-gray-900">
    <div class="flex justify-between container mx-auto my-8 px-4 py-8 bg-slate-700 relative">

        <div>
            <img class="hover:animate-pulse absolute -top-14" src="{{ URL::asset('/images/1logo_transparent.png') }}" alt="logo" width="250">
        </div>

        @if($loggedInUser ==! null)
        <div>
            <h1 class="transition duration-500 border-2 rounded-lg p-1 border-neutral-50 bg-slate-800 text-xl text-white hover:border-slate-800">Welcome {{$loggedInUser['name']}}</h1>
        </div>
        @endif
        <div class="text-white text-lg">
            <a class="transition duration-500 hover:border-2 hover:rounded-lg hover:border-neutral-50 mr-10 @yield('index-active') px-2 py-1 " href="{{url('/')}}">Home</a>
            <a class="transition duration-500 hover:border-2 hover:rounded-lg hover:border-blue-700 mr-10 @yield('weather-active') px-2 py-1" href="{{url('/weather')}}">Weather</a>
            <a class="transition duration-500 hover:border-2 hover:rounded-lg hover:border-yellow-500 mr-10 @yield('register-active') px-2 py-1" href="{{url('user/register-user')}}">Register</a>
            @if($loggedInUser ==! null)
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
               class="transition duration-1000 hover:border-2 hover:rounded-lg hover:border-red-900 hover:bg-slate-900 mr-10 px-2 py-1">Logout</a>
               <a class="transition duration-500 hover:border-2 hover:rounded-lg hover:border-red-700 mr-10 @yield('database-active') px-2 py-1" href="{{url('/todos')}}">Database @yield('activity')</a> <!-- iets qua een to-do lijst -->
            @endif
            @if($loggedInUser === null)
            <a class="transition duration-500 hover:border-2 hover:rounded-lg hover:border-emerald-500 mr-10 @yield('login-active') px-2 py-1" href="{{url('user/login-user')}}">Log in</a>
            @endif
            
        </div>

    </div>               
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
    </form>
    <!-- this takes the code from the current active page's file by using @ section with the same text between the '' to appear here -->
    @yield('content')

    <footer class="container mx-auto my-8 px-4 py-6 bg-slate-700">
        <p class="text-white">SB-DEV 2022</p>
    </footer>
</body>
</html>