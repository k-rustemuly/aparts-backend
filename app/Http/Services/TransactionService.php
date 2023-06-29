<?php

namespace App\Http\Services;

use App\Http\Resources\BankResource;
use App\Http\Resources\TransactionResource;
use App\Models\Bank;
use App\Models\Transaction;
use App\Models\TransactionStatus;
use Buildit\Decorations\Button;
use Buildit\Decorations\Column;
use Buildit\Decorations\DataList;
use Buildit\Decorations\Field;
use Buildit\Decorations\Grid;
use Buildit\Decorations\Raw;
use Buildit\Decorations\Table;
use Buildit\Fields\Text;
use Buildit\Enum\AfterResponse;
use Buildit\Enum\RequestType;
use Buildit\Enum\Style;
use Buildit\Fields\Double;
use Buildit\Fields\Reference;
use Illuminate\Support\Facades\Auth;

class TransactionService
{

    public function page(): array
    {
        return [
            Grid::make([
                Column::make('', [
                    Table::make('transactions')
                        ->header([
                            Raw::make('id')->sortable()->searchable(),
                            Raw::make('client'),
                            Raw::make('iin'),
                            Raw::make('operation_type'),
                            Raw::make('status'),
                            Raw::make('sum')->searchable(),
                            Raw::make('created_at')->sortable(),
                        ])
                        ->contentUrl(route('app.transactions.list'))
                        ->actions(
                            true,
                            [
                                Button::make('add')
                                    ->requestUrl(route('app.transactions.action.create'))
                            ]
                        )
                        ->actions(
                            Auth::user()->isCashier(),
                            [
                                Button::make('approve')
                                    ->requestUrl(route('app.transactions.action.approve'))
                            ]
                        ),
                ]),
            ])
        ];
    }

    public function list(array $searchAndFilter = [])
    {
        $transactions = Transaction::filter($searchAndFilter)
                            ->orderBy('created_at', 'desc')
                            ->paginateFilter();

        return TransactionResource::collection($transactions)
                ->response()
                ->getData(true);
    }

    public function add(array $data): bool
    {
        $transaction = Transaction::create($data);
        return $transaction->exists;
    }

    public function createAction(): array
    {
        return [
            Grid::make([
                Column::make('', [
                    DataList::make('add_new_transaction', 'Add new transaction', [
                        Field::make('client')
                            ->value(
                                Reference::make('client_id', 'client')
                                    ->contentUrl(route('app.reference.clients'))
                                    ->required()
                            ),
                        Field::make('operation_type')
                            ->value(
                                Reference::make('operation_type_id', 'operation_type')
                                    ->contentUrl(route('app.reference.operation_types'))
                                    ->required()
                            ),
                        Field::make('sum')
                            ->value(
                                Double::make('sum')
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
                    ->requestUrl(route('app.transactions.store'))
            ]),
        ];
    }

    public function approveAction(): array
    {
        return [
            Grid::make([
                Column::make('', [
                    DataList::make('approve_transaction', 'Approve transaction', [
                        Field::make('transactions')
                            ->value(
                                Reference::make('transaction_id', 'transactions')
                                    ->contentUrl(route('app.reference.transactions', ['status_id' => TransactionStatus::NOT_PAID]))
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
                    ->requestUrl(route('app.transactions.approve'))
            ]),
        ];
    }

    public function approve(array $data): bool
    {
        return Transaction::where('id', $data['transaction_id'])->where('status_id', TransactionStatus::NOT_PAID)->update(['status_id' => TransactionStatus::PAID]) > 0;
    }
}
