<?php

namespace App\Http\Services;

use App\Http\Resources\EmployeeResource;
use App\Models\User;
use Buildit\Decorations\Button;
use Buildit\Decorations\Column;
use Buildit\Decorations\DataList;
use Buildit\Decorations\Field;
use Buildit\Decorations\Grid;
use Buildit\Decorations\Raw;
use Buildit\Decorations\Table;
use Buildit\Fields\Email;
use Buildit\Fields\Reference;
use Buildit\Fields\Text;
use Buildit\Enum\AfterResponse;
use Buildit\Enum\RequestType;
use Buildit\Enum\Style;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeService
{

    public function page(): array
    {
        return [
            Grid::make([
                Column::make('', [
                    Table::make('employees')
                        ->header([
                            Raw::make('role', 'position'),
                            Raw::make('name', 'full_name')->sortable()->searchable(),
                            Raw::make('email')->sortable()->searchable()
                        ])
                        ->contentUrl(route('app.employees.list'))
                        ->actions(
                            Auth::user()->isAdmin(),
                            [
                            Button::make('add')
                                ->requestUrl(route('app.employees.action.create'))
                        ])
                        ->filter([
                            Reference::make('roles', 'position')
                                ->count(-1)
                                ->contentUrl(route('app.reference.role')),
                        ]),
                ]),
            ])
        ];
    }

    public function list(array $searchAndFilter = [])
    {
        $employees = User::filter($searchAndFilter)->paginateFilter();

        return EmployeeResource::collection($employees)
                ->response()
                ->getData(true);
    }

    public function add(array $data): bool
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return $user->exists;
    }

    public function createAction(): array
    {
        return [
            Grid::make([
                Column::make('', [
                    DataList::make('add_new_employee','Add new employee', [
                        Field::make('role_id', 'position')
                            ->value(
                                Reference::make('role_id', 'position')
                                    ->contentUrl(route('app.reference.role'))
                                    ->required()
                            ),
                        Field::make('name', 'full_name')
                            ->value(
                                Text::make('name', 'full_name')
                                ->hint('Input full name')
                                ->required()
                            ),
                        Field::make('email')
                            ->value(
                                Email::make('email')->required(),
                            ),
                        Field::make('password')->value(
                            Text::make('password')
                                ->hint('Input password')
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
                    ->requestUrl(route('app.employees.store'))
            ]),
        ];
    }
}
