<?php

namespace App\Http\Controllers;
use App\Post;
/**
 *
 */
class PagesController extends Controller
{

  // function __construct(argument)
  // {
  //   # code...
  // }

  public function getIndex(){

      $posts = Post::orderBy('created_at', 'desc')->limit(2)->get();
      return view('pages.welcome')->with('posts',$posts);
  }

  public function getAbout(){
      return view('pages.about');
  }

  public function getContact(){
      return view('pages.contact');
  }
}


?>
