<?php

namespace App\Logging;

use Monolog\Formatter\NormalizerFormatter;

class LogFormatter extends NormalizerFormatter
{
    public function __construct()
    {
        parent::__construct();
    }

    public function format(array $record)
    {
        $record = parent::format($record);
        return $this->convertToDataBase($record);
    }

    protected function convertToDataBase(array $record)
    {
        $el = $record['extra'];
        $el['message'] = $record['message'];

        return $el;
    }
}