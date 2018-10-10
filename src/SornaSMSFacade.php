<?php

namespace mastani\SornaSMS;

use Illuminate\Support\Facades\Facade;

class SornaSMSFacade extends Facade {
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
        return 'sorna-sms';
    }
}