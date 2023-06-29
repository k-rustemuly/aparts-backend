<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Services\ReferenceService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ReferenceController extends BaseController
{
    public function role(ReferenceService $service): JsonResponse
    {
        return $this->success($service->role());
    }

    public function city(ReferenceService $service): JsonResponse
    {
        return $this->success($service->city());
    }

    public function class(ReferenceService $service): JsonResponse
    {
        return $this->success($service->class());
    }

    public function technology(ReferenceService $service): JsonResponse
    {
        return $this->success($service->technology());
    }

    public function heating_type(ReferenceService $service): JsonResponse
    {
        return $this->success($service->heating_type());
    }

    public function finishing_status(ReferenceService $service): JsonResponse
    {
        return $this->success($service->finishing_status());
    }

    public function flat_statuses(ReferenceService $service): JsonResponse
    {
        return $this->success($service->flat_statuses());
    }

    public function commercial_premise_statuses(ReferenceService $service): JsonResponse
    {
        return $this->success($service->commercial_premise_statuses());
    }

    public function storeroom_statuses(ReferenceService $service): JsonResponse
    {
        return $this->success($service->storeroom_statuses());
    }

    public function banks(ReferenceService $service): JsonResponse
    {
        return $this->success($service->banks());
    }

    public function objects(ReferenceService $service): JsonResponse
    {
        return $this->success($service->objects());
    }

    public function clients(ReferenceService $service): JsonResponse
    {
        return $this->success($service->clients());
    }

    public function operation_types(ReferenceService $service): JsonResponse
    {
        return $this->success($service->operation_types());
    }

    public function transactions(Request $request, ReferenceService $service): JsonResponse
    {
        return $this->success($service->transactions($request->all()));
    }
}
