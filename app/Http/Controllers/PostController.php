<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);
        return view('posts.index',['posts' => $posts]);
    }
    
    public function show($id)
    {
        
        $post=Post::findOrfail($id);
           
        return view('posts.show',compact('post'));
    }
    //
    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
       $imageName='imagedefault.jpg';
        if($request->hasFile('image')){
            $imageName = time().uniqid().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }
       
       Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageName,
        ]);
       
        return redirect()->route('posts.index');
    }


    public function edit($id)
    {
        $post=Post::findOrfail($id);
        if($post){
            return view('posts.edit',['post'=>$post]);
        }
        abort(404);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6144',
        ]);
        $post = Post::findOrfail($id);
        $imageName='imagedefault.jpg';
        if($request->hasFile('image')){
            $imageName = time().uniqid().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            if (file_exists(public_path('images').'/'.$post->image) && $post->image != 'imageDefault.jpg') {
                unlink(public_path('images').'/'.$post->image);
            }
        }
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageName,
        ]);
        return redirect()->route('posts.index');
    }



    public function destroy($id)
    {
        $post = Post::findOrfail($id);
        $imgname=$post->image;
        $post->delete();
        if (file_exists(public_path('images').'/'.$imgname) && $imgname != 'imageDefault.jpg') {
            unlink(public_path('images').'/'.$imgname);
        }
       return redirect()->route('posts.index');
    }
}
