<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Services\CommentService;
use App\Http\Resources\GetResource;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CommentGetRequest;
use App\Http\Requests\CommentCreateRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Exception\JsonException;
use Symfony\Component\HttpFoundation\JsonResponse as HttpFoundationJsonResponse;

class CommentController extends Controller
{

    private $commentService;

    /**
     * __construct
     *
     * @param  CommentService $commentService
     * @return void
     */
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * index
     *
     * @param  CommentGetRequest $request
     * @param  CommentService $commentService
     * @return GetResource
     */
    public function index(CommentGetRequest $request): GetResource
    {
        $filters = $request->validated();
        try {
            $model = $this->commentService->getResourceWithPagination($filters);
        } catch (\Exception $exception) {
            Log::error('Error while getting Comment' . $exception->getMessage());
            return response()->json('error', 500);
        }

        return new GetResource($model);
    }

    /**
     * delete
     *
     * @param integer $id
     * @return mixed
     */
    public function delete($id): mixed
    {
        try {
            if (Comment::where('id', $id)->exists()) {
                Comment::find($id)->delete();
                return true;
            }
        } catch (\Exception $exception) {
            Log::error('Error while deleting Comment' . $exception->getMessage());
            return response()->json('error', 500);
        }

        return response()->json('error', 200);
    }

    /**
     * create
     *
     * @param  CommentCreateRequest $request
     * @param  Comment $comment
     * @return JsonResponse
     */
    public function create(CommentCreateRequest $request, Comment $comment): JsonResponse
    {
        $input = $request->validated();
        try {
            $this->commentService->create($input);
        } catch (\Exception $exception) {
            Log::error('Error while Creating Comment' . $exception->getMessage());
            return response()->json('error', 500);
        }

        return response()->json([], 201);
    }
}
