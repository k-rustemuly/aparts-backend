<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeAddRequest;
use App\Http\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EmployeeController extends BaseController
{
    public function index(EmployeeService $service): JsonResponse
    {
        return $this->success($service->page());
    }

    public function list(Request $request, EmployeeService $service): JsonResponse
    {
        return $this->paginate($service->list($request->all()));
    }

    public function store(EmployeeAddRequest $request, EmployeeService $service): JsonResponse
    {
        return $service->add($request->validated()) ? $this->success([], __('Success added new employee')) : $this->error(__('Error added new employee'));
    }

    public function createAction(EmployeeService $service): JsonResponse
    {
        return $this->success($service->createAction());
    }
}
