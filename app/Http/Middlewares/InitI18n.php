<?php

namespace App\Http\Middlewares;

use Core\Dir;
use Core\Middleware;
use Exception;
use i18n as I18n;

class InitI18n extends Middleware
{
    public const GLOBAL_KEY = "_i18n";

    /**
     * Handle load i18n
     *
     * @return void
     * @throws Exception
     */
    public function handle(): void
    {
        $i18n = new I18n();
        $i18n->setCachePath(Dir::cache() . "/langs");
        $i18n->setFilePath(Dir::resources() . "/langs/{LANGUAGE}.json");
        $i18n->setFallbackLang('en');
        $i18n->init();
        $GLOBALS[self::GLOBAL_KEY] = $i18n;
    }
}
