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
<body class="bg-gray-900">
    <div class="flex justify-between container mx-auto my-8 px-4 py-8 bg-slate-700 relative">

        <div class="">
            <img class="hover:animate-pulse absolute -top-14" src="{{ URL::asset('/images/1logo_transparent.png') }}" alt="logo" width="250">
        </div>

        <div class="text-white text-lg">
            <a class="mr-10 @yield('index-active') px-2 py-1 " href="{{url('/')}}">Home</a>
            <a class="mr-10 @yield('weather-active') px-2 py-1" href="{{url('/weather')}}">Weather</a>
            <a class="mr-10 @yield('database-active') px-2 py-1" href="{{url('/todos')}}">Database</a> <!-- iets qua een to-do lijst -->
        </div>

    </div>
    <!-- this takes the code from the current active page's file by using @ section with the same text between the '' to appear here -->
    @yield('content')

    <footer class="container mx-auto my-8 px-4 py-6 bg-slate-700">
        <p class="text-white">SB-DEV 2022</p>
    </footer>
</body>
</html>