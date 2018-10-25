<h2>Categories</h2>

<ul>
    @forelse ($categories as $category)
        @component('catalog.components.category', ['category' => $category])
        @endcomponent
    @empty
        <li>No categories</li>
    @endforelse
</ul>