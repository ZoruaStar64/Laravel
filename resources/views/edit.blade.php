@extends('layouts/frontend')

@section('content')
@vite('resources/js/bootstrap.js')

    @if(session()->has('failure'))
        <div class="rounded-none bg-red-500 w-96 h-18 mx-auto">
            {{ session()->get('failure') }}
        </div>
    @endif

<div class="container flex rounded-lg bg-slate-700 p-4 mx-auto my-14">

    <form action="/todos/{{$todos->id}}" method="post" class="mx-auto p-4 flex-row">
        @csrf

        <div class="form-group m-3">
            <label class="text-white text-xl" for="name">Task Name</label>
            <br>
            <input type="text" class="form-control mt-2 px-3 py-2 rounded-lg w-96" name="name" value="{{$todos->name}}">
        </div>

        <div class="form-group m-3">
            <label class="text-white text-xl" for="category">Task Category</label>
            <br>
            <select class="form-control mt-2 px-3 py-2 rounded-t-lg w-96" name="categories_id" id="category">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group m-3">
            <label class="text-white text-xl" for="description">Task Description</label>
            <br>
            <textarea class="form-control mt-2 px-3 py-2 rounded-lg w-96" name="description" rows="3">{{$todos->description}}</textarea>
        </div>
        <div x-data @tags-update="{ tagsList: $event.detail.tags }" data-tags='{{json_encode($todos->tag_names)}}'>
            <div x-data="selectTags" x-init="init('parentEl')" class="form-group m-3">
                
                    <input type="hidden" x-model="color" >

                    <input type="text" x-model="textInput" x-ref="textInput" @keydown.enter.prevent="addTag(textInput, color)" class="form-control mt-2 px-3 py-2 rounded-lg w-96" name="tag" placeholder="Add a new tag (max: 3)" value="">
                    
                    
                        <select x-model="newColor"  class="form-control rounded-t-lg mx-auto my-2 px-3 py-2 w-96">
                            <option value="" disabled>Select a new tag color</option>
                            <option style="background-color: #000; color: #FFF;"  value="#000">Black</option> 
                            <option style="background-color: #FFF; color: #000;"  value="#FFF">White</option>
                            <option style="background-color: #09F;" value="#09F">Blue</option>
                            <option style="background-color: #C00;" value="#C00">Red</option>
                            <option style="background-color: #93F;" value="#93F">Purple</option>
                            <option style="background-color: #3C3;" value="#3C3">Green</option>
                        </select>  
                        <br>
                    <template x-for="(tag, index) in tags">
                        <!-- hier moet een hidden input veld zijn met de namen van de values en de values zelf -->
                        
                        <div class="bg-slate-600 flex-col items-center text-xl rounded mt-2 mr-1">
                            <input type="hidden" x-bind:name="'tags['+ index +'][name]'" x-model="tag.name">
                            <input type="hidden" x-bind:name="'tags['+ index +'][color]'" x-model="tag.color">
                            <div class="flex justify-evenly">
                                <span class="mx-2 p-2 bg-slate-500 rounded-lg leading-relaxed truncate max-w-sm" x-text="tag.name"></span>
                                <span class="mx-2 p-2 bg-slate-500 rounded-lg leading-relaxed truncate max-w-sm" x-text="tag.color"></span>
                                <button class="mx-2 p-2 bg-slate-400 rounded-lg hover:bg-slate-500" @click.prevent="updateTagColor(index, newColor)">
                                    Replace current tag color
                                </button>
                                <button class="mx-2 px-2 bg-slate-800 rounded-lg" @click.prevent="removeTag(index)">
                                    <i class="fa fa-trash-alt text-red-600 text-xl"></i>
                                </button>
                            </div>
                        </div>
                        
                    </template>
                    
                    <!-- <input type="hidden" x-model="tags" id="tagsList" name="tagsList[]" multiple="multiple"/> -->
            </div>
        </div>
        <div class="form-group m-3">
            <input type="submit" class="rounded-full bg-slate-600 px-4 text-2xl text-white py-2" value="Update">
        </div>
        
    </form>


    <!-- <form action="/todos/{{$todos->id}}" method="post" class="mx-auto p-4 flex-row">

        @csrf
    @foreach($todos->tags as $tag)
      <h1 style="color: {{$tag->color}}"> #{{ $tag->name }} </h1>   
    @endforeach
    @for($tagTotal = 1; $tagTotal < 4; $tagTotal++)

        <div class="form-group m-3">
            <div class="flex">
            <label class="text-white text-xl flex-row mx-auto" for="tag{{ $tagTotal }}">Tag {{ $tagTotal }}</label><label class="text-white text-xl flex-row mx-auto" for="color{{ $tagTotal }}">Color {{ $tagTotal }}</label>
            </div>
            @if(empty($todos->tags[$tagTotal - 1]))
            <input type="text"  class="form-control mt-2 px-3 py-2 rounded-lg w-96" name="tags[{{ $tagTotal }}][name]" value="">
                @else
                <input type="text"  class="form-control mt-2 px-3 py-2 rounded-lg w-96" name="tags[{{ $tagTotal }}][name]" value="{{$todos->tags[$tagTotal - 1]->name}}"> hier de values die van al bestaande tags zijn
            @endif
            <select class="form-control mt-2 px-3 py-2 rounded-t-lg w-48" name="tags[{{ $tagTotal }}][color]" id="color{{ $tagTotal }}">
                <option style="background-color: #000; color: #FFF;"  value="#000">Black</option> 
                <option style="background-color: #FFF; color: #000;"  value="#FFF">White</option>
                <option style="background-color: #09F;" value="#09F">Blue</option>
                <option style="background-color: #C00;" value="#C00">Red</option>
                <option style="background-color: #93F;" value="#93F">Purple</option>
                <option style="background-color: #3C3;" value="#3C3">Green</option>
            </select>    
            @error('tags.' . $tagTotal . '.name')
                <div class="text-center rounded-md bg-red-500 h-18 mt-2 mx-auto">{{ $message }}</div>
            @enderror
        </div>
@endfor

        <div class="form-group m-3">
            <input type="submit" class="rounded-full bg-slate-600 px-4 text-2xl text-white py-2" value="UpdateTags">
        </div>
        
    </form> -->
    <script type="text/javascript" src="{{ asset('/tagInput.js') }}"></script>
</div>
@endsection