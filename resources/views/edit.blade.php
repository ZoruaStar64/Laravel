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
            
                <input type="text" x-model="textInput" x-ref="textInput" @keydown.enter.prevent="addTag(textInput, color)" class="form-control mt-2 px-3 py-2 rounded-lg w-96" name="tag" placeholder="Add a new tag (max: 3)" value="">                                       
                    <select x-model="color"  class="form-control rounded-t-lg mx-auto my-2 px-3 py-2 w-48">
                        <option value="" selected disabled>Select new tag color</option>
                        <option style="background-color: #000;" value="#000"></option> 
                        <option style="background-color: #FFF;"  value="#FFF"></option>
                        <option style="background-color: #09F;" value="#09F"></option>
                        <option style="background-color: #C00;" value="#C00"></option>
                        <option style="background-color: #93F;" value="#93F"></option>
                        <option style="background-color: #3C3;" value="#3C3"></option>
                    </select>  
                    <br>
                    
                <template x-for="(tag, index) in tags">                      
                    <div class="bg-slate-600 flex-col items-center text-xl rounded mt-2 mr-1">
                        <input type="hidden" x-bind:name="'tags['+ index +'][name]'" x-model="tag.name">
                        <input type="hidden" x-bind:name="'tags['+ index +'][color]'" x-model="tag.color">
                        <div class="flex justify-evenly">
                            <span class="mx-2 p-2 bg-slate-500 rounded-lg leading-relaxed truncate max-w-sm" x-text="tag.name"></span>
                            <div x-data="{BGC: tag.color}" class="mx-2 p-2 bg-slate-500 rounded-lg leading-relaxed truncate max-w-sm">
                                <div x-model="BGC" :style="`background-color: ${BGC}`" class="box-border w-5 h-5 rounded-full mx-auto"></div>
                                <span x-text="tag.color"></span>
                                
                            </div>
                            
                            <div x-data="{BGC: tag.color}">
                            <select x-model="BGC" x-on:change="updateTagColor(index, $el.value)" :style="`background-color: ${BGC}`" class="form-control rounded-t-lg mx-auto my-2 py-2 w-48">
                                <option value="" disabled>Select new tag color</option>
                                <option style="background-color: #000;" value="#000"></option> 
                                <option style="background-color: #FFF;" value="#FFF"></option>
                                <option style="background-color: #09F;" value="#09F"></option>
                                <option style="background-color: #C00;" value="#C00"></option>
                                <option style="background-color: #93F;" value="#93F"></option>
                                <option style="background-color: #3C3;" value="#3C3"></option>
                            </select> 
                            </div>
                            <button class="mx-2 px-2 bg-slate-800 rounded-lg" @click.prevent="removeTag(index)">
                                <i class="fa fa-trash-alt text-red-600 text-xl"></i>
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div class="form-group m-3">
            <input type="submit" class="rounded-full bg-slate-600 px-4 text-2xl text-white py-2" value="Update">
        </div>
    </form>

    <script type="text/javascript" src="{{ asset('/tagInput.js') }}"></script>
</div>
@endsection