<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ObjectAddRequest;
use App\Http\Services\ObjectService;
use App\Models\Objects;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ObjectController extends BaseController
{

    public function index(ObjectService $service): JsonResponse
    {
        return $this->success($service->page());
    }

    public function list(Request $request, ObjectService $service): JsonResponse
    {
        return $this->paginate($service->list($request->all()));
    }

    public function store(ObjectAddRequest $request, ObjectService $service): JsonResponse
    {
        return $service->add($request->validated()) ? $this->success([], __('Success added new object')) : $this->error(__('Error added new object'));
    }

    public function show(Objects $id, ObjectService $service): JsonResponse
    {
        return $this->success($service->about($id));
    }

    public function createAction(ObjectService $service): JsonResponse
    {
        return $this->success($service->createAction());
    }
}
