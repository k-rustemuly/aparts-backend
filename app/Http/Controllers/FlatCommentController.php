<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlatCommentAddRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Services\FlatCommentService;

class FlatCommentController extends BaseController
{
    public function store($id, $block_id, $flat_id, FlatCommentAddRequest $request, FlatCommentService $service): JsonResponse
    {
        return $service->store((int) $id, (int) $block_id, (int) $flat_id, $request->validated()) ?
            $this->success([], __('Success comment added')) :
            $this->error(__('Error comment added'));
    }

    public function createAction($id, $block_id, $flat_id, FlatCommentService $service): JsonResponse
    {
        return $this->success($service->createAction((int) $id, (int) $block_id, (int) $flat_id));
    }

    public function list($id, $block_id, $flat_id, Request $request, FlatCommentService $service): JsonResponse
    {
        return $this->paginate($service->list((int) $flat_id, $request->all()));
    }
}
