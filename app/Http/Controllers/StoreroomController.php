<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreroomAddRequest;
use App\Http\Services\StoreroomService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StoreroomController extends BaseController
{
    public function page(StoreroomService $service): JsonResponse
    {
        return $this->success($service->page());
    }

    public function all(Request $request, StoreroomService $service): JsonResponse
    {
        return $this->paginate($service->all($request->all()));
    }

    public function list($id, $block_id, Request $request, StoreroomService $service): JsonResponse
    {
        return $this->paginate($service->list((int) $block_id, $request->all()));
    }

    public function store($id, $block_id, StoreroomAddRequest $request, StoreroomService $service): JsonResponse
    {
        return $service->add((int) $id, (int) $block_id, $request->validated()) ? $this->success([], __('Success added new storeroom')) : $this->error(__('Error added new storeroom'));
    }

    public function createAction($id, $block_id, StoreroomService $service): JsonResponse
    {
        return $this->success($service->createAction((int) $id, (int) $block_id));
    }
}
