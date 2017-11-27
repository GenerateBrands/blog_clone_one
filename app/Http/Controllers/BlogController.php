<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{

    public function getIndex(){
       $posts = Post::paginate(1);

       return view('blog.index')->with('posts',$posts);
    }

    public function getSingle($slug){

      //Fetch the Post item from the Db based on the slug.
      $post = Post::where('slug', '=', $slug)->first();

      //Return the view and pass in the post object.
      return view('blog.single')->with('post',$post);
    }

}
