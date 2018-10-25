<h2>Search</h2>

<form action="{{route('search')}}" method="POST">
    <input type="text" name="search" placeholder="Search">
    <label><input type="radio" name="type" value="0" checked>Title</label>
    <label><input type="radio" name="type" value="1">Description</label>

    <input type="submit" name="submit" value="Search">

    @csrf
</form>