<?php

namespace App\Baseapp;

use Exception;

class AppException extends Exception
{
    public function __construct(
        string $message,
        public readonly string $errorCode = '',
        public readonly ?string $field = null,
        int $code = 0,
        ?Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}