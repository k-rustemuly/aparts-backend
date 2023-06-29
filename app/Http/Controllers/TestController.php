<?php

namespace App\Http\Controllers;

use App\Http\Services\TestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TestController extends BaseController
{
    public function index(TestService $service): JsonResponse
    {
        $data = Cache::remember('test_cache', 600, function () use ($service) {
            return Cache::get('test_cache', function () use ($service)  {
                return $service->page();
            });
        });
        return $this->success($data);
    }

    public function list(Request $request, TestService $service): JsonResponse
    {
        return $this->paginate($service->list($request->all()));
    }

    public function store(Request $request, TestService $service): JsonResponse
    {
        return $service->add($request->all()) ? $this->success([], __('Success added new test')) : $this->error(__('Error added new test'));
    }

    public function createAction(TestService $service): JsonResponse
    {
        return $this->success($service->createAction());
    }

    public function test(TestService $service): JsonResponse
    {
        return $this->success($service->test());
    }
}
