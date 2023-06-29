<?php

declare(strict_types=1);

namespace Buildit\Enum;

enum ActionType: string
{
    case MODAL = 'modal';
    case NEW_PAGE = 'new_page';
    case NEW_TAB = 'new_tab';
    case RIGHT_SIDE = 'right_side';
}
