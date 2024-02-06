<?php

namespace Core;

use i18n as I18nGenerator;

class I18n
{
    public I18nGenerator $i18n;

    public function __construct()
    {
        $this->i18n = new I18nGenerator();
    }

    /**
     * Init I18n
     */
    public function init()
    {
        $this->i18n->setCachePath(Dir::cache() . "/langs");
        $this->i18n->setFilePath(Dir::resources() . "/langs/{LANGUAGE}.json");
        $this->i18n->setFallbackLang('en');
        $this->i18n->init();
    }
}
