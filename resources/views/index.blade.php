@extends('layouts/frontend')

<!-- this causes the index/home page's body/main to appear -->
@section('content')
<div class="container flex mx-auto px-4 py-8 gap-6 text-white h-96">
    <div class="container flex rounded-lg bg-slate-700 p-4 mx-auto my-14">
        <div class="basis-1/2">
            <h1 class="text-2xl mb-3">Explanation: Weather API, Register, Log in</h1>
            <p>Weather Button: This button leads to the weather API page.<br> 
            It currently only shows the current weather, today's weather and the weather for the next 7 days.</p>
            <p>Register Button: Allows you to register an account for the Tasks page. (Database Button)</p>
            <p>Login Button: Allows you to login once you've created an account.</p>
        </div>
        <div class="basis-1/2">
            <h1 class="text-2xl mb-3">Explanation: Tasks (Database Button)</h1>
            <p>Database Button: You can create Todos (Tasks) in this page once you've logged in. <br>
            afterwards you can edit your Todos (Tasks), mark them as done, check them in greater detail on it's dedicated page and delete them</p>
        </div>
    </div>
</div>
@endsection

<!-- this causes the styling around the home button link to appear once active -->
@section('index-active')
    border-2 rounded-lg border-neutral-50 bg-slate-800
@endsection

