@extends('layouts.main')

@section('content')
    <div class="container">
        @component('catalog.components.search')
        @endcomponent

        @component('catalog.components.products', ['products' => $products])
            @slot('title') Search result @endslot
        @endcomponent
    </div>
@endsection