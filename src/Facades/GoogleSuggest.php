<?php

namespace euclid1990\PhpGoogleSuggest\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @package \euclid1990\PhpGoogleSuggest
 */
class GoogleSuggest extends Facade {

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
    	return 'google_suggest';
    }
}