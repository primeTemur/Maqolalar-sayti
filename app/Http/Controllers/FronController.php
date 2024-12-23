<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class FronController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request);
        $posts = Post::where('publish', '1')
                ->where('lang',app()->getLocale())
                ->orderBy('created_at', 'desc')->get();

        $categories = Category::where('lang',app()->getLocale())
                ->orderBy('name', 'desc')->get();
        
        // dd(app()->getLocale());
        return view('front.post.index', [
            'posts' => $posts,
            'categories' => $categories 
        ]);
    }
    public function PostSee($id)
    {
        // dd($id);
        $post = Post::where('publish', '1')
                    ->where('id', '=', $id)
                    // ->where('lang',app()->getLocale())
                    ->first(); // `get()` o'rniga `first()` ishlatilmoqda

        $categories = Category::where('lang',app()->getLocale())
        ->orderBy('name', 'desc')->get();
        return view('front.post.see', [
            'post' => $post,
            'categories' => $categories
        ]); 
    }

    public function show(string $id)
    {
        $lang=app()->getLocale();
        $posts = Post::where('publish', '1')
                    ->whereHas('categories', function ($query) use ($id) {
                        $query->where('categories.id', $id);
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();
        $categories = Category::where('lang', $lang)
                    ->orderBy('name', 'desc')->get();
        return view('front.post.index', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
