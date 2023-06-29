<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlockAddRequest;
use App\Http\Services\BlockService;
use App\Models\Block;
use App\Models\Objects;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlockController extends BaseController
{
    public function list($id, Request $request, BlockService $service): JsonResponse
    {
        return $this->paginate($service->list((int) $id, $request->all()));
    }

    public function store($id, BlockAddRequest $request, BlockService $service): JsonResponse
    {
        return $service->add((int) $id, $request->validated()) ? $this->success([], __('Success added new block')) : $this->error(__('Error added new block'));
    }

    public function show(Objects $id, Block $block_id, BlockService $service): JsonResponse
    {
        return $this->success($service->show($id, $block_id));
    }

    public function createAction($id, BlockService $service): JsonResponse
    {
        return $this->success($service->createAction($id));
    }
}
