<?php

namespace App\Http\Controllers;

use App\Models\Main;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        dd($_POST);

        // валидация
        $validateFields = $request->validate([
            'user_name' => 'required',
            'email' => 'required|email',
            //'home_page' => 'required',
            /*'password-confirm' => 'required'
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],*/
        ]);

        return view('index', [
            //'view' => $view
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
    public function show(Main $main)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Main $main)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Main $main)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Main $main)
    {
        //
    }
}
