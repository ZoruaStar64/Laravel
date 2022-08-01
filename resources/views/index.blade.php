@extends('layouts/frontend')

<!-- this causes the index/home page's body/main to appear -->
@section('content')
<div class="container flex mx-auto px-4 py-8 gap-6 text-white h-96">
        <div class="basis-1/2">
            <h1 class="text-2xl mb-3">Body area 1</h1>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. A aspernatur eius et? Eum pariatur ratione laboriosam error, cum quia velit nulla quae ut natus maiores est aliquid rerum maxime blanditiis ex molestiae totam repellat inventore unde doloremque saepe consequatur. Voluptate iure veniam saepe alias dolore ducimus labore, enim asperiores! Odio vel nemo fugiat esse odit accusamus officiis nobis alias amet?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad enim, consequuntur ea cupiditate aliquid nulla voluptatum expedita, alias et id rerum quo vero sint aperiam cumque doloribus nesciunt nisi voluptates?</p>
        </div>
        <div class="basis-1/2">
            <h1 class="text-2xl mb-3">Body area 2</h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ea excepturi porro minima, ipsam reprehenderit nesciunt voluptate doloremque voluptatibus ipsa fuga. Culpa placeat ad autem reiciendis, saepe doloribus hic! Impedit, ab.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad enim, consequuntur ea cupiditate aliquid nulla voluptatum expedita, alias et id rerum quo vero sint aperiam cumque doloribus nesciunt nisi voluptates?</p>
        </div>
    </div>
@endsection

<!-- this causes the styling around the home button link to appear once active -->
@section('index-active')
    border-2 rounded-lg border-teal-700 bg-slate-800
@endsection

