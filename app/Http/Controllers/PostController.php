<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {

        // $post = Post::find('c1');
        // dd($post);
        // $post = new Post();
        // $post -> title = 'Bài viết 3';
        // $post -> content ='Nội dung 3';
        // $post -> status =1;
        // $post->save();
        // $allPost = Post::all();
        // dd($allPost);

        // if ($allPost->count()>0){
        //     foreach($allPost as $item){
        //         echo $item->title.'<br/>';
        //     }
        // }

        // $detail = Post::find(1);
        // dd($detail);
        // $activePost = DB::table('posts')->where('status', '1')->get();
        // $activePost = Post::where('status', '1')->orderBy('id', 'DESC')->get();
        // dd($activePost);
        // if ($activePost->count() > 0) {
        //     foreach ($activePost as $item) {
        //         echo $item->title . '<br/>';
        //     }
        // }
        // $posts = Post::all();
        // $posts = $posts->reject(function($post){

        //     return $post->status==0;
        // });
        // dd($posts);
        // Post::chunk(2, function($posts){
        //     foreach($posts as $post){
        //         echo $post->title . '<br/>';
        //     }
        //     echo 'keets thuc chuck';
        // });
        $allPost = Post::where('status', 1)->cursor();
        foreach ($allPost as $post) {
            echo $post->title . '<br/>';
        }
    }
}
