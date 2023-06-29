<?php

declare(strict_types=1);

namespace Buildit\Enum;

enum Style
{
    case SUCCESS;
    case INFO;
    case WARNING;
    case ERROR;
    case TRANSPARENT;

    public function backgroundColor(): string
    {
        return match($this)
        {
            Style::SUCCESS => Color::SUCCESS->value,
            Style::TRANSPARENT => Color::TRANSPARENT->value,
            Style::INFO => Color::INFO->value,
        };
    }

    public function textColor(): string
    {
        return match($this)
        {
            Style::SUCCESS => Color::WHITE->value,
            Style::TRANSPARENT => Color::BLACK->value,
            Style::INFO => Color::WHITE->value,
        };
    }
}
