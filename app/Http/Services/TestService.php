<?php

namespace App\Http\Services;

use App\Http\Resources\BankResource;
use App\Models\Bank;
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
use Buildit\Enum\RequestType;
use Buildit\Enum\Style;
use Buildit\Fields\Email;
use Buildit\Fields\Reference;
use Buildit\Fields\Text;
use Buildit\Views\Text as ViewsText;

class TestService
{

    public function page(): array
    {
        return [
            Grid::make([
                Column::make('Column title', [
                    Block::make('Field block title', [
                        Field::make('name', 'name_kk')
                            ->value(
                                Text::make('name_kk', 'Input bank name_kk')->required()
                            )
                    ])
                ]),
            ])
            ->actions(true, [
            ]),
            Grid::make([
                Column::make('Column title', [
                    Block::make('Block title', [
                        View::make('name', 'key')
                            ->value(ViewsText::make('value')),
                    ])
                ]),
                Column::make('Column title', [
                    Table::make('table', 'Table title')
                        ->header([
                            Raw::make('name_kk')->sortable()->searchable(),
                            Raw::make('name_ru')->sortable()->searchable(),
                        ])
                        ->contentUrl(route('app.tests.list'))
                        ->actions(
                            true,
                            [
                            Button::make('create')
                                ->requestUrl(route('app.tests.actions.create'))
                            ]
                        ),
                ]),
            ])
        ];
    }

    public function createAction(): array
    {
        return [
            Grid::make([
                Column::make('Column title', [
                    DataList::make('adat','Data list title', [
                        Field::make('name', 'name_kk')
                            ->value(Text::make('name_kk')->required()),
                        Field::make('role_id', 'position')
                            ->value(
                                Reference::make('role_id', 'position')
                                    ->contentUrl(route('app.reference.role'))
                                    ->required()
                            ),
                        Field::make('name1', 'name_kk')
                            ->value(
                                Text::make('name1', 'full_name')
                                    ->hint('Input full name')
                                    ->required(),
                            ),
                        Field::make('email')->value(
                            Email::make('email')->required(),
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
                    ->requestUrl(route('app.tests.store'))
            ]),
        ];
    }

    public function test(): array
    {
        return [
            Grid::make([
                Column::make('Column title', [
                    Block::make('Field block title', [
                        Field::make('name_kk')
                            ->value(
                                Text::make('name_kk', 'Input bank name_kk')
                                    ->required()
                            ),
                        Field::make('name_kk')
                            ->value(
                                Text::make('name_kk', 'Input bank name_kk')
                                    ->required()
                            )
                    ])
                ]),
            ])
            ->actions(true, [
                Button::make('Cancel')
                    ->afterResponse(AfterResponse::CLOSE)
            ]),
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
}
