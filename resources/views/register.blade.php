@extends('layouts/frontend')


<!-- this causes the register page's body/main to appear -->
@section('content')

    <div class="bg-slate-700 mx-auto my-8 px-4 py-8 container">

        <div class="flex justify-evenly mt-3 mx-auto text-white">
            <p>Register page</p>
            <div class="container flex rounded-lg bg-slate-700 p-4 mx-auto my-14">
                <form action="register-user" method="post" class="mx-auto flex-row">
                    @csrf
                    
                    <div class="form-group m-3">
                    <label class="text-white text-xl" for="name">Username</label>
                        <br>
                        <input type="text" class="form-control mt-2 px-3 py-2 rounded-lg w-96" name="name" placeholder="Enter Username">
                    </div>

                    <div class="form-group m-3">
                    <label class="text-white text-xl" for="email">E-mail</label>
                        <br>
                        <input type="email" class="form-control mt-2 px-3 py-2 rounded-lg w-96" name="email" placeholder="Enter E-mail">
                    </div>

                    <div class="form-group m-3">
                    <label class="text-white text-xl" for="password">Password</label>
                        <br>
                        <input type="password" class="form-control mt-2 px-3 py-2 rounded-lg w-96" name="password" placeholder="Enter Password">
                    </div>

                    <div class="form-group m-3">
                        <input type="submit" class="rounded-full bg-slate-600 px-4 text-2xl text-white py-2" value="Submit">
                    </div>
                
                </form>
            </div>
        </div>
    </div>
    
@endsection

<!-- this causes the styling around the register button link to appear once active -->
@section('register-active')
    border-2 rounded-lg border-yellow-500 bg-slate-800
@endsection