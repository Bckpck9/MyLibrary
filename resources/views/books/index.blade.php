<div style="max-width: 900px; margin: 0 auto; padding: 20px;">
    <h1>LIBRARY</h1>

<div style="margin-bottom:30px;">
    {{-- ФИЛЬТРЫ --}}
    <div style="border:1px solid #ddd; border-radius:12px; padding:20px; background:#f9f9f9; position:relative;">
        {{-- КНОПКА --}}        
        <a href="{{ route('books.create') }}"              
            style="position:absolute; top:74px; right:20px; padding:12px 20px; background:#0d6efd; color:white; text-decoration:none; border-radius:10px; font-weight:600;">            
            + Create Book        
        </a>

        {{-- кнопки фильтра --}}
        <div style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:20px;">
            <a href="{{ route('books.index') }}"
                style="padding:8px 14px; background:#222; color:white; text-decoration:none; border-radius:8px;">
                All
            </a>

            <a href="{{ route('books.index', ['expensive' => 1, 'available' => $available, 'search' => $search, 'category_id' => request('category_id')]) }}"
                style="padding:8px 14px; background:#444; color:white; text-decoration:none; border-radius:8px;">
                Expensive
            </a>

            <a href="{{ route('books.index', ['available' => 1, 'expensive' => $expensive, 'search' => $search, 'category_id' => request('category_id')]) }}"
                style="padding:8px 14px; background:#444; color:white; text-decoration:none; border-radius:8px;">
                Available
            </a>

            <a href="{{ route('books.index', ['expensive' => $expensive, 'available' => $available, 'sort' => 'price', 'search' => $search, 'category_id' => request('category_id')]) }}"
                style="padding:8px 14px; background:#444; color:white; text-decoration:none; border-radius:8px;">
                Order by price
            </a>
        </div>

        {{-- ФОРМА --}}
        <form method="GET" action="{{ route('books.index') }}"
                style="display:flex; gap:15px; align-items:center; flex-wrap:nowrap;">

            <input type="hidden" name="expensive" value="{{ $expensive }}">
            <input type="hidden" name="available" value="{{ $available }}">
            <input type="hidden" name="sort" value="{{ $sort }}">

            <select name="category_id"
                style="height:44px; padding:0 12px; border-radius:8px; border:1px solid #ccc;">
                <option value="">All categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        @if(request('category_id') == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit"
                style="height:44px; padding:0 16px; background:#222; color:white; border:none; border-radius:8px;">
                Filter
            </button>

            <input type="text" name="search" value="{{ $search }}" placeholder="Search..."
                style="height:44px; padding:0 12px; border-radius:8px; border:1px solid #ccc; width:200px;">

            <button type="submit"
                style="height:44px; padding:0 16px; background:#222; color:white; border:none; border-radius:8px;">
                Search
            </button>

        </form>
    </div>
</div>

    
    <hr>

    {{-- СПИСОК КНИГ --}}
    @foreach ($books as $book)
        <div style="border:1px solid #ddd; border-radius:12px; padding:20px; margin-bottom:20px; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,0.05);">
            <div style="display:flex; gap:24px; align-items:flex-start;">
                
                <div style="flex-shrink:0;">
                    @if($book->cover_image)
                        <img 
                            src="{{ asset('storage/' . $book->cover_image) }}"
                            alt="{{ $book->title }}"
                            style="width:220px; height:280px; object-fit:cover; border-radius:10px; border:1px solid #ddd;"
                        >
                    @else
                        <div style="    
                            width:220px;    
                            height:280px;    
                            background:#f1f1f1;    
                            border-radius:10px;    
                            border:1px solid #ddd;    
                            display:flex;    
                            align-items:center;    
                            justify-content:center;    
                            color:#777;    
                            font-weight:500;
                        ">    
                            No image
                        </div>
                    @endif
                </div>

                <div style="flex:1;">
                    <h3 style="margin:0 0 12px 0;">{{ $book->title }}</h3>

                    <p style="margin:0 0 10px 0;"><strong>Author:</strong> {{ $book->author }}</p>
                    <p style="margin:0 0 10px 0;"><strong>Price:</strong> {{ $book->formatted_price }}</p>
                    <p style="margin:0 0 10px 0;"><strong>Status:</strong> {{ $book->availability_label }}</p>
                    <p style="margin:0 0 20px 0;">
                        <strong>Category:</strong> {{ $book->category ? $book->category->name : 'No category' }}
                    </p>

                    <div style="display:flex; gap:12px; align-items:center;">
                        <a href="{{ route('books.edit', $book) }}"
                        style="display:inline-block; padding:10px 18px; background:#0d6efd; color:white; text-decoration:none; border-radius:10px; font-weight:600;">
                            Edit
                        </a>

                        <form action="{{ route('books.destroy', $book) }}" method="POST" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                onclick="return confirm('Delete this book?')"
                                style="padding:10px 18px; background:#dc3545; color:white; border:none; border-radius:10px; cursor:pointer; font-weight:600;">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{ $books->links('pagination::bootstrap-5') }}
    <hr>
</div>
