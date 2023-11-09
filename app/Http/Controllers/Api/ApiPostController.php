<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreatePostRequest;
use App\Repositories\PostRepository;

class ApiPostController extends Controller
{
    private PostRepository $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $posts = Post::with('postTranslations', 'tags')->paginate(5);

        return response()->json(['posts' => $posts],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request): JsonResponse
    {
        $result = $this->repository->createPost($request);

        return response()->json($result['body'], $result['status_kod']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $post = Post::with('tags','postTranslations')->where('id', $id)->first();

        return response()->json(['post' => $post],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreatePostRequest $request, string $id): JsonResponse
    {
        $result = $this->repository->updatePost($request, $id);

        return response()->json($result['body'], $result['status_kod']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $result = $this->repository->deletePost($id);

        return response()->json($result['body'], $result['status_kod']);
    }
}
