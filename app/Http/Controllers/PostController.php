<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

use Illuminate\Http\Request;

use App\Http\Requests;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view('articles.index')->with(compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all()->lists('name', 'id');
        return view('articles.create')->with(compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StorePostRequest $request)
    {
        /*$post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->user_id;
        $post->save();*/
        /*$this->validate($request,
            [
                'user_id' => 'required',
                'title' => 'required|min:10',
                'description' => 'required|min:10',
            ],
            [
                'user_id.required' => 'Veuillez indiquez un auteur',
                'title.required' => 'Titre requis',
                'title.min' => 'Titre de 10 caractères au moins',
                'description.required' => 'Description requise',
                'description.min' => 'Description de 10 caractères au moins',
            ]);*/
        $post = Post::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return redirect()->route('articles.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $comments = Comment::where('post_id', $id)->get();
        //dd($comments);
        //$comments = Comment::all();
        if($post){
            return view('articles.show')->with(compact('post','comments'));
            //return $post->title;
        }
        else{
            return view('articles.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $users = User::all()->lists('name', 'id');
        if($post)
            return view('articles.edit')->with(compact('post','users'));
        else
            return view('articles.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\StorePostRequest $request, $id)
    {
        $post = Post::find($id);
        if($post){
            $post->title = $request->title;
            $post->description = $request->description;
            $post->user_id = $request->user_id;
            $post->save();
            return redirect()->route('articles.show', $id);
        }
        else{
            return redirect()->to('/articles');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if($post){
            $post->delete();
            return redirect()->to('/articles');
        }
        else
            return redirect()->to('/articles');
    }
}
