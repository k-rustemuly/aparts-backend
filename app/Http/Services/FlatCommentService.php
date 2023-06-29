<?php

namespace App\Http\Services;

use App\Http\Resources\FlatCommentResource;
use App\Models\FlatComment;
use Buildit\Decorations\Button;
use Buildit\Decorations\Column;
use Buildit\Decorations\DataList;
use Buildit\Decorations\Field;
use Buildit\Decorations\Grid;
use Buildit\Enum\AfterResponse;
use Buildit\Enum\RequestType;
use Buildit\Enum\Style;
use Buildit\Fields\Textarea;

class FlatCommentService
{

    public function store(int $objectId, int $blockId, int $flatId, array $data): bool
    {
        $data['object_id'] = $objectId;
        $data['block_id'] = $blockId;
        $data['flat_id'] = $flatId;
        $booking = FlatComment::create($data);
        return $booking->exists;
    }

    public function list(int $flatId, array $searchAndFilter = []): array
    {
        $banks = FlatComment::list($flatId, $searchAndFilter)->paginateFilter();

        return FlatCommentResource::collection($banks)
                ->response()
                ->getData(true);
    }

    public function createAction(int $objectId, int $blockId, int $flatId): array
    {
        return [
            Grid::make([
                Column::make('', [
                    DataList::make('comment', 'To comment', [
                        Field::make('comment')
                            ->value(
                                Textarea::make('comment')
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
                    ->requestUrl(route('app.objects.blocks.flats.comments.store', ['id' => $objectId, 'block_id' => $blockId, 'flat_id' => $flatId]))
            ]),
        ];
    }
}
