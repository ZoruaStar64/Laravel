@extends('layouts/frontend')

<!-- this causes the weather API page's body/main to appear -->
@section('content')
<div class="container flex mx-auto px-4 py-8 gap-6 text-white h-96">
        <h1 class="text-4xl">This is the page for the Weather API</h1>
        <p>This part of the page will be used to test if i can use a weather API.</p>
    </div>
@endsection

<!-- this causes the styling around the weather button link to appear once active -->
@section('weather-active')
    border-2 rounded-lg border-blue-700 bg-slate-800
@endsection