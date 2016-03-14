<?php

if (!function_exists('dd'))
{
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function dd($x, $die = true)
    {
        array_map(function($x) { dump($x); }, func_get_args());
        if ($die) {
            die;
        }
    }
}

if (!function_exists('google_suggest')) {
    /**
     * @param  string  $string
     * @return mixed
     */
    function google_suggest($string)
    {
        return app('google_suggest')->search($string);
    }
}