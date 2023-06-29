<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingAddRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Services\BookingService;
use App\Models\Flat;

class BookingController extends BaseController
{
    public function store($id, $block_id, Flat $flat_id, BookingAddRequest $request, BookingService $service): JsonResponse
    {
        return $service->flatBooking((int) $id, (int) $block_id, $flat_id, $request->validated()) ?
            $this->success([], __('Success booked')) :
            $this->error(__('Error booked'));
    }

    public function createAction($id, $block_id, Flat $flat_id, BookingService $service): JsonResponse
    {
        return $this->success($service->createAction((int) $id, (int) $block_id, $flat_id));
    }

    public function calcAction($id, $block_id, Flat $flat_id, BookingService $service): JsonResponse
    {
        return $this->success($service->calcAction($flat_id));
    }


}
