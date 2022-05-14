<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index(){
        $posts = auth()->user()->posts()->paginate();
        // dd($posts);
        return view('admin.posts.index', ['posts'=>$posts]);
    }

    public function show(Post $post){
        
        return view('blog-post', ['post'=>$post]);
    }

    public function create(){
        $this->authorize('create', Post::class);
        return view('admin.posts.create');
    }

    public function store(){
        $this->authorize('create', Post::class);
        $inputs = request()->validate([
            'title'=>'required|min:8|max: 100',
            'post_image'=>'mimes:jpeg,png,jpg',
            'body'=>'required'
        ]);
        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
        }
        // $request->post_image

        auth()->user()->posts()->create($inputs);
        session()->flash('created-message', 'Post was created');
        return redirect()->route('post.index');
    }

    public function destroy(Post $post, Request $request){

        $this->authorize('delete', $post);
        $post->delete();
        $request->session()->flash('deleted-message', 'Post was deleted');
        return back();
    }

    public function edit(Post $post){
        $this->authorize('view', $post); 
        // if(auth()->user()->can('view', $post)){};
        return view('admin.posts.edit', ['post'=>$post]);
    }

    public function update(Post $post){
        $inputs = request()->validate([
            'title'=>'required|min:8|max: 100',
            'post_image'=>'mimes:jpeg,png,jpg',
            'body'=>'required'
        ]);

        if(request('post_image')){
            $inputs['post_image'] = request('post_image')->store('images');
            $post->post_image = $inputs['post_image'];
        }

        $post->title = $inputs['title'];
        $post->body = $inputs['body'];

        $this->authorize('udpate', $post); // ref to 'Policies' dir, corresponds to 'update' in this dir

        // auth()->user()->posts()->save($post);
        // $post->save();
        $post->udpate();
        session()->flash('updated-message', 'Post was updated');
        return back();
    }

}
