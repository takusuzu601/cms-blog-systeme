<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    public function __construct(){
        $this->middleware('verifyCategoriesCount')->only(['create','store']);
    }
    public function index()
    {
        return view('posts.index')->with('posts',Post::all());
    }


    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }


    public function store(CreatePostsRequest $request)
    {
              //update the to storage

        // $image=$request->image->store('posts');
              //create the post

              $post=Post::create([
                  'title'=>$request->title,
                  'description'=>$request->description,
                  'content'=>$request->content,
                  'image'=>$request->file('image')->store('posts','public'),
                  'published_at'=>$request->published_at,
                  'category_id'=>$request->category,
                  'user_id'=>auth()->user()->id

              ]);

              if($request->tags){
                $post->tags()->attach($request->tags);
              }
      
              // flash message 
                session()->flash('success','投稿を登録しました');
              //redirect user

              return redirect(route('posts.index'));
    }


    public function show()
    {

    }


    public function edit(Post $post)
    {
    return view('posts.create')->with('post',$post)->with('categories',Category::all())->with('tags', Tag::all());
    }


    public function update(UpdatePostRequest $request, Post $post)
    {

        $data=$request->only(['title','description','published_at','content']);
        //check if new image

        if($request->hasFile('image')){

            //uploard it
                $image=$request->image->store('posts','public');
            //delete old one

            // Storage::delete('$post->image');

            $post->deleteImage();

            $data['image']=$image;

        }

        if($request->tags){
            $post->tags()->sync($request->tags);
        }

        //update atributes

        $post->update($data);

        //flash message

        session()->flash('success','投稿を更新しました');

        //redirect user

        return redirect(route('posts.index'));
    }


    public function destroy($id)
    {
        $post=Post::withTrashed()->where('id',$id)->firstOrFail();
    
        if($post->trashed()){
            // Storage::delete($post->image);
            $post->deleteImage();
            $post->forceDelete();
        }else{
            $post->delete();
        }
        session()->flash('success','投稿を削除しました');

        return redirect(route('posts.index'));
    }

    public function trashed (){
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->with('posts',$trashed);
    }

    public function restore($id){
        $post=Post::withTrashed()->where('id',$id)->firstOrFail();

        $post->restore();
        session()->flash('success','ゴミ箱から投稿を元に戻しました');

        return redirect()->back();
    }
}
