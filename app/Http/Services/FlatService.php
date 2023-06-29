<?php

namespace App\Http\Services;

use App\Http\Resources\FlatAllResource;
use App\Http\Resources\FlatResource;
use App\Models\Block as ModelsBlock;
use App\Models\Flat;
use App\Models\FlatBooking;
use App\Models\FlatStatus;
use App\Models\Objects;
use Buildit\Decorations\Block;
use Buildit\Decorations\Button;
use Buildit\Decorations\Column;
use Buildit\Decorations\Comment;
use Buildit\Decorations\DataList;
use Buildit\Decorations\Field;
use Buildit\Decorations\Grid;
use Buildit\Decorations\Raw;
use Buildit\Decorations\Table;
use Buildit\Decorations\View;
use Buildit\Enum\AfterResponse;
use Buildit\Enum\RequestType;
use Buildit\Enum\Style;
use Buildit\Fields\Double;
use Buildit\Fields\Number;
use Buildit\Fields\Reference;
use Buildit\Views\Text;
use Illuminate\Support\Facades\Auth;

class FlatService
{

    public function page(): array
    {
        return [
            Grid::make([
                Column::make('', [
                    Table::make('flats', 'Flats')
                        ->header([
                            Raw::make('object'),
                            Raw::make('block'),
                            Raw::make('floor')->sortable()->searchable(),
                            Raw::make('number')->sortable()->searchable(),
                            Raw::make('area')->sortable()->searchable(),
                            Raw::make('price', 'Price per square meter')->sortable()->searchable(),
                            Raw::make('room')->sortable()->searchable(),
                            Raw::make('ceiling_height')->sortable()->searchable(),
                            Raw::make('finishing_status'),
                            Raw::make('status'),
                        ])
                        ->contentUrl(route('app.flats.list'))
                        ->filter([
                            Reference::make('objects')
                                ->count(-1)
                                ->contentUrl(route('app.reference.objects')),
                            Number::make('from_floor'),
                            Number::make('to_floor'),
                            Number::make('from_room'),
                            Number::make('to_room'),
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
        $storeroom = Flat::getAll($searchAndFilter)->paginateFilter();

        return FlatAllResource::collection($storeroom)
                ->response()
                ->getData(true);
    }

    public function list(int $blockId, array $searchAndFilter = [])
    {
        $storeroom = Flat::byBlock($blockId)->filter($searchAndFilter)->paginateFilter();

        return FlatResource::collection($storeroom)
                ->response()
                ->getData(true);
    }

    public function add(int $objectId, int $blockId, array $data): bool
    {
        $data['object_id'] = $objectId;
        $data['block_id'] = $blockId;
        $flat = Flat::create($data);
        return (bool) $flat;
    }

    public function createAction(int $objectId, int $blockId): array
    {
        return [
            Grid::make([
                Column::make('', [
                    DataList::make('add_new_flat','Add new flat', [
                        Field::make()
                            ->value(
                                Number::make('floor')->required(),
                            ),
                        Field::make()
                            ->value(
                                Number::make('number')->required(),
                            ),
                        Field::make()
                            ->value(
                                Double::make('area')
                                    ->min(1)
                                    ->required(),
                            ),
                        Field::make()
                            ->value(
                                Double::make('price', 'Price per square meter')
                                    ->min(1)
                                    ->required(),
                            ),
                        Field::make()
                            ->value(
                                Number::make('room')
                                    ->min(1)
                                    ->required()
                            ),
                        Field::make()
                            ->value(
                                Double::make('ceiling_height')
                                    ->min(1)
                                    ->required(),
                            ),
                        Field::make()
                            ->value(
                                Reference::make('finishing_status_id', 'finishing_status')
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
                    ->requestUrl(route('app.objects.blocks.flats.store', ['id' => $objectId, 'block_id' => $blockId]))
            ]),
        ];
    }

    public function show(Objects $object, ModelsBlock $block, Flat $flat): array
    {
        return [
            Grid::make([
                Column::make($block->name, [
                    Block::make($flat->number, [
                        View::make('floor')
                            ->value(Text::make($flat->floor)),
                        View::make('number')
                            ->value(Text::make($flat->number)),
                        View::make('area')
                            ->value(Text::make($flat->area)),
                        View::make('price', 'Price per square meter')
                            ->value(Text::make(number_format($flat->price, 2, '.', ' '))),
                        View::make('ceiling_height')
                            ->value(Text::make($flat->ceiling_height)),
                        View::make('room')
                            ->value(Text::make($flat->room)),
                        View::make('finishing_status')
                            ->value(Text::make($flat->finishingStatus->name)),
                        View::make('status', 'flat_statuses')
                            ->value(Text::make($flat->status->name)),
                    ])
                    ->actions(
                        (Auth::user()->isAdmin() || Auth::user()->isManager()) && $flat->status_id == FlatStatus::ON_SALE,
                        [
                            Button::make('To booking')
                                ->requestUrl(route('app.objects.blocks.flats.bookings.action.create', ['id' => $object->id, 'block_id' => $block->id, 'flat_id' => $flat->id])),
                            Button::make('calc')
                                ->style(Style::INFO)
                                ->requestUrl(route('app.objects.blocks.flats.bookings.action.calc', ['id' => $object->id, 'block_id' => $block->id, 'flat_id' => $flat->id]))
                    ])
                ]),
                Column::make('', [
                    Comment::make('comments')
                        ->contentUrl(route('app.objects.blocks.flats.comments.list', ['id' => $object->id, 'block_id' => $block->id, 'flat_id' => $flat->id]))
                        ->actions(
                            true,
                            [
                                Button::make('add')
                                    ->requestUrl(route('app.objects.blocks.flats.comments.action.create', ['id' => $object->id, 'block_id' => $block->id, 'flat_id' => $flat->id]))
                            ]
                        ),
                ])
            ])
            ->when($flat->status->id == FlatStatus::RESERVED, function ($grid) use ($flat) {
                $booking = FlatBooking::getByFlatId($flat->id);
                $grid->addItem(
                    Column::make('', [
                        Block::make('Booking', [
                            View::make('client_name', 'Client fullname')
                                ->value(Text::make(
                                    trans('client_fullname', [
                                        'surname' => $booking->client->surname,
                                        'name' => $booking->client->name,
                                        'patronymic' => $booking->client->patronymic
                                    ])
                                )),
                            View::make('pre_paid', 'Pre paid')
                                ->value(Text::make(
                                    $booking->transaction ? number_format($booking->transaction->sum, 2, '.', ' ') : null
                                )),
                            View::make('bank')
                                ->value(Text::make(
                                    $booking->bank ? $booking->bank->name: null
                                )),
                            View::make('mortgage_sum', 'Mortgage sum')
                                ->value(Text::make(
                                    $booking->mortgage_sum > 0 ? number_format($booking->mortgage_sum, 2, '.', ' ') : null
                                )),
                            View::make('trade_in_sum', 'Trade in sum')
                                ->value(Text::make(
                                    $booking->trade_in_sum > 0 ? number_format($booking->trade_in_sum, 2, '.', ' ') : null
                                )),
                            View::make('installment_plan_sum', 'Installment plan sum')
                                ->value(Text::make(
                                    $booking->installment_plan_sum > 0 ? number_format($booking->installment_plan_sum, 2, '.', ' ') : null
                                )),
                            View::make('cash_sum', 'Cash sum')
                                ->value(Text::make(
                                    $booking->cash_sum > 0 ? number_format($booking->cash_sum, 2, '.', ' ') : null
                                )),
                            View::make('area')
                                ->value(Text::make($flat->area)),
                            View::make('price', 'Price per square meter')
                                ->value(Text::make(
                                    $booking->price > 0 ? number_format($booking->price, 2, '.', ' ') : null
                                )),
                            View::make('sum', 'Total price')
                                ->value(Text::make(
                                    $booking->sum > 0 ? number_format($booking->sum, 2, '.', ' ') : null
                                )),
                            View::make('comment')
                                ->value(Text::make($booking->comment)),
                            View::make('author')
                                ->value(Text::make($booking->employee->name)),
                            View::make('created_at', 'Booking date time')
                                ->value(Text::make($booking->created_at->translatedFormat('d F Y, H:i'))),
                        ])
                    ]),
                    2
                );
            })
        ];
    }

    public function about(Flat $flat): array
    {
        $object = Objects::find($flat->object_id);
        $block = ModelsBlock::find($flat->block_id);
        return $this->show($object, $block, $flat);
    }
}
