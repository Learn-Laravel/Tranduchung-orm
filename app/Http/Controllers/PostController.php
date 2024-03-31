<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        // $allPost = Post::all();
        // dd($allPost);
        // $post = Post::find('c1');
        // dd($post);
        $post = new Post();
        $post -> title = 'Bài viết 3';
        $post -> content ='Nội dung 3';
        // $post -> status =1;
        $post->save();
    }
}
