<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionAddRequest;
use App\Http\Requests\TransactionApproveRequest;
use App\Http\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TransactionController extends BaseController
{
    public function index(TransactionService $service): JsonResponse
    {
        return $this->success($service->page());
    }

    public function list(Request $request, TransactionService $service): JsonResponse
    {
        return $this->paginate($service->list($request->all()));
    }

    public function store(TransactionAddRequest $request, TransactionService $service): JsonResponse
    {
        return $service->add($request->validated()) ? $this->success([], __('Success added new transaction')) : $this->error(__('Error added new transaction'));
    }

    public function createAction(TransactionService $service): JsonResponse
    {
        return $this->success($service->createAction());
    }

    public function approveAction(TransactionService $service): JsonResponse
    {
        return $this->success($service->approveAction());
    }

    public function approve(TransactionApproveRequest $request, TransactionService $service): JsonResponse
    {
        return $service->approve($request->validated()) ? $this->success([], __('Success approved')) : $this->error(__('Error approve'));
    }

}
