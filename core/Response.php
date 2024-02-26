<?php

namespace Core;

use App\Exceptions\NotFoundException;
use eftec\bladeone\BladeOne;
use Exception;
use JetBrains\PhpStorm\NoReturn;

class Response
{
    public const STT_OK = 200;
    public const STT_CREATED = 201;
    public const STT_NO_CONTENT = 204;
    public const STT_BAD_REQUEST = 400;
    public const STT_UNAUTHORIZED = 401;
    public const STT_FORBIDDEN = 403;
    public const STT_NOT_FOUND = 404;
    public const STT_UNPROCESSABLE_CONTENT = 422;
    public const STT_TOO_MANY_REQUESTS = 429;
    public const STT_INTERNAL_SERVER_ERROR = 500;
    public const STT_SERVICE_UNAVAILABLE = 503;

    /**
     * Response with json (application/json)
     *
     * @param array $data
     * @return void
     */
    #[NoReturn] public static function json(array $data = []): void
    {
        ob_end_clean();
        http_response_code(self::STT_OK);
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode($data);
        exit();
    }

    /**
     * Response with file
     *
     * @param string $attachment_location
     * @return void
     * @throws NotFoundException
     */
    public static function file(string $attachment_location): void
    {
        if (file_exists($attachment_location)) {
            http_response_code(self::STT_OK);
            header("Cache-Control: public");
            header("Content-Type: " . mime_content_type($attachment_location));
            header("Content-Transfer-Encoding: Binary");
            header("Content-Length: " . filesize($attachment_location));
            header("Content-Disposition: attachment; filename=" . basename($attachment_location));
            readfile($attachment_location);
            exit();
        } else {
            throw new NotFoundException("The server cannot find any corresponding files stored on the system");
        }
    }

    /**
     * Response with error (text/html or application/json)
     *
     * @param int $status
     * @param string $message
     * @param array $details
     * @param array $trace
     * @return void
     * @throws Exception
     */
    #[NoReturn] public static function error(int $status, string $message, array $details = [], array $trace = []): void
    {
        if (self::isNeedJson()) self::jsonError($status, $message, $details, $trace);
        else self::view("errors.common", compact("status", "message", "details", "trace"), $status);
    }

    /**
     * Check json needed
     *
     * @return bool
     */
    public static function isNeedJson(): bool
    {
        return $_SERVER["HTTP_ACCEPT"] === "application/json";
    }

    /**
     * Response with error json (application/json)
     *
     * @param int $status
     * @param string $message
     * @param array $details
     * @param array $trace
     * @return void
     */
    #[NoReturn] public static function jsonError(int $status, string $message, array $details = [], array $trace = []): void
    {
        ob_end_clean();
        http_response_code($status);
        header("Content-Type: application/json; charset=utf-8");
        echo json_encode(compact("message", "details", "trace"));
        exit();
    }

    /**
     * Response with view (text/html)
     *
     * @param string $name
     * @param array $data
     * @param int $status
     * @return void
     * @throws Exception
     */
    #[NoReturn] public static function view(string $name, array $data = [], int $status = self::STT_OK): void
    {
        $views = Dir::resources() . "/views";
        $cache = Dir::cache() . "/views";
        $blade = new BladeOne($views, $cache, isProd() ? BladeOne::MODE_AUTO : BladeOne::MODE_DEBUG);
        $blade->pipeEnable = true;
        ob_end_clean();
        http_response_code($status);
        echo sanitizeOutput($blade->run($name, $data));
        exit();
    }

    /**
     * Response with validation error (text/html or application/json)
     *
     * @param string $message
     * @param array $details
     * @param array $trace
     * @return void
     */
    #[NoReturn] public static function validationError(string $message, array $details = [], array $trace = []): void
    {
        $status = self::STT_UNPROCESSABLE_CONTENT;
        if (self::isNeedJson()) {
            self::jsonError($status, $message, $details, $trace);
        } else {
            foreach ($details as $error_key => $error_message) flashMessage($error_key . "_error", $error_message);
            foreach (Request::input() as $name => $value) flashMessage($name, $value);
            self::reload();
        }
    }

    /**
     * Refresh page
     *
     * @return void
     */
    #[NoReturn] public static function reload(): void
    {
        header("Refresh: 0", true, 302);
        exit();
    }

    /**
     * Redirect
     *
     * @param string $path
     * @return void
     */
    #[NoReturn] public static function redirect(string $path): void
    {
        header("Location: $path", true, 302);
        exit();
    }
}
