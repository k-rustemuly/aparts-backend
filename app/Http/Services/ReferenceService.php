<?php

namespace App\Http\Services;

use App\Http\Resources\BanksReferenceResource;
use App\Http\Resources\CityReferenceResource;
use App\Http\Resources\ClassReferenceResource;
use App\Http\Resources\ClientReferenceResource;
use App\Http\Resources\CommercialPremiseStatusReferenceResource;
use App\Http\Resources\FinishingStatusReferenceResource;
use App\Http\Resources\FlatStatusReferenceResource;
use App\Http\Resources\HeatingTypeReferenceResource;
use App\Http\Resources\ObjectReferenceResource;
use App\Http\Resources\ReferenceResource;
use App\Http\Resources\RoleReferenceResource;
use App\Http\Resources\StoreroomStatusReferenceResource;
use App\Http\Resources\TechnologyReferenceResource;
use App\Http\Resources\TransactionReferenceResource;
use App\Models\Bank;
use App\Models\City;
use App\Models\Client;
use App\Models\CommercialPremiseStatus;
use App\Models\ConstructionTechnology;
use App\Models\FinishingStatus;
use App\Models\FlatStatus;
use App\Models\HeatingType;
use App\Models\ObjectClass;
use App\Models\Objects;
use App\Models\OperationType;
use App\Models\Role;
use App\Models\StoreroomStatus;
use App\Models\Transaction;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReferenceService
{

    public function role(): ResourceCollection
    {
        return RoleReferenceResource::collection(Role::reference()->get());
    }

    public function city(): ResourceCollection
    {
        return CityReferenceResource::collection(City::all());
    }

    public function class(): ResourceCollection
    {
        return ClassReferenceResource::collection(ObjectClass::all());
    }

    public function technology(): ResourceCollection
    {
        return TechnologyReferenceResource::collection(ConstructionTechnology::all());
    }

    public function heating_type(): ResourceCollection
    {
        return HeatingTypeReferenceResource::collection(HeatingType::all());
    }

    public function finishing_status(): ResourceCollection
    {
        return FinishingStatusReferenceResource::collection(FinishingStatus::all());
    }

    public function flat_statuses(): ResourceCollection
    {
        return FlatStatusReferenceResource::collection(FlatStatus::all());
    }

    public function commercial_premise_statuses(): ResourceCollection
    {
        return CommercialPremiseStatusReferenceResource::collection(CommercialPremiseStatus::all());
    }

    public function storeroom_statuses(): ResourceCollection
    {
        return StoreroomStatusReferenceResource::collection(StoreroomStatus::all());
    }

    public function banks(): ResourceCollection
    {
        return BanksReferenceResource::collection(Bank::all());
    }

    public function objects(): ResourceCollection
    {
        return ObjectReferenceResource::collection(Objects::all());
    }

    public function clients(): ResourceCollection
    {
        return ClientReferenceResource::collection(Client::orderByDesc('created_at')->get());
    }

    public function operation_types(): ResourceCollection
    {
        return ReferenceResource::collection(OperationType::all());
    }

    public function transactions(array $searchAndFilter = []): ResourceCollection
    {
        $transactions = Transaction::filter($searchAndFilter)
                            ->orderBy('created_at', 'desc')
                            ->get();
        return TransactionReferenceResource::collection($transactions);
    }

}
