<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$comments = Comment::all();
        $comments = Comment::with('answers')
            ->where('parent_id', '=', null)
            ->get();
        //dd($comments);

        return view('index', [
            'comments' => $comments,
            'delimiter' => 0
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //dd($_POST);

        $comment = new Comment;
        $comment->parent_id = $request->parent_id;
        $comment->user_name = $request->user_name;
        $comment->email = $request->email;
        $comment->home_page = $request->home_page;
        $comment->comment = $request->comment;
        $comment->save();

        // валидация
/*        $validateFields = $request->validate([
            'user_name' => 'required',
            'email' => 'required|email',
//            'home_page' => 'required',
//            'password-confirm' => 'required'
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
//            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);*/

        $comments = Comment::all();

        return view('index', [
            'comments' => $comments,
            'delimiter' => 0
        ]);
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
    public function show(Comment $main)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $main)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $main)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $main)
    {
        //
    }
}
