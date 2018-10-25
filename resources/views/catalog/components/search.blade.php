<h2>Search</h2>

<form action="{{route('search')}}" method="POST">
        <div>
            <div>
            <input type="text" name="search" placeholder="Search">
            @if ($errors->has('search'))
                <div class="alert alert-danger">{{ $errors->first('search') }}</div>
            @endif
        </div>
        <div>
            <label><input type="radio" name="type" value="0" checked>Title</label>
            <label><input type="radio" name="type" value="1">Description</label>

            <input type="submit" name="submit" value="Search">
        </div>
        @csrf
    </div>
</form>