<?php
$currentWeatherIcon = $currentWeather['weather'][0]['icon'];
?>

<div class="container flex flex-col mx-auto px-4 py-8 gap-6 text-white w-96 h-fit bg-weatherBG rounded-xl">
    <div class="container grid grid-cols-2 grid-rows-2 gap-4 mx-auto px-4 py-8 text-white w-72 h-40 bg-weatherFG rounded-xl shadow-2xl shadow-purple-400/50">
        <div class="text-3xl h-12">{{$currentWeather['name']}}</div>
        <div class="ml-10 text-4xl h-12 ">{{round($currentWeather['main']['temp'])}}&#176;C</div>
        <div class="text-l text-gray-300 h-12">Feels like: {{round($currentWeather['main']['feels_like'])}}&#176;C</div>
        <div class="mx-auto">
            <img class="w-20" src="http://openweathermap.org/img/wn/{{$currentWeatherIcon}}@2x.png" alt="icon">
        </div>
    </div>

    <div class="container grid grid-cols-2 grid-rows-2 gap-4 mx-auto px-4 py-8 text-white w-72 h-32 bg-weatherFG rounded-xl shadow-2xl shadow-purple-400/50">
        <div class="text-2xl h-12">Minimum</div> <div class="text-2xl h-12">Maximum</div> 
        <div class="text-4xl h-12">{{round($currentWeather['main']['temp_min'])}}&#176;C</div>
        <div class="text-4xl h-12">{{round($currentWeather['main']['temp_max'])}}&#176;C</div>
    </div>

    @foreach ($futureWeather['list'] as $index => $weather) 
 @php
    $forecastIcon = $futureWeather['list'][$index]['weather'][0]['icon'];
@endphp
    <div class="container grid grid-cols-5 grid-rows-2 gap-2 mx-auto px-4 py-3 text-white w-72 bg-weatherFG rounded-full shadow-2xl shadow-purple-400/50">
        <div class="row-span-2 mt-4">{{ strtoupper(\Carbon\Carbon::createFromTimestamp($weather['dt'])->format('D')) }}</div>
        <div class="row-span-2"><img class="" src="http://openweathermap.org/img/wn/{{$forecastIcon}}.png" alt="icon"></div>
        <div class="row-span-2">{{$futureWeather['list'][$index]['weather'][0]['description']}}</div>

        <!-- <div class="ml-4 row-start-1 col-start-4 text-sm">Max:</div>
        <div class="ml-4 row-start-2 col-start-4 text-sm">Min:</div> -->

        <div class="row-start-1 col-start-5">{{round($futureWeather['list'][$index]['temp']['max'])}}&#176;C</div>
        <div class="row-start-2 col-start-5">{{round($futureWeather['list'][$index]['temp']['min'])}}&#176;C</div>
    </div>
    @endforeach
</div>
