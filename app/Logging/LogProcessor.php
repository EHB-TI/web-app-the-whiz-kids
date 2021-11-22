<?php

namespace App\Logging;

class LogProcessor
{
    public function __invoke(array $record): array
    {
        $record['extra'] = [
            'user_email' => auth()->user() ? auth()->user()->email : 'guest',
        ];

        return $record;
    }
}