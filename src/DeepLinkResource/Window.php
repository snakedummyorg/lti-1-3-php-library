<?php

namespace Packback\Lti1p3\DeepLinkResource;

use Packback\Lti1p3\Helpers\HasDimensions;

class Window
{
    use HasDimensions;

    public function __construct(
        private ?string $target_name = null,
        private ?int $width = null,
        private ?int $height = null,
        private ?string $window_features = null
    ) {
    }

    public static function new(): self
    {
        return new Window();
    }

    public function setTargetName(?string $targetName): self
    {
        $this->target_name = $targetName;

        return $this;
    }

    public function getTargetName(): ?string
    {
        return $this->target_name;
    }

    public function setWindowFeatures(?string $windowFeatures): self
    {
        $this->window_features = $windowFeatures;

        return $this;
    }

    public function getWindowFeatures(): ?string
    {
        return $this->window_features;
    }

    public function toArray(): array
    {
        $window = [];

        if (isset($this->target_name)) {
            $window['targetName'] = $this->target_name;
        }
        if (isset($this->width)) {
            $window['width'] = $this->width;
        }
        if (isset($this->height)) {
            $window['height'] = $this->height;
        }
        if (isset($this->window_features)) {
            $window['windowFeatures'] = $this->window_features;
        }

        return $window;
    }
}
