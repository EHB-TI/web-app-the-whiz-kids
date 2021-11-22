<?php

namespace App\Logging;

use Monolog\Formatter\FormatterInterface;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use App\Models\Log;

class LogHandler extends AbstractProcessingHandler
{
    public function __construct($level = Logger::DEBUG, bool $bubble = true)
    {
        parent::__construct($level, $bubble);
    }

    /**
     * @inheritDoc
     */
    protected function write(array $record): void
    {
        $log = new Log();
        $log->fill($record['formatted']);
        $log->save();
    }

    protected function getDefaultFormatter(): FormatterInterface
    {
        return new LogFormatter();
    }

    public function report(Throwable $exception)
    {
        if ($this->shouldntReport($exception)) {
            return;
        }
        \Log::channel('single')->error(
            $exception->getMessage(),
            array_merge($this->context(), ['exception' => $exception])
        );
    }
}