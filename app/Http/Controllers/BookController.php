<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Bookshelf;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        $data['books'] = Book::all();
        return view('books.index',$data);
    }

    public function create(){
        $data['bookshelves']=Bookshelf::all();
        return view('books.create',$data);
    }
    public function store(Request $request){
        $validated = $request->validate([
        'title' => 'required|max:255',
        'author' => 'required|max:255',
        'year' => 'required',
        'publisher' => 'required|max:255',
        'city' => 'required|max:50',
        'cover' => 'required|image',
        'bookshelf_id' => 'required|max:5',
        ]);
        $book = Book::create($validated);
        if($book){
            $notification[] = [
            'message' => 'Data buku berhasil disimpan',
            'alert-type' => 'success'
            ];
            
        } else {
            $notification[] = [
                'message' => 'Data buku gagal disimpan',
                'alert-type' => 'error'
                ];
        }
        return  redirect()->route('book')->with($notification);
        
    }
}
