<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $catgs=Categorie::all();
        return view('Users.categories',compact('catgs'));   
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('Users.add_catg');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title"=>"required|string|max:255",
            "description"=>"required|string"
        ]);
        Categorie::create([
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);
        return redirect()->route('categories.index')->with('success', 'categorie added successfully');  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

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
