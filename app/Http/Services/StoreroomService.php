<?php

namespace App\Http\Services;

use App\Http\Resources\StoreroomAllResource;
use App\Http\Resources\StoreroomResource;
use App\Models\Storeroom;
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
use Buildit\Fields\Double;
use Buildit\Fields\Number;
use Buildit\Fields\Reference;

class StoreroomService
{
    public function page(): array
    {
        return [
            Grid::make([
                Column::make('', [
                    Table::make('storerooms')
                        ->header([
                            Raw::make('object'),
                            Raw::make('block'),
                            Raw::make('number')->sortable()->searchable(),
                            Raw::make('area')->sortable()->searchable(),
                            Raw::make('status'),
                        ])
                        ->contentUrl(route('app.storerooms.list'))
                        ->filter([
                            Reference::make('objects')
                                ->count(-1)
                                ->contentUrl(route('app.reference.objects')),
                            Double::make('from_area'),
                            Double::make('to_area'),
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
        $storeroom = Storeroom::getAll($searchAndFilter)->paginateFilter();

        return StoreroomAllResource::collection($storeroom)
                ->response()
                ->getData(true);
    }

    public function list(int $blockId, array $searchAndFilter = [])
    {
        $storeroom = Storeroom::byBlock($blockId)->filter($searchAndFilter)->paginateFilter();

        return StoreroomResource::collection($storeroom)
                ->response()
                ->getData(true);
    }

    public function add(int $objectId, int $blockId, array $data): bool
    {
        return Storeroom::generateAndSave($objectId, $blockId, (int) $data["count"], (float) $data["area"]) > 0;
    }

    public function createAction(int $objectId, int $blockId): array
    {
        return [
            Grid::make([
                Column::make('', [
                    DataList::make('add_new_storeroom', 'Add new storeroom', [
                        Field::make('count')
                            ->value(
                                Number::make('count')
                                    ->min(1)
                                    ->required(),
                            ),
                        Field::make('area')
                            ->value(
                                Double::make('area')
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
                    ->requestUrl(route('app.objects.blocks.storerooms.store', ['id' => $objectId, 'block_id' => $blockId]))
            ]),
        ];
    }
}
