@extends('layouts/frontend')

<!-- this causes the weather API page's body/main to appear -->
@section('content')
<div class="container flex mx-auto px-4 py-8 gap-6 text-white h-fit">
        <x-weather-widget :currentWeather="$currentWeather" :futureWeather="$futureWeather" />  
</div>
@endsection

<!-- this causes the styling around the weather button link to appear once active -->
@section('weather-active')
    border-2 rounded-lg border-blue-700 bg-slate-800
@endsection