<?php

namespace Core;

use Dotenv\Dotenv;
use i18n as I18n;

class App
{
    /**
     * Init ENV with Dotenv
     */
    public function initialEnv(): void
    {
        $dotenv = Dotenv::createImmutable(Dir::root());
        $dotenv->safeLoad();
    }

    /**
     * Init I18n
     */
    public function initI18n(): void
    {
        $i18n = new I18n();
        $i18n->setCachePath(Dir::cache() . "/langs");
        $i18n->setFilePath(Dir::resources() . "/langs/{LANGUAGE}.json");
        $i18n->setFallbackLang('en');
        $i18n->init();
    }

    /**
     * Preload
     */
    public function preload(): void
    {
        session_start();
        ob_start();
        $this->initialEnv();
        $this->initI18n();
    }

    /**
     * Run application
     */
    public function run(): void
    {
        try {
            $route = Request::getCurrentRoute();
            call_user_func($route->resolvePath());
            exit;
        } catch (\Throwable $th) {
            Debug::printR($th);
        }
    }
}
