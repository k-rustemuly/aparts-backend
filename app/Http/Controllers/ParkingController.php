<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParkingAddRequest;
use App\Http\Services\ParkingService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ParkingController extends BaseController
{
    public function page(ParkingService $service): JsonResponse
    {
        return $this->success($service->page());
    }

    public function all(Request $request, ParkingService $service): JsonResponse
    {
        return $this->paginate($service->all($request->all()));
    }

    public function list($id, Request $request, ParkingService $service): JsonResponse
    {
        return $this->paginate($service->list((int) $id, $request->all()));
    }

    public function store($id, ParkingAddRequest $request, ParkingService $service): JsonResponse
    {
        return $service->add((int) $id, $request->validated()) ? $this->success([], __('Success added new parking places')) : $this->error(__('Error added new parking places'));
    }

    public function createAction($id, ParkingService $service): JsonResponse
    {
        return $this->success($service->createAction($id));
    }
}
