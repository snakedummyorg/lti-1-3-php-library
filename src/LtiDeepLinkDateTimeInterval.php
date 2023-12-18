<?php

namespace Packback\Lti1p3;

use DateTime;

class LtiDeepLinkDateTimeInterval
{
    public const ERROR_NO_START_OR_END = 'Either a start or end time must be specified.';
    public const ERROR_START_GT_END = 'The start time cannot be greater than end time.';

    public function __construct(
        private ?DateTime $start = null,
        private ?DateTime $end = null
    ) {
        $this->validateStartAndEnd();
    }

    public static function new(): self
    {
        return new LtiDeepLinkDateTimeInterval();
    }

    public function setStart(?DateTime $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getStart(): ?DateTime
    {
        return $this->start;
    }

    public function setEnd(?DateTime $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getEnd(): ?DateTime
    {
        return $this->end;
    }

    public function toArray(): array
    {
        if (!isset($this->start) && !isset($this->end)) {
            throw new LtiException(self::ERROR_NO_START_OR_END);
        }

        $this->validateStartAndEnd();

        $dateTimeInterval = [];

        if (isset($this->start)) {
            $dateTimeInterval['startDateTime'] = $this->start->format(DateTime::ATOM);
        }
        if (isset($this->end)) {
            $dateTimeInterval['endDateTime'] = $this->end->format(DateTime::ATOM);
        }

        return $dateTimeInterval;
    }

    private function validateStartAndEnd(): void
    {
        if (isset($this->start) && isset($this->end) && $this->start > $this->end) {
            throw new LtiException(self::ERROR_START_GT_END);
        }
    }
}
