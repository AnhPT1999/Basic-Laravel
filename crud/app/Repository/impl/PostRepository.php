<?php

namespace App\Repository\impl;

use App\Models\Post;
use App\Repository\PostRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PostRepository implements PostRepositoryInterface
{
//    public function allPost()
//    {
//        return Post::all();
//    }

    public function allPost($status)
    {
        $sql = "select * from posts where status ='$status'";
        $result = DB::select($sql);
        return $result;

    }


    public function storePost($data)
    {
        return Post::create($data);
    }

    public function findPost($id)
    {
        return Post::find($id);
    }

    public function updatePost($data, $id)
    {
        $a = Post::find($id);
        $a->title = $data['title'];
        $a->description = $data['description'];
        $a->status = $data['status'];
        $a->save();
        return Post::find($id);
    }

    public function destroyPost($id)
    {
        $post = Post::find($id);
        $post->delete();
    }
}
