<?php

namespace App\Http\Exceptions;

/**
 * NotFoundException (404)
 */
class NotFoundException extends \Exception
{
    public function __construct($message = "", $code = 404)
    {
        parent::__construct($message, $code);
    }
}
