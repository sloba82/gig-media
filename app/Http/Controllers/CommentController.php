<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Services\CommentService;
use App\Http\Resources\GetResource;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\CommentGetRequest;
use App\Http\Requests\CommentCreateRequest;

class CommentController extends Controller
{

    public function index(CommentGetRequest $request, CommentService $commentService)
    {

        $filters = $request->validated();
        try {
            $model = $commentService->getResourceWithPagination($filters);
        } catch (\Exception $exception) {
            Log::error('Error while getting Comment' . $exception->getMessage());
            return response()->json('error', 500);
        }

        return new GetResource($model);
    }

    public function delete($id)
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

        return response()->json('error', 500);
    }

    public function create(CommentCreateRequest $request, Comment $comment)
    {

        $input = $request->all();
        try {
            $input = $request->all();
            $comment::create([
                'post_id' => $input['post_id'],
                'content' => $input['content'],
                'abbreviation' => $input['content'],
            ]);
        } catch (\Exception $exception) {
            Log::error('Error while Creating Comment' . $exception->getMessage());
            return response()->json('error', 500);
        }

        return response()->json('', 201);
    }
}
