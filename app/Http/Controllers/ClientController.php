<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientAddRequest;
use App\Http\Services\ClientService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ClientController extends BaseController
{
    public function index(ClientService $service): JsonResponse
    {
        return $this->success($service->page());
    }

    public function list(Request $request, ClientService $service): JsonResponse
    {
        return $this->paginate($service->list($request->all()));
    }

    public function store(ClientAddRequest $request, ClientService $service): JsonResponse
    {
        return $service->add($request->validated()) ? $this->success([], __('Success added new client')) : $this->error(__('Error added new client'));
    }

    public function createAction(ClientService $service): JsonResponse
    {
        return $this->success($service->createAction());
    }
}
