<?php

namespace App\Http\Controllers\Api;

use App\Jobs\TestCreatePostJob;
use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Repository\impl\PostRepository;
use App\Service\PostServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    private $service;
    private $job;

    public function __construct(PostServiceInterface $service, TestCreatePostJob $createPostJob)
    {
        $this->service = $service;
        $this->job = $createPostJob;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Cache::remember("index", 10, function () use ($request){
            $status = $request->integer('status');
            if ($status == 0 || $status == 1) {
                $posts = $this->service->allPost($status);
                return new PostResource($posts);
            } else {
                return response()->json(['message' => 'ko co status Chi nhan status 0 & 1'], 200);
            }
        });
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
//    public function store(Request $request)
//    {
//        $data = $request->validate([
//            'title' => 'required|string|max:70',
//            'description' => 'required|string|max:255',
//            'status' => 'required|int'
//
//        ]);
//
//        return $this->service->storePost($data);
//    }

// Test job
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:70',
            'description' => 'required|string|max:255',
            'status' => 'required|int'

        ]);
        $createPost = $this->service->storePost($data);

        TestCreatePostJob::dispatch($createPost);

        return response()->json(['message' => 'successful'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->service->findPost($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:70',
            'description' => 'required|string|max:255',
            'status' => 'required|int'
        ]);

        return $this->service->updatePost($request->all(), $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->service->destroyPost($id);

        return response(null, 204);
    }

    //-------------------------------------------

    public function getAllPost(PostRepository $p)
    {
        $result = Post::all();
        return response()->json($result, 200);
    }

    public function getPostById($id)
    {
        $post = Post::find($id);
        if ($post) {
            return response()->json($post, 200);
        } else {
            return response()->json(['message' => 'Post not found'], 200);
        }
    }

    public function addPost(Request $request)
    {
        $post = Post::create($request->all());
        return response($post, 201);
    }

    public function updatePost(Request $request, $id)
    {
        $post = Post::find($id);
        if (is_null($post)) {
            return response()->json(['message' => 'Post not found'], 404);
        } else {
            $post->update($request->all());
            return response($post, 200);
        }
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post = Post::destroy($id);
            return response()->json(['message' => 'Post deleted'], 200);
        } else {
            return response()->json(['message' => 'Post not found'], 404);
        }
    }

}
