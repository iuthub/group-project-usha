<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostSkill;
use App\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $skills = Skill::all();

        return view('post/create', [
            'skills' => $skills
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $skills = $request->skills;
        $validatedReq = $request->validate([
            'name' => 'required',
            'about' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            'contact' => '',
            'reference' => '',
            'price' => 'required'
        ]);

        $post = Post::create($validatedReq);
        foreach($skills as $skill) {
            PostSkill::create([
                'name' => $skill,
                'post_id' => $post->id
            ]);
        }

        return redirect('/home')
                ->with(['msg' => 'Post has been created successfuly']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Post $post)
    {
        return view('/post/show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        if(Auth()->user()->id == $post->user_id){
            return view('/post/edit', ['post' => $post, 'requireAssetForEdit' => true]);
        }else{
            return redirect('/home')->with(['msg', 'Project can only be changed by author']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        $validatedReq = $request->validate([
            'name' => 'required',
            'about' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            'contact' => '',
            'reference' => '',
            'price' => 'required',
        ]);
        $post->update($validatedReq);
        return redirect('/home')
                ->with(['msg' => 'Project has been updated successfuly']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(Auth()->user()->id == $post->user_id)
        {
            $post->delete();
            return redirect('/home')
                    ->with(['msg' => 'Project has been deleted successfuly']);
        }
        return redirect('/home')
                ->with(['msg' => 'Project can only be deleted by author']);
    }


    public function search(Request $request)
    {
        $search = $request->search;

        $posts = Post::find(1)
                        ->where('name', 'like', '%'. $search .'%')
                        ->orderBy('created_at')
                        ->paginate(10);
        $data = [
            'posts' => $posts,
            'render' => 'home'
        ];

        return view('/home', ['data' => $data]);
    }
}
