<?php

namespace App\Http\Services;

use App\Http\Resources\ParkingAllResource;
use App\Http\Resources\ParkingResource;
use App\Models\Parking;
use Buildit\Decorations\Button;
use Buildit\Decorations\Column;
use Buildit\Decorations\DataList;
use Buildit\Decorations\Field;
use Buildit\Decorations\Grid;
use Buildit\Decorations\Raw;
use Buildit\Decorations\Table;
use Buildit\Enum\AfterResponse;
use Buildit\Enum\RequestType;
use Buildit\Enum\Style;
use Buildit\Fields\Number;
use Buildit\Fields\Reference;

class ParkingService
{

    public function page(): array
    {
        return [
            Grid::make([
                Column::make('', [
                    Table::make('parkings')
                        ->header([
                            Raw::make('object'),
                            Raw::make('number')->sortable()->searchable(),
                            Raw::make('status'),
                        ])
                        ->contentUrl(route('app.storerooms.list'))
                        ->filter([
                            Reference::make('objects')
                                ->count(-1)
                                ->contentUrl(route('app.reference.objects')),
                            Reference::make('statuses', 'flat_statuses')
                                ->count(-1)
                                ->contentUrl(route('app.reference.flat_statuses')),
                        ]),
                ]),
            ])
        ];
    }

    public function all(array $searchAndFilter = [])
    {
        $storeroom = Parking::getAll($searchAndFilter)->paginateFilter();

        return ParkingAllResource::collection($storeroom)
                ->response()
                ->getData(true);
    }

    public function list(int $objectId, array $searchAndFilter = [])
    {
        $parking = Parking::byObject($objectId)->filter($searchAndFilter)->paginateFilter();

        return ParkingResource::collection($parking)
                ->response()
                ->getData(true);
    }

    public function add(int $objectId, array $data): bool
    {
        return Parking::generateAndSave($objectId, (int) $data["count"]) > 0;
    }

    public function createAction($objectId): array
    {
        return [
            Grid::make([
                Column::make('', [
                    DataList::make('add_new_parking', 'Add new parking', [
                        Field::make('count')
                            ->value(
                                Number::make('count')
                                    ->min(1)
                                    ->required(),
                            ),
                    ])
                ]),
            ])
            ->actions(true, [
                Button::make('cancel')
                    ->style(Style::TRANSPARENT)
                    ->afterResponse(AfterResponse::CLOSE),
                Button::make('submit')
                    ->requestType(RequestType::POST)
                    ->requestUrl(route('app.objects.parkings.store', ['id' => $objectId]))
            ]),
        ];
    }
}
