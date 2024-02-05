<?php

namespace App\Http\Exceptions;

class NotFoundException extends \Exception
{
    public function __construct($message = "", $code = 404)
    {
        parent::__construct($message, $code);
    }
}
