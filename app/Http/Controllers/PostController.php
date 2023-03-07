<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\GetResource;

class PostController extends Controller
{
    public function index(Request $request, PostService $postService)
    {

        $filters = $request->all();
        try {
            $model = $postService->getResourceWithPagination($filters);
        } catch (\Exception $exception) {
            Log::error('Error while getting Post' . $exception->getMessage());
            return response()->json('error', 500);
        }

        return new GetResource($model);
    }
}
