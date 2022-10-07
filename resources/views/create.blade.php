@extends('layouts/frontend')

@section('content')
@vite('resources/js/bootstrap.js')
<div class="container flex rounded-lg bg-slate-700 p-4 mx-auto my-14">
    <form action="store-data" method="post" class="mx-auto flex-row">
        @csrf
        
        <div class="form-group m-3">
        <label class="text-white text-xl" for="name">Task Name</label>
            <br>
            <input type="text" class="form-control mt-2 px-3 py-2 rounded-lg w-96" name="name">
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
            <textarea class="form-control mt-2 px-3 py-2 rounded-lg w-96" name="description" rows="3"></textarea>
        </div>

        <div x-data @tags-update="{ tagsList: $event.detail.tags }" data-tags='[]'>
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
            </div>
        </div>

        <div class="form-group m-3">
            <input type="submit" class="rounded-full bg-slate-600 px-4 text-2xl text-white py-2" value="Submit">
        </div>
    
    </form>
    </div>
    <script type="text/javascript" src="{{ asset('/tagInput.js') }}"></script>
</div>
@endsection