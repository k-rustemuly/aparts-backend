<?php

declare(strict_types=1);

namespace Buildit\Traits;

trait WithContentUrl
{
    public ?string $contentUrl = null;

    public function contentUrl(string $contentUrl): static
    {
        $this->contentUrl = $contentUrl;

        return $this;
    }
}
