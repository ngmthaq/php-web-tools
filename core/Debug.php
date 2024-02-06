<?php

namespace Core;

class Debug
{
    /**
     * Print to screen
     */
    public static function printR()
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
     * Show in console.log
     */
    public static function consoleLog()
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
}
