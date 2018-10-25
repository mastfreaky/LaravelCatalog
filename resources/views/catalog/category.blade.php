@extends('layouts.main')

@section('content')
    <div class="container">
        @component('catalog.components.products', ['products' => $products])
            @slot('title') Products by category "{{$category_name}}" @endslot
        @endcomponent
    </div>
@endsection