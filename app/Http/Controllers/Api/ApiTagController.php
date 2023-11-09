<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\TagRepository;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CreateTagRequest;
use App\Http\Requests\CreateTagTranslateRequest;
use App\Http\Requests\UpdateTagTranslateRequest;
use App\Models\Tag;

class ApiTagController extends Controller
{
    private TagRepository $repository;

    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $tags = Tag::with('posts')->paginate(5);

        return response()->json(['tags' => $tags],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTagRequest $request): JsonResponse
    {
        $result = $this->repository->createTag($request);

        return response()->json($result['body'], $result['status_kod']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $tag = Tag::with('posts')->where('id', $id)->first();

        return response()->json(['tag' => $tag],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateTagRequest $request, string $id): JsonResponse
    {
        $result = $this->repository->updateTag($request, $id);

        return response()->json($result['body'], $result['status_kod']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $result = $this->repository->deleteTag($id);

        return response()->json($result['body'], $result['status_kod']);
    }

    public function storeTagTranslations(CreateTagTranslateRequest $request): JsonResponse
    {
        $result = $this->repository->createTagTranslations($request);

        return response()->json($result['body'], $result['status_kod']);
    }

    public function updateTagTranslations(UpdateTagTranslateRequest $request, string $id): JsonResponse
    {
        $result = $this->repository->updateTagTranslations($request, $id);

        return response()->json($result['body'], $result['status_kod']);
    }

    public function deleteTagTranslations($id): JsonResponse
    {
        $result = $this->repository->deleteTagTranslations($id);

        return response()->json($result['body'], $result['status_kod']);
    }
}
