<?php

namespace App\Traits;

use Carbon\CarbonInterface;
use DateTimeInterface;

trait FormatsDates
{
    /**
     * Sobrescreve a serialização de datas para o front-end.
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d');
    }
}
