<?php

namespace App\Http\Services;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use Buildit\Decorations\Button;
use Buildit\Decorations\Column;
use Buildit\Decorations\DataList;
use Buildit\Decorations\Field;
use Buildit\Decorations\Grid;
use Buildit\Decorations\Raw;
use Buildit\Decorations\Table;
use Buildit\Fields\Text;
use Buildit\Enum\AfterResponse;
use Buildit\Enum\Mask;
use Buildit\Enum\RequestType;
use Buildit\Enum\Style;
use Buildit\Fields\Number;
use Buildit\Helpers\PhoneNumber;

class ClientService
{

    public function page(): array
    {
        return [
            Grid::make([
                Column::make('', [
                    Table::make('clients')
                        ->header([
                            Raw::make('iin')->sortable()->searchable(),
                            Raw::make('phone_number')->sortable()->searchable(),
                            Raw::make('surname')->sortable()->searchable(),
                            Raw::make('name', 'Client name')->sortable()->searchable(),
                            Raw::make('patronymic')->sortable()->searchable()
                        ])
                        ->contentUrl(route('app.clients.list'))
                        ->actions(
                            true,
                            [
                                Button::make('add')
                                    ->requestUrl(route('app.clients.action.create')),
                            ]
                        ),
                ]),
            ])
        ];
    }

    public function list(array $searchAndFilter = [])
    {
        $clients = Client::filter($searchAndFilter)->paginateFilter();

        return ClientResource::collection($clients)
                ->response()
                ->getData(true);
    }

    public function add(array $data): bool
    {
        $data['phone_number'] = PhoneNumber::format($data['phone_number']);
        $client = Client::create($data);
        return $client->exists;
    }

    public function createAction(): array
    {
        return [
            Grid::make([
                Column::make('', [
                    DataList::make('add_new_client', 'Add new client', [
                        Field::make('iin')
                            ->value(
                                Number::make('iin')
                                    ->exactLength(12)
                                    ->required(),
                            ),
                        Field::make('phone_number')
                            ->value(
                                Number::make('phone_number')
                                    ->hint('Input phone number')
                                    ->mask(Mask::PHONE_NUMBER)
                                    ->required(),
                            ),
                        Field::make('surname')
                            ->value(
                                Text::make('surname')
                                    ->required(),
                            ),
                        Field::make('name', 'Client name')
                            ->value(
                                Text::make('name', 'Client name')
                                    ->required(),
                            ),
                        Field::make('patronymic')
                            ->value(
                                Text::make('patronymic')
                                    ->hint('Input patronymic'),
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
                    ->requestUrl(route('app.clients.store'))
            ]),
        ];
    }
}
