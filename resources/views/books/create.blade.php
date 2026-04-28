{{-- СОЗДАНИЕ КНИГИ --}}
<h2>Create Book</h2>


<form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="text" name="title" value="{{ old('title') }}" placeholder="Title"> 
    @error('title')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    <br><br>

    <input type="text" name="author" value="{{ old('author') }}" placeholder="Author">
    @error('author')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    <br><br>

    <input type="number" name="price" value="{{ old('price') }}" placeholder="Price">
    @error('price')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    <br><br>

    <input type="date" name="published_at" value="{{ old('published_at') }}" >
    @error('published_at')
        <p style="color:red;">{{ $message }}</p>
    @enderror
    <br><br>

    <label>
        Available:
        <input type="checkbox" name="is_available" value="1"
        @if(old('is_available'))
            checked
        @endif>
    </label>

    <br><br>

<label for="pet-select">Choose a category:</label>
    <select name="category_id" id="category-select">
        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                @if(old('category_id') == $category->id)
                    selected
                @endif>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <p style="color:red;">{{ $message }}</p>
    @enderror

    <br><br>
    
    <label>
        Cover image:    
        <input type="file" name="cover_image">
    </label>

    <br><br>

    <button type="submit">Create</button>
</form>