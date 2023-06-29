<?php

declare(strict_types=1);

namespace Buildit\Decorations;

use Buildit\Views\View as ViewsView;

class View extends ViewElement
{
    public array $value = [];

    public function value(ViewsView $view): static
    {
        $this->value = get_object_vars($view);

        return $this;
    }
}
