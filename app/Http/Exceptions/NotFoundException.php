<?php

namespace App\Http\Exceptions;

/**
 * NotFoundException (404)
 */
class NotFoundException extends AppException
{
    public function __construct($message = "The server cannot find the requested resource", $code = 404)
    {
        parent::__construct($message, $code);
    }
}
