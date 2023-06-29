<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Http\Resources\ObjectResource;
use App\Models\Objects;
use Buildit\Decorations\Block;
use Buildit\Decorations\Button;
use Buildit\Decorations\Column;
use Buildit\Decorations\DataList;
use Buildit\Decorations\Field;
use Buildit\Decorations\Grid;
use Buildit\Decorations\Raw;
use Buildit\Decorations\Table;
use Buildit\Decorations\View;
use Buildit\Enum\AfterResponse;
use Buildit\Fields\Reference;
use Buildit\Fields\Text;
use Buildit\Enum\RequestType;
use Buildit\Enum\Style;
use Buildit\Fields\Textarea;
use Buildit\Views\Text as ViewsText;
use Illuminate\Support\Facades\Auth;

class ObjectService
{

    public function page(): array
    {
        return [
            Grid::make([
                Column::make('', [
                    Table::make('objects')
                        ->header([
                            Raw::make('city'),
                            Raw::make('name_kk')->sortable()->searchable(),
                            Raw::make('name_ru')->sortable()->searchable(),
                            Raw::make('status'),
                            Raw::make('class'),
                        ])
                        ->contentUrl(route('app.objects.list'))
                        ->actions(
                            Auth::user()->isAdmin(),
                            [
                            Button::make('add')
                                ->requestUrl(route('app.objects.action.create')),
                            ]
                        )
                        ->filter([
                            'city_id' => Reference::make('city', 'Select the city')
                                            ->count(-1)
                                            ->contentUrl(route('app.reference.city')),
                            'class_id' => Reference::make('class', 'Select the class')
                                            ->count(-1)
                                            ->contentUrl(route('app.reference.class')),
                            'technology_id' => Reference::make('technology', 'Select the technology of construction')
                                                ->count(-1)
                                                ->contentUrl(route('app.reference.technology')),
                        ]),
                ]),
            ])
        ];
    }

    public function list(array $searchAndFilter = [])
    {
        $objects = Objects::filter($searchAndFilter)->paginateFilter();

        return ObjectResource::collection($objects)
                ->response()
                ->getData(true);
    }

    public function add(array $data): bool
    {
        $object = Objects::create($data);
        return (bool) $object;
    }

    public function createAction(): array
    {
        return [
            Grid::make([
                Column::make('', [
                    DataList::make('add_new_object', 'Add new object', [
                        Field::make('city_id', 'city')
                            ->value(
                                Reference::make('city_id', 'city')
                                    ->contentUrl(route('app.reference.city'))
                                    ->required(),
                            ),
                        Field::make('name_kk')
                            ->value(
                                Text::make('name_kk')
                                    ->hint('Input name_kk')
                                    ->required()
                            ),
                        Field::make('name_ru')
                            ->value(
                                Text::make('name_ru')
                                    ->hint('Input name_ru')
                                    ->required()
                            ),
                        Field::make('description_kk')
                            ->value(
                                Textarea::make('description_kk')
                                    ->hint('Input description_kk')
                            ),
                        Field::make('description_ru')
                            ->value(
                                Textarea::make('description_ru')
                                    ->hint('Input description_ru')
                            ),
                        Field::make('class_id', 'class')
                            ->value(
                                Reference::make('class_id', 'class')
                                    ->contentUrl(route('app.reference.class'))
                                    ->required(),
                            ),
                        Field::make('technology_id', 'technology')
                            ->value(
                                Reference::make('technology_id', 'technology')
                                    ->hint('Select the technology of construction')
                                    ->contentUrl(route('app.reference.technology'))
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
                    ->requestUrl(route('app.objects.store'))
            ]),
        ];
    }

    public function about(Objects $object): array
    {
        return [
            Grid::make([
                Column::make($object->name, [
                    Block::make('', [
                        View::make('name_kk')
                            ->value(ViewsText::make($object->name_kk)),
                        View::make('name_ru')
                            ->value(ViewsText::make($object->name_ru)),
                        View::make('region')
                            ->value(ViewsText::make($object->region->name)),
                        View::make('city')
                            ->value(ViewsText::make($object->city->name)),
                        View::make('status')
                            ->value(ViewsText::make($object->status->name)),
                        View::make('class')
                            ->value(ViewsText::make($object->class->name)),
                        View::make('technology')
                            ->value(ViewsText::make($object->technology->name)),
                        View::make('description_kk')
                            ->value(ViewsText::make($object->description_kk)),
                        View::make('description_ru')
                            ->value(ViewsText::make($object->description_ru)),
                    ])
                ]),
                Column::make('', [
                    Table::make('blocks', 'Blocks and entrances')
                        ->header([
                            Raw::make('name')->sortable()->searchable(),
                            Raw::make('cadastral_number')->sortable()->searchable(),
                            Raw::make('start', 'start_construction')->sortable(),
                            Raw::make('end', 'end_construction')->sortable(),
                            Raw::make('storeys_number')->sortable(),
                            Raw::make('heating', 'heating_type'),
                        ])
                        ->contentUrl(route('app.objects.blocks.list', ['id' => $object->id]))
                        ->actions(Auth::user()->isAdmin(), [Button::make('add')->requestUrl(route('app.objects.blocks.action.create', ['id' => $object->id]))])
                ]),
                Column::make('', [
                    Table::make('parking', 'Parking list')
                        ->header([
                            Raw::make('number')->sortable()->searchable(),
                            Raw::make('status'),
                        ])
                        ->contentUrl(route('app.objects.parkings.list', ['id' => $object->id]))
                        ->actions(Auth::user()->isAdmin(), [Button::make('add')->requestUrl(route('app.objects.parkings.action.create', ['id' => $object->id]))])
                ]),
            ])
        ];
    }
}
