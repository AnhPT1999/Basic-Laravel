<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Service\CommentServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    private $service;

    public function __construct(CommentServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = $this->service->allComment();
        return new CommentResource($posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pId = $request->get('postId');
        $sql = "select * from posts where status = '1' and id = '$pId'";
        $s = DB::select($sql);
        $post = Post::find($pId);

        if (is_null($post)) {
            return response()->json(['message' => 'Post not found'], 404);
        } elseif (empty($s)) {
            return response()->json(['message' => 'Post not public'], 404);
        } else {
            $data = $request->validate([
                'postId' => 'required',
                'content' => 'required|string|max:255',
            ]);
            return $this->service->storeComment($data);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            return response()->json(['message' => 'Post not found'], 404);
        } else {
            return $this->service->findComment($id);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'postId' => 'required',
            'content' => 'required|string|max:255',
        ]);

        return $this->service->updateComment($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $c = Comment::find($id);
        if ($c) {
            Comment::destroy($id);
            return response()->json(['message' => 'Post deleted'], 200);
        } else {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }
}
