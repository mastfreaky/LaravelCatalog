<h2>{{$title}}</h2>

<div class="container">
    <div class="row">
        @forelse ($products as $item)
            <div class="card m-3" style="width: 18rem;">
                <img class="card-img-top" src="{{$item->image}}" alt="No image">
                <div class="card-body">
                    <h5 class="card-title">{{$item->title}}</h5>
                    <p class="card-text">{{$item->description}}</p>
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($item->offers as $offer)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Article: {{$offer->article}}
                            <span class="badge badge-primary badge-pill">Price: {{$offer->price}}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @empty
            <h2>No products</h2>
        @endforelse
    </div>
</div>