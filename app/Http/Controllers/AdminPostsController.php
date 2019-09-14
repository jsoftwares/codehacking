<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Photo;
use App\Http\Requests\PostsCreateRequest;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::lists('name', 'id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        //
        $user = Auth::user();
        $input = $request->all();
        if ($file = $request->file('image_id')) {//If there is a value for the file field
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $photo = Photo::create(['file'=>$name]);
            $input['image_id'] = $photo->id;
        }
        //$input['user_id'] = $user->id; Can't use this since not posting field from form
        $user->posts()->create($input);
        return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);
        $categories = Category::lists('name', 'id')->all();
        return view('admin.posts.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Since we have 'image_id' as foreign key in post rather than the convention 'post_id'
        //Rem to add image_id as 2nd parameter in the relationship in Post model

        $post = Post::findOrFail($id);
        if ($file = $request->file('image_id')) {//If there is a value for the file field
           if (public_path(). $post->photo->file != null) {
                unlink(public_path() . $post->photo->file); //delete exiting image from images
           }
            $name = time() . $file->getClientOriginalName();
            $file->move('images', $name);
            $post->photo->update(['file'=>$name]);

            $input = $request->all();
            $input['image_id'] = $post->photo->id;
        }else {
            $input = $request->except('image_id');
        }
        //$input['user_id'] = $user->id; Can't use this since not posting field from form
        Auth::user()->posts()->whereId($id)->first()->update($input);
        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);
        unlink(public_path(). $post->photo->file);
        $post->photo->delete();
        $post->delete();
        return redirect('admin/posts');
    }
}
