<?php

namespace App\Exceptions;

/**
 * ForbiddenException (401)
 */
class ForbiddenException extends AppException
{
    /**
     * @var array $details
     */
    protected array $details;

    /**
     * @param array $details
     * @param string $message
     * @param int $code
     */
    public function __construct(
        array $details,
        string $message = "The client does not have access rights to the content",
        int $code = 403
    ) {
        parent::__construct($message, $code);
        $this->details = $details;
    }

    /**
     * @return array
     */
    public function getDetails(): array
    {
        return $this->details;
    }
}
