<?php

namespace Core;

use JetBrains\PhpStorm\NoReturn;

class Debug
{
    /**
     * Debug with print_r function
     *
     * @return void
     */
    #[NoReturn] public static function printR(): void
    {
        ob_end_clean();
        $args = func_get_args();
        echo "<pre data-php-debug='true'>";
        echo "<code data-php-debug='true'>";
        foreach ($args as $arg) {
            print_r($arg);
            echo PHP_EOL;
        }
        echo "</code>";
        echo "</pre>";
        die();
    }

    /**
     * Debug with console.log function
     *
     * @return void
     */
    #[NoReturn] public static function consoleLog(): void
    {
        ob_end_clean();
        $args = func_get_args();
        foreach ($args as $arg) {
            $js_code = 'console.log(' . json_encode($arg, JSON_HEX_TAG) . ');';
            $js_code = '<script data-php-debug=\'true\'>' . $js_code . '</script>';
            echo $js_code;
        }
        die();
    }

    /**
     * Write info logs into file
     *
     * @param string $message
     * @return void
     */
    public static function info(string $message): void
    {
        $date = gmdate("Y-m-d", time());
        $time = gmdate("H:i:s", time());
        $ip = Server::getClientIp();
        $log_file = Dir::cache() . "/logs/system-$date.log";
        $info_message = "[$date $time UTC - $ip] INFO: $message \n";
        error_log($info_message, 3, $log_file);
    }

    /**
     * Write error logs into file
     *
     * @param string $message
     * @return void
     */
    public static function error(string $message): void
    {
        $date = gmdate("Y-m-d", time());
        $time = gmdate("H:i:s", time());
        $ip = Server::getClientIp();
        $log_file = Dir::cache() . "/logs/system-$date.log";
        $info_message = "[$date $time UTC - $ip] ERROR: $message \n";
        error_log($info_message, 3, $log_file);
    }
}
