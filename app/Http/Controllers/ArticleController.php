<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Models\Categorie;
use App\Models\Article;



class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::where('id', Auth::id())->first();
        $menus = Menu::where('restaurant_id', $user->restaurant_id)->pluck('id');

        // $articles = Article::whereIn('menu_id', $menus)->get();
        $articles = Article::all();
        return view('owner.articles', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::where('id', Auth::id())->first();
        $menus = Menu::where('restaurant_id', $user->restaurant_id)->get();
        $ar = array();
        foreach ($menus as $m) {
            $Articls = Article::where('menu_id', $m->id)->get();
            foreach ($Articls as $art) {
                $ar[] = $art;
            }
        }


        $catgs = Categorie::all();


        return view("owner.add_article", compact("menus", "catgs", "user", 'ar'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required',
            'menu' => 'required',
            'media' => 'required',
            // 'menu_id' => 'required|exists:menu,id', 
        ]);

        $article = Article::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),

            'menu_id' => $request->input('menu'),
            'categorie_id' => $request->input('category'),

        ]);

      
        $article->addMediaFromRequest('media')->toMediaCollection('images');

        return redirect()->route('Articles.index')->with('success', 'article added successfully');
    }


     

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $articles = Article::where('menu_id', $id)->get();
        return view('owner.articles', compact('articles'));
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
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'category' => 'required',
        'menu' => 'required',
    ]);

    $article = Article::findOrFail($id);

    // Update article attributes
    $article->update([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'price' => $request->input('price'),
        'menu_id' => $request->input('menu'),
        'categorie_id' => $request->input('category'),
    ]);

    // Handle media update
    if ($request->hasFile('media')) {
        // Remove existing media
        $article->clearMediaCollection('images');

        // Add new media
        $article->addMediaFromRequest('media')->toMediaCollection('images');
    }

    return redirect()->route('Articles.index')->with('success', 'Article updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('Articles.index')->with('success', 'Article deleted successfully');
    }
}
