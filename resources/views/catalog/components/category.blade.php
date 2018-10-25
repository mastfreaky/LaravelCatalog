@if (isset($category))
    @if ($category->children()->exists())
        <li>
            <a href="{{route('category', ['alias' => $category->alias])}}">{{$category->title}}</a>
            <ul>
                @foreach ($category->children as $child)            
                    @component('catalog.components.category', ['category' => $child])
                    @endcomponent
                @endforeach
            </ul>
        </li>
    @else
        <li>
            <a href="{{route('category', ['alias' => $category->alias])}}">{{$category->title}}</a>
        </li>
    @endif
@endif