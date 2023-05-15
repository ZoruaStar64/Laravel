@extends('layouts/frontend')

@section('content')

<div class="container flex rounded-lg bg-slate-700 p-4 mx-auto my-14">
    <form action="trust-users" method="post" class="mx-auto flex-row">
        @csrf

        <div class="form-group m-3 bg-slate-600">
            <h1 class="text-white text-xl p-2">Which users will you allow access to your created task?</h1>
            <br>
            @foreach($otherUsers as $otherUser)
            
            <div class="form-control mt-2 px-3 py-2 rounded-t-lg">
                <input type="checkbox"  
                value="{{$otherUser->id}}" name="user[{{$loop->index}}][id]" id="user[{{$loop->index}}][id]"></input>
                <label class="text-white text-xl">{{ $otherUser->name }}, user id: {{ $otherUser->id }}</label>
                <br>

                <label class="text-white text-xl" for="permission{{$loop->index}}">Which permission will you grant?</label>
                <br>
                <select class="form-control mt-2 px-3 py-2 rounded-t-lg w-96" name="user[{{$loop->index}}][permission]" id="user[{{$loop->index}}][permission]">
                    <option value="view">Only allow Viewing</option>
                    <option value="edit">Allow Viewing and Editing</option>
                    <option value="all">Allow Viewing, Editing AND Deleting</option>
                </select>
            </div>
            @endforeach
        </div>

        <div class="form-group m-3">
            <input type="submit" class="rounded-full bg-slate-500 px-4 text-2xl text-white py-2" value="Submit">
        </div>

    </form>
</div>

@section('activity')
    | create
@endsection
@section('database-active')
    border-2 rounded-lg border-red-700 bg-slate-800
@endsection
@endsection