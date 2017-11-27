<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
Use Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //create a variable and store al the blog Posts
        $posts = Post::orderBy('id','desc')->paginate(2);
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate
        $this->validate($request, array
        (
          'title' => 'required|max:255',
          'slug'  => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
          'body'  => 'required'
        ));

        //Save to the Database
        $post = new Post;

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;

        $post->save();

        Session::flash('success', 'Post successfully saved!');

        return redirect()->route('posts.show', $post->id);
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
        $post = Post::Find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //create a variable and store the model in that variable.
        $post = Post::find($id);

        //pass the $post variable to the view.
        return view('posts.edit')->with('post', $post);
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
        $post = Post::find($id);

        if($request->input('slug') == $post->slug ){

          $this -> validate($request, array(
            'title' => 'required|max:255',
            'body'  => 'required'
          ));
        }

        else {
        //Validate the data
        $this -> validate($request, array(
          'title' => 'required|max:255',
          'slug'  => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
          'body'  => 'required'
        ));
        }

        //Save the data to the Database

        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->body = $request->input('body');

        $post->save();

        //Set flash data with the success message
        Session::flash('success', 'This post is successfully updated');

        //redirect with flash data to posts.Show
        return redirect()->route('posts.show', $post->$id);

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
        $post = Post::find($id);

        $post->delete();

        Session::flash('success', 'The post was deleted successfully');

        return redirect()->route('posts.index');
    }
}
