<?php

namespace App\Logging;

use Monolog\Logger;

class CustomLogger
{
    public function __invoke(): Logger
    {
        $logger = new Logger('logging_table');
        $handler = new LogHandler();
        $processor = new LogProcessor();
        $logger->pushHandler($handler);
        $logger->pushProcessor($processor);
        return $logger;
    }
}
