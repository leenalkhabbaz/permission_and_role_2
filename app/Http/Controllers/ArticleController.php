<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{


    public function index()
    {
    $articles = Article::latest()->paginate(5);
    return view('articles.index',compact('articles'))
    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
       return view('articles.create');
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'detail' => 'required',
    ]);

    $validatedData['user_id'] = auth()->user()->id;

    Article::create($validatedData);

    return redirect()->route('articles')->with('success', 'Article created successfully.');
}

    public function show(Article $article,$id)
    {
        $article = Article::find($id);

    return view('articles.show',compact('article'));
    }

    public function edit(Article $article,$id)
    {

    $article = Article::find($id);
    return view('articles.edit',compact('article'));
    }

    public function update(Request $request,$id)
    {
    request()->validate([
    'name' => 'required',
    'detail' => 'required',
    ]);
    $article = Article::find($id);
    $article->update($request->all());
    return redirect()->route('articles')
    ->with('success','Article updated successfully');
    }

    public function destroy($id)
    {

        Article::find($id)->delete();
    return redirect()->route('articles')
    ->with('success','Article deleted successfully');
    }
}
