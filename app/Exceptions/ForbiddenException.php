<?php

namespace App\Exceptions;

/**
 * ForbiddenException (401)
 */
class ForbiddenException extends AppException
{
    protected array $details;

    public function __construct(
        array $details,
        string $message = "The client does not have access rights to the content",
        int $code = 403
    ) {
        parent::__construct($message, $code);
        $this->details = $details;
    }

    public function getDetails()
    {
        return $this->details;
    }
}
