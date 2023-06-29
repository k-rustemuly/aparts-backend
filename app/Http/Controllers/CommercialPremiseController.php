<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommercialPremiseAddRequest;
use App\Http\Services\CommercialPremiseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommercialPremiseController extends BaseController
{
    public function page(CommercialPremiseService $service): JsonResponse
    {
        return $this->success($service->page());
    }

    public function all(Request $request, CommercialPremiseService $service): JsonResponse
    {
        return $this->paginate($service->all($request->all()));
    }

    public function list($id, $block_id, Request $request, CommercialPremiseService $service): JsonResponse
    {
        return $this->paginate($service->list((int) $block_id, $request->all()));
    }

    public function store($id, $block_id, CommercialPremiseAddRequest $request, CommercialPremiseService $service): JsonResponse
    {
        return $service->add((int) $id, (int) $block_id, $request->validated()) ?
            $this->success([], __('Success added new commerical premise')) :
            $this->error(__('Error added new commerical premise'));
    }

    public function createAction($id, $block_id, CommercialPremiseService $service): JsonResponse
    {
        return $this->success($service->createAction((int) $id, (int) $block_id));
    }
}
