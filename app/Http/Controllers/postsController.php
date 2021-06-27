<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class postsController extends Controller
{
    //
    public function index()
    {$posts=post::orderBy('id','asc')->get();
        $count=post::count();
        return view('posts.index',compact('posts','count'));
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request)
    {
        dd($request);
    }
    public function show()
    {
        return view('posts');
    }
}
