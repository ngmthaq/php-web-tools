<?php

namespace App\Exceptions;

class ForbiddenException extends AppException
{
    /**
     * @var array $details
     */
    protected array $details;

    /**
     * ForbiddenException (403)
     *
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
     * Get error details
     *
     * @return array
     */
    public function getDetails(): array
    {
        return $this->details;
    }
}
