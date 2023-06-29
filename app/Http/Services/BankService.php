<?php

namespace App\Http\Services;

use App\Http\Resources\BankResource;
use App\Models\Bank;
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

class BankService
{

    public function page(): array
    {
        return [
            Grid::make([
                Column::make('', [
                    Table::make('banks')
                        ->header([
                            Raw::make('name_kk')->sortable()->searchable(),
                            Raw::make('name_ru')->sortable()->searchable()
                        ])
                        ->contentUrl(route('app.banks.list'))
                        ->actions(
                            true,
                            [
                                Button::make('add')
                                    ->requestUrl(route('app.banks.action.create'))
                            ]
                        ),
                ]),
            ])
        ];
    }

    public function list(array $searchAndFilter = [])
    {
        $banks = Bank::filter($searchAndFilter)->paginateFilter();

        return BankResource::collection($banks)
                ->response()
                ->getData(true);
    }

    public function add(array $data): bool
    {
        $bank = Bank::create($data);
        return $bank->exists;
    }

    public function createAction(): array
    {
        return [
            Grid::make([
                Column::make('', [
                    DataList::make('add_new_bank', 'Add new bank', [
                        Field::make('name_kk')
                            ->value(
                                Text::make('name_kk')
                                    ->required(),
                            ),
                        Field::make('name_ru')
                            ->value(
                                Text::make('name_ru')
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
                    ->requestUrl(route('app.banks.store'))
            ]),
        ];
    }

}
