<?php

namespace TestMonitor\Custify\Exceptions;

class FailedActionException extends Exception
{
    /**
     * Create a new exception instance.
     *
     * @param string $message
     */
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
