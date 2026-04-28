<h1>Edit Book</h1>

<form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ old('title',$book->title) }}">
    @error('title')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    <input type="text" name="author" value="{{old('author',$book->author) }}">
    @error('author')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    <input type="number" name="price" value="{{old('price',$book->price) }}">
    @error('price')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    <input type="date" name="published_at" value="{{old('published_at',$book->published_at) }}">
    @error('published_at')
        <p style="color:red;">{{ $message }}</p>
    @enderror

    <label>
        Available:
        <input type="checkbox" name="is_available" value="1"
        @if(old('is_available' == $book->is_available))
            checked
        @endif>
    </label>

    <br><br>

    <select name="category_id" id="category-select">
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                @if(old('category_id',$book->category_id)  == $category->id) 
                    selected 
                @endif>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <br><br>

    @if($book->cover_image)
        <img src="{{ asset('storage/' . $book->cover_image) }}" width="120">
    @endif

    <br><br>
    
    <label>
        Change cover image:    
        <input type="file" name="cover_image">
    </label>

    <br><br>
    <button type="submit">Update</button>
</form>