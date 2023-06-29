<?php

namespace App\Http\Services;

use App\Http\Resources\BlockResource;
use App\Models\Block;
use App\Models\Objects;
use Buildit\Decorations\Block as DecorationsBlock;
use Buildit\Decorations\Button;
use Buildit\Decorations\Column;
use Buildit\Decorations\DataList;
use Buildit\Decorations\Field;
use Buildit\Decorations\Grid;
use Buildit\Decorations\Raw;
use Buildit\Decorations\Table;
use Buildit\Decorations\View;
use Buildit\Enum\AfterResponse;
use Buildit\Enum\RequestType;
use Buildit\Enum\Style;
use Buildit\Fields\Date;
use Buildit\Fields\Number;
use Buildit\Fields\Reference;
use Buildit\Fields\Text as FieldsText;
use Buildit\Views\Text;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class BlockService
{

    public function list(int $objectId, array $searchAndFilter = [])
    {
        $blocks = Block::byObject($objectId)->filter($searchAndFilter)->paginateFilter();

        return BlockResource::collection($blocks)
                ->response()
                ->getData(true);
    }

    public function add(int $objectId, array $data): bool
    {
        $data = Arr::add($data, 'object_id', $objectId);
        $block = Block::create($data);
        return (bool) $block;
    }

    public function createAction($objectId): array
    {
        return [
            Grid::make([
                Column::make('', [
                    DataList::make('add_new_block', 'Add new block', [
                        Field::make('name')
                            ->value(
                                FieldsText::make('name')
                                    ->required(),
                            ),
                        Field::make('cadastral_number')
                            ->value(
                                FieldsText::make('cadastral_number')
                            ),
                        Field::make('start_construction')
                            ->value(
                                Date::make('start', 'start_construction')
                            ),
                        Field::make('end_construction')
                            ->value(
                                Date::make('end', 'end_construction')
                            ),
                        Field::make('storeys_number')
                            ->value(
                                Number::make('storeys_number')
                                    ->min(1)
                                    ->required(),
                            ),
                        Field::make('heating_type')
                            ->value(
                                Reference::make('heating_type_id', 'heating_type')
                                    ->required()
                                    ->contentUrl(route('app.reference.heating_type')),
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
                    ->requestUrl(route('app.objects.blocks.store', ['id' => $objectId]))
            ]),
        ];
    }

    public function show(Objects $object, Block $block): array
    {
        if($object->id != $block->object_id) return [];

        return [
            Grid::make([
                Column::make($object->name, [
                    DecorationsBlock::make($block->name, [
                        View::make('name')
                            ->value(Text::make($block->name)),
                        View::make('cadastral_number')
                            ->value(Text::make($block->cadastral_number)),
                        View::make('start', 'start_construction')
                            ->value(Text::make($block->start ? $block->start->format('d-m-Y') : null)),
                        View::make('end', 'end_construction')
                            ->value(Text::make($block->end ? $block->end->format('d-m-Y') : null)),
                        View::make('storeys_number')
                            ->value(Text::make($block->storeys_number)),
                        View::make('heating_type')
                            ->value(Text::make($block->heatingType->name)),
                    ])
                ]),

                Column::make('', [
                    Table::make('flats', 'Flats')
                        ->header([
                            Raw::make('floor')->sortable()->searchable(),
                            Raw::make('number')->sortable()->searchable(),
                            Raw::make('area')->sortable()->searchable(),
                            Raw::make('price', 'Price per square meter')->sortable()->searchable(),
                            Raw::make('room')->sortable()->searchable(),
                            Raw::make('ceiling_height')->sortable()->searchable(),
                            Raw::make('finishing_status'),
                            Raw::make('status'),
                        ])
                        ->contentUrl(route('app.objects.blocks.flats.list', ['id' => $object->id, 'block_id' => $block->id]))
                        ->actions(
                            Auth::user()->isAdmin(),
                            [
                                Button::make('add')
                                    ->requestUrl(route('app.objects.blocks.flats.action.create', ['id' => $object->id, 'block_id' => $block->id])),
                            ]
                        )
                        ->filter([
                            Reference::make('finishing_status')
                                ->count(-1)
                                ->contentUrl(route('app.reference.finishing_status')),
                            Reference::make('statuses', 'flat_statuses')
                                ->count(-1)
                                ->contentUrl(route('app.reference.flat_statuses')),
                        ]),
                ]),

                Column::make('', [
                    Table::make('commercial-premises', 'Commercial premise')
                        ->header([
                            Raw::make('id', '#')->invisible(),
                            Raw::make('floor')->sortable()->searchable(),
                            Raw::make('number')->sortable()->searchable(),
                            Raw::make('area')->sortable()->searchable(),
                            Raw::make('ceiling_height')->sortable()->searchable(),
                            Raw::make('finishing_status'),
                            Raw::make('status'),
                        ])
                        ->contentUrl(route('app.objects.blocks.commercial_premises.list', ['id' => $object->id, 'block_id' => $block->id]))
                        ->actions(
                            Auth::user()->isAdmin(),
                            [
                                Button::make('add')
                                    ->requestUrl(route('app.objects.blocks.commercial_premises.action.create', ['id' => $object->id, 'block_id' => $block->id])),
                            ]
                        )
                        ->filter([
                            Reference::make('finishing_statuses', 'finishing_status')
                                ->count(-1)
                                ->contentUrl(route('app.reference.finishing_status')),
                            Reference::make('statuses', 'commercial_premise_statuses')
                                ->count(-1)
                                ->contentUrl(route('app.reference.commercial_premise_statuses')),
                        ]),
                ])->columnSpan(6),

                Column::make('', [
                    Table::make('storerooms', 'Storeroom list')
                        ->header([
                            Raw::make('number')->sortable()->searchable(),
                            Raw::make('area')->sortable()->searchable(),
                            Raw::make('status'),
                        ])
                        ->contentUrl(route('app.objects.blocks.storerooms.list', ['id' => $object->id, 'block_id' => $block->id]))
                        ->actions(
                            Auth::user()->isAdmin(),
                            [
                                Button::make('add')
                                    ->requestUrl(route('app.objects.blocks.storerooms.action.create', ['id' => $object->id, 'block_id' => $block->id])),
                            ]
                        )
                        ->filter([
                            Reference::make('statuses', 'storeroom_statuses')
                                ->count(-1)
                                ->contentUrl(route('app.reference.storeroom_statuses')),
                        ]),
                ])->columnSpan(6),
            ])
        ];
    }
}
