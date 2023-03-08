<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;
use App\Http\Resources\GetResource;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\PostGetRequest;
use App\Models\Post;

class PostController extends Controller
{

    /**
     * index
     *
     * @param  PostGetRequest $request
     * @param  PostService $postService
     * @return GetResource
     */
    public function index(PostGetRequest $request, PostService $postService): GetResource
    {
        $filters = $request->validated();
        try {
            $model = $postService->getResourceWithPagination($filters);
        } catch (\Exception $exception) {
            Log::error('Error while getting Post' . $exception->getMessage());
            return response()->json('error', 500);
        }

        return new GetResource($model);
    }

    public function delete(Post $post)
    {

        try {
            $post->delete();
        } catch (\Exception $exception) {
            Log::error('Error while deleting Post' . $exception->getMessage());
            return response()->json('error', 500);
        }

        return response()->json('', 204);
    }
}
