<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlatAddRequest;
use App\Http\Services\FlatService;
use App\Models\Block;
use App\Models\Flat;
use App\Models\Objects;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FlatController extends BaseController
{
    public function page(FlatService $service): JsonResponse
    {
        return $this->success($service->page());
    }

    public function all(Request $request, FlatService $service): JsonResponse
    {
        return $this->paginate($service->all($request->all()));
    }

    public function list($id, $block_id, Request $request, FlatService $service): JsonResponse
    {
        return $this->paginate($service->list((int) $block_id, $request->all()));
    }

    public function store($id, $block_id, FlatAddRequest $request, FlatService $service): JsonResponse
    {
        return $service->add((int) $id, (int) $block_id, $request->validated()) ?
            $this->success([], __('Success added new flat')) :
            $this->error(__('Error added new flat'));
    }

    public function show(Objects $id, Block $block_id, Flat $flat_id, FlatService $service): JsonResponse
    {
        return $this->success($service->show($id, $block_id, $flat_id));
    }

    public function createAction($id, $block_id, FlatService $service): JsonResponse
    {
        return $this->success($service->createAction((int) $id, (int) $block_id));
    }

    public function about(Flat $flat_id, FlatService $service): JsonResponse
    {
        return $this->success($service->about($flat_id));
    }
}
