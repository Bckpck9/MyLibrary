<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
class BookController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request){
        $expensive = $request ->input('expensive');
        $available = $request->input('available');
        $sort = $request->input('sort');
        $search = $request->input('search');
        $categoryId = $request -> input('category_id');

        $categories = Category::all();
        $query = Book::query()->with('category'); //чтобы не было N+1 подргружаем все книги и вместе с ними ВСЕ категории
        $query = Book::query()->with('category')->idfilter();//делаем запрос к таблице с книгами чтобы получить книгу с категориями и только текущего юзера сразу

        if($expensive == 1){
            $query->expensive();
        }
        if($available == 1){
            $query->available();
        }
        if($sort == 'price'){
            $query->orderprice();
        }
        if($search){
            $query->searching($search);
        }
        if($categoryId){
            $query->category($categoryId);
        }

        $books = $query->paginate(4)->withQueryString();;
        return view('books.index',compact('books','available','expensive','sort','search','categoryId','categories'));
    }
                
    public function create(){
        $categories = Category::all();
        return view('books.create',compact('categories'));
    }

    public function store(BookStoreRequest $request){
        $validatedData = $request -> validated();
        $validatedData['is_available'] = $request->has('is_available');
        $validatedData['user_id'] = auth()->id();
        if($request->hasFile('cover_image')){
            $path=$request->file('cover_image')->store('covers','public');
            $validatedData['cover_image']=$path;
        }
        Book::create($validatedData);
        return redirect() -> route('books.index');
    }

    public function edit(Book $book){
        $this->authorize('update',$book);
        $categories = Category::all();
        return view('books.edit',compact('book','categories'));
    }

    public function update(BookUpdateRequest $request,Book $book){
        $this->authorize('update',$book);
        $validatedData = $request->validated();
        $validatedData['is_available'] = $request->has('is_available');
        if($request->hasFile('cover_image')){
            if($book->cover_image){
                Storage::disk('public')->delete($book->cover_image);
            }
            $path=$request->file('cover_image')->store('covers','public');
            $validatedData['cover_image']=$path;
        }
        $book->update($validatedData);
        return redirect()->route('books.index');
    }

    public function destroy(Book $book){
        $this->authorize('delete',$book);
        if($book->cover_image){
            Storage::disk('public')->delete($book->cover_image);
        }
        $book->delete();
        return redirect()->route('books.index');
    }
    
}
