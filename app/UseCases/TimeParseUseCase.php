<?php

namespace App\UseCases;
use Illuminate\Support\Carbon;

class TimeParseUseCase
{
    public function execute($time): string
    {
        $carbonTime = Carbon::parse($time)->subHours(7);
        return $carbonTime->format('Y-m-d\TH:i:s') . '-03:00';
    }
}
