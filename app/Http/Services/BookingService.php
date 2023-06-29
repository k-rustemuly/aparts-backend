<?php

namespace App\Http\Services;

use App\Models\Flat;
use App\Models\FlatBooking;
use App\Models\OperationType;
use App\Models\TransactionStatus;
use Buildit\Decorations\Button;
use Buildit\Decorations\Column;
use Buildit\Decorations\DataList;
use Buildit\Decorations\Field;
use Buildit\Decorations\Grid;
use Buildit\Enum\AfterResponse;
use Buildit\Enum\RequestType;
use Buildit\Enum\Style;
use Buildit\Enum\VisibilityType;
use Buildit\Fields\Double;
use Buildit\Fields\Reference;
use Buildit\Fields\Text;
use Buildit\Fields\Textarea;
use League\Flysystem\Visibility;

class BookingService
{

    public function flatBooking(int $objectId, int $blockId, Flat $flat, array $data): bool
    {
        $data['object_id'] = $objectId;
        $data['block_id'] = $blockId;
        $data['flat_id'] = $flat->id;
        $data['sum'] = $flat->area * $data['price'];
        $booking = FlatBooking::create($data);
        return $booking->exists;
    }

    public function createAction(int $objectId, int $blockId, Flat $flat): array
    {
        return [
            Grid::make([
                Column::make('', [
                    DataList::make('booking', 'To booking', [
                        Field::make()
                            ->value(
                                Double::make('price', 'Price per square meter')
                                    ->value($flat->price)
                                    ->required()
                            ),
                        Field::make()
                            ->value(
                                Reference::make('client_id', 'client')
                                    ->contentUrl(route('app.reference.clients'))
                                    ->searchable()
                                    ->required()
                            ),
                        Field::make()
                            ->value(
                                Reference::make('transaction_id', 'Pre paid')
                                    ->linked('client_id')
                                    ->contentUrl(route('app.reference.transactions', ['status_id' => TransactionStatus::PAID, 'operation_type_id' => OperationType::PREPAYMENT]))
                                    ->required()
                            ),
                    ])
                ]),

                Column::make('', [
                    DataList::make('', '', [
                        Field::make('mortgage')
                            ->value(
                                Reference::make('bank_id', 'bank')
                                    ->contentUrl(route('app.reference.banks'))
                                    ->required()
                            ),
                    ])
                ])->columnSpan(6),

                Column::make('', [
                    DataList::make('', '', [
                        Field::make('', 'Input mortgage sum')
                            ->value(
                                Double::make('mortgage_sum', 'Mortgage sum'),
                            ),
                    ])
                ])->columnSpan(6),

                Column::make('', [
                    DataList::make('', '', [
                        Field::make()
                            ->value(
                                Double::make('trade_in_sum', 'Trade in sum')
                                    ->hint('Input trade in sum'),
                            ),
                        Field::make()
                            ->value(
                                Double::make('installment_plan_sum', 'Installment plan sum')
                                    ->hint('Input installment plan sum'),
                            ),
                        Field::make()
                            ->value(
                                Double::make('cash_sum', 'Cash sum')
                                    ->hint('Input cash sum'),
                            ),
                        Field::make()->value(
                            Textarea::make('comment')
                        )
                    ])
                ]),
            ])
            ->actions(true, [
                Button::make('cancel')
                    ->style(Style::TRANSPARENT)
                    ->afterResponse(AfterResponse::CLOSE),
                Button::make('submit')
                    ->requestType(RequestType::POST)
                    ->requestUrl(route('app.objects.blocks.flats.bookings.store', ['id' => $objectId, 'block_id' => $blockId, 'flat_id' => $flat->id]))
            ]),
        ];
    }

    public function calcAction(Flat $flat): array
    {
        return [
            Grid::make([
                Column::make('', [
                    DataList::make('flat_booking_calculation', 'Calculation', [
                        Field::make()
                            ->value(
                                Text::make('area')
                                    ->value($flat->area)
                                    ->visibility(VisibilityType::READONLY)
                                    ->required()
                            ),
                        Field::make()
                            ->value(
                                Double::make('price', 'Price per square meter')
                                    ->value($flat->price)
                                    ->required()
                            ),
                        Field::make()
                            ->value(
                                Double::make('pre_paid', 'Pre paid')
                            ),
                    ])
                ]),
                Column::make('', [
                    DataList::make('', '', [
                        Field::make('mortgage')
                            ->value(
                                Reference::make('bank_id', 'bank')
                                    ->contentUrl(route('app.reference.banks'))
                                    ->required()
                            ),
                    ])
                ])->columnSpan(6),

                Column::make('', [
                    DataList::make('', '', [
                        Field::make('', 'Input mortgage sum')
                            ->value(
                                Double::make('mortgage_sum', 'Mortgage sum'),
                            ),
                    ])
                ])->columnSpan(6),

                Column::make('', [
                    DataList::make('', '', [
                        Field::make()
                            ->value(
                                Double::make('trade_in_sum', 'Trade in sum')
                                    ->hint('Input trade in sum'),
                            ),
                        Field::make()
                            ->value(
                                Double::make('installment_plan_sum', 'Installment plan sum')
                                    ->hint('Input installment plan sum'),
                            ),
                        Field::make()
                            ->value(
                                Double::make('cash_sum', 'Cash sum')
                                    ->hint('Input cash sum'),
                            ),
                        Field::make()
                            ->value(
                                Double::make('sum')->visibility(VisibilityType::DISABLED),
                            ),
                    ])
                ]),
            ])
            ->actions(true, [
                Button::make('cancel')
                    ->style(Style::TRANSPARENT)
                    ->afterResponse(AfterResponse::CLOSE),
                Button::make('calc')
            ]),
        ];
    }
}
