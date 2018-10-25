@extends('layouts.main')

@section('content')
    <div class="container">
        @component('catalog.components.categories', ['categories' => $categories])
        @endcomponent

        @component('catalog.components.search')
        @endcomponent

        @component('catalog.components.products', ['products' => $products])
            @slot('title') Popular products @endslot
        @endcomponent
    </div>
@endsection