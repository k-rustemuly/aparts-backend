<?php

declare(strict_types=1);

namespace Buildit\Decorations;

use Buildit\Enum\ActionType;
use Buildit\Enum\AfterResponse;
use Buildit\Enum\Color;
use Buildit\Enum\RequestType;
use Buildit\Enum\Style;
use Buildit\Traits\WithKey;

class Button extends Label
{
    use WithKey;

    public ?string $icon = null;

    public ?string $backgroundColor = null;

    public ?string $textColor = null;

    public ?string $actionType = null;

    public ?string $requestType = null;

    public ?string $actionUrl = null;

    public ?string $requestUrl = null;

    public ?string $afterResponse = null;

    public array $fields = [];

    public function __construct(string $key, ?string $label = null, array $fields = [])
    {
        if($label === null) $label = $key;
        $this->style(Style::SUCCESS);
        $this->actionType(ActionType::MODAL);
        $this->fields = $fields;
        $this->afterResponse(AfterResponse::UPDATE);
        $this->requestType();
        $this->key($key);
        parent::__construct($label);
    }

    public function icon(string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @param Buildit\Helpers\Color $color
     */
    public function backgroundColor(Color $color): static
    {
        $this->backgroundColor = $color->value;

        return $this;
    }

    /**
     * @param Buildit\Helpers\Color $color
     */
    public function textColor(Color $color): static
    {
        $this->textColor = $color->value;

        return $this;
    }

    /**
     * @param Buildit\Helpers\Style $style
     */
    public function style(Style $style): static
    {
        $this->backgroundColor = $style->backgroundColor();
        $this->textColor = $style->textColor();

        return $this;
    }

    /**
     * @param Buildit\Helpers\ActionType $type
     */
    public function actionType(ActionType $type): static
    {
        $this->actionType = $type->value;

        return $this;
    }

    /**
     * @param Buildit\Helpers\RequestType $type
     */
    public function requestType(RequestType $type = RequestType::GET): static
    {
        $this->requestType = $type->value;

        return $this;
    }

    public function actionUrl(string $actionUrl): static
    {
        $this->actionUrl = $actionUrl;

        return $this;
    }

    public function requestUrl(string $requestUrl): static
    {
        $this->requestUrl = $requestUrl;

        return $this;
    }

    /**
     * @param Buildit\Helpers\AfterResponse $type
     */
    public function afterResponse(AfterResponse $type): static
    {
        $this->afterResponse = $type->value;

        return $this;
    }
}
