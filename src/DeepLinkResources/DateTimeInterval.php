<?php

namespace Packback\Lti1p3\DeepLinkResources;

use DateTime;
use Packback\Lti1p3\Helpers\Helpers;
use Packback\Lti1p3\LtiException;

class DateTimeInterval
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
        return new DateTimeInterval();
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

        $dateTimeInterval = [
            'startDateTime' => $this->start?->format(DateTime::ATOM) ?? null,
            'endDateTime' => $this->end?->format(DateTime::ATOM) ?? null,
        ];

        return Helpers::filterOutNulls($dateTimeInterval);
    }

    /**
     * @throws LtiException
     */
    private function validateStartAndEnd(): void
    {
        if (isset($this->start) && isset($this->end) && $this->start > $this->end) {
            throw new LtiException(self::ERROR_START_GT_END);
        }
    }
}
