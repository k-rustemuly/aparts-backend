<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankAddRequest;
use App\Http\Services\BankService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BankController extends BaseController
{
    public function index(BankService $service): JsonResponse
    {
        return $this->success($service->page());
    }

    public function list(Request $request, BankService $service): JsonResponse
    {
        return $this->paginate($service->list($request->all()));
    }

    public function store(BankAddRequest $request, BankService $service): JsonResponse
    {
        return $service->add($request->validated()) ? $this->success([], __('Success added new bank')) : $this->error(__('Error added new bank'));
    }

    public function createAction(BankService $service): JsonResponse
    {
        return $this->success($service->createAction());
    }
}
