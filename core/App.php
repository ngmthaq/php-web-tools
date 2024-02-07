<?php

namespace Core;

use App\Http\Exceptions\AppException;
use App\Http\Exceptions\ForbiddenException;
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
        } catch (\Throwable $th) {
            if ($th instanceof ForbiddenException) {
                Response::error($th->getCode(), $th->getMessage(), $th->getDetails());
            } elseif ($th instanceof AppException) {
                Response::error($th->getCode(), $th->getMessage());
            } else {
                $message = isProd() ? "The server has encountered a situation it does not know how to handle" : $th->getMessage();
                $details = isProd() ? [] : $th->getTrace();
                Response::error(Response::STT_INTERNAL_SERVER_ERROR, $message, $details);
            }
        }
    }
}
