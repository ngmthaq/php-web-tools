<?php

namespace App\Exceptions;

class FailureValidationException extends AppException
{
    /**
     * @var array $details
     */
    protected array $details;

    /**
     * FailureValidationException (422)
     *
     * @param array $details
     * @param string $message
     * @param int $code
     */
    public function __construct(
        array $details,
        string $message = "The request was well-formed but was unable to be followed due to semantic errors.",
        int $code = 422
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
