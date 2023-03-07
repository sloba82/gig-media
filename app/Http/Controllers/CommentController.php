<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CommentService;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\GetResource;

class CommentController extends Controller
{
    public function index(Request $request, CommentService $commentService)
    {

        $filters = $request->all();

        try {
            $model = $commentService->getResourceWithPagination($filters);
        } catch (\Exception $exception) {
            Log::error('Error while getting Comment' . $exception->getMessage());
            return response()->json('error', 500);
        }

        return new GetResource($model);
    }
}
