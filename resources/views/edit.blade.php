@extends('layouts/frontend')

@section('content')
@vite('resources/js/bootstrap.js')

<?php 
$colorOptions = '   
<option>#000000</option>
<option>#ffffff</option>
<option>#0099ff</option>
<option>#cc0000</option>
<option>#9933ff</option>
<option>#33cc33</option>
';
?>

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
                <input x-model="color" style="height: 40px;" type="color" class="form-control form-control-color py-2" id="colorInput" value="#563d7c" title="Choose your color" list="presetColors">
                <datalist id="presetColors">
                    <?php echo $colorOptions ?>
                </datalist>    
                <br>

                <div class="flex flex-row justify-start">
                    <template x-for="(tag, index) in tags">                      
                        <div class="text-m rounded mt-2 mr-1">
                            <input type="hidden" x-bind:name="'tags['+ index +'][name]'" x-model="tag.name">
                            <input type="hidden" x-bind:name="'tags['+ index +'][color]'" x-model="tag.color">
                                
                            <div class="mx-1 p-1 rounded-lg text-white bg-sky-600 leading-relaxed truncate max-w-sm flex flex-row justify-start">
                                <span class="" x-text="tag.name"></span>
                                <input x-model="tag.color" style="height: 1.5em; width: 3em; background: none;" type="color"  x-on:change="updateTagColor(index, $el.value)" 
                                class="form-control form-control-color mt-1 text-black" id="colorInput" value="#563d7c" title="Choose your color" list="presetColors">
                                <datalist id="presetColors">
                                <?php echo $colorOptions ?>
                                </datalist>
                                <button class="px-1" @click.prevent="removeTag(index)">
                                    X
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <div class="form-group m-3">
            <input type="submit" class="rounded-full bg-slate-600 px-4 text-2xl text-white py-2" value="Update">
        </div>

    </form>

    <script type="text/javascript" src="{{ asset('/tagInput.js') }}"></script>
</div>
@endsection