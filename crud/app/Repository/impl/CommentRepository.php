<?php

namespace App\Repository\impl;

use App\Models\Comment;
use App\Models\Post;
use App\Repository\CommentRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CommentRepository implements CommentRepositoryInterface
{

    public function allComment()
    {
        return Comment::all();
    }

    public function storeComment($data)
    {
        return Comment::create($data);
    }

    //$id = postId
    // find all comment of post by postId
    public function findComment($id)
    {
        $sql = "select * from comments where postId ='$id'";
        $result = DB::select($sql);
        return $result;
    }

    public function updateComment($data, $id)
    {
        $a = Comment::find($id);
        $a->postId = $data['postId'];
        $a->content = $data['content'];
        $a->save();
        return Comment::find($id);
    }

    public function destroyComment($id)
    {
        $c = Comment::find($id);
        $c->delete();
    }
}
