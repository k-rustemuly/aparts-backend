<?php

namespace App\Http\Services;

use App\Http\Resources\CommercialPremiseAllResource;
use App\Http\Resources\CommercialPremiseResource;
use App\Models\CommercialPremise;
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

class CommercialPremiseService
{

    public function page(): array
    {
        return [
            Grid::make([
                Column::make('', [
                    Table::make('commercial_premises')
                        ->header([
                            Raw::make('object'),
                            Raw::make('block'),
                            Raw::make('floor')->sortable()->searchable(),
                            Raw::make('number')->sortable()->searchable(),
                            Raw::make('area')->sortable()->searchable(),
                            Raw::make('ceiling_height')->sortable()->searchable(),
                            Raw::make('finishing_status'),
                            Raw::make('status'),
                        ])
                        ->contentUrl(route('app.commercial_premises.list'))
                        ->filter([
                            Reference::make('objects')
                                ->count(-1)
                                ->contentUrl(route('app.reference.objects')),
                            Number::make('from_floor'),
                            Number::make('to_floor'),
                            Double::make('from_area'),
                            Double::make('to_area'),
                            Reference::make('finishing_statuses', 'finishing_status')
                                ->count(-1)
                                ->contentUrl(route('app.reference.finishing_status')),
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
        $storeroom = CommercialPremise::getAll($searchAndFilter)->paginateFilter();

        return CommercialPremiseAllResource::collection($storeroom)
                ->response()
                ->getData(true);
    }

    public function list(int $blockId, array $searchAndFilter = [])
    {
        $storeroom = CommercialPremise::byBlock($blockId)->filter($searchAndFilter)->paginateFilter();

        return CommercialPremiseResource::collection($storeroom)
                ->response()
                ->getData(true);
    }

    public function add(int $objectId, int $blockId, array $data): bool
    {
        $data['object_id'] = $objectId;
        $data['block_id'] = $blockId;
        $commercialPremise = CommercialPremise::create($data);
        return (bool) $commercialPremise;
    }

    public function createAction(int $objectId, int $blockId): array
    {
        return [
            Grid::make([
                Column::make('', [
                    DataList::make('add_new_commercial_premise','Add new commercial premise', [
                        Field::make('floor')
                            ->value(
                                Number::make('floor')->required(),
                            ),
                        Field::make('number')
                            ->value(
                                Number::make('number')->required(),
                            ),
                        Field::make('area')
                            ->value(
                                Double::make('area')
                                ->hint('Input area')
                                ->min(1)
                                ->required(),
                            ),
                        Field::make('room')
                            ->value(
                                Number::make('room')
                                    ->min(1)
                                    ->required()
                            ),
                        Field::make('ceiling_height')
                            ->value(
                                Double::make('ceiling_height')
                                    ->hint('Input ceiling height')
                                    ->min(1)
                                    ->required(),
                            ),
                        Field::make('finishing_status')
                            ->value(
                                Reference::make('finishing_status')
                                    ->contentUrl(route('app.reference.finishing_status'))
                                    ->required()
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
                    ->requestUrl(route('app.objects.blocks.commercial_premises.store', ['id' => $objectId, 'block_id' => $blockId]))
            ]),
        ];
    }
}
