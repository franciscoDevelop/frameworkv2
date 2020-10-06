<?php

if (!function_exists('view')) {
    function view($path, $data = [])
    {
        return \TheKainCode\View\View::render($path, $data);
    }
}

if (!function_exists('request')) {
    function request($key)
    {
        return \TheKainCode\Http\Request::value($key);
    }
}

if (!function_exists('redirect')) {
    function redirect($path)
    {
        return \TheKainCode\Url\Url::redirect($path);
    }
}

if (!function_exists('previous')) {
    function previous()
    {
        return \TheKainCode\Url\Url::previous();
    }
}

if (!function_exists('url')) {
    function url($path)
    {
        return \TheKainCode\Url\Url::path($path);
    }
}

if (!function_exists('asset')) {
    function asset($path)
    {
        return \TheKainCode\Url\Url::path($path);
    }
}

if (!function_exists('session')) {
    function session($key)
    {
        return \TheKainCode\Session\Session::get($key);
    }
}

if (!function_exists('flash')) {
    function flash($key)
    {
        return \TheKainCode\Session\Session::flash($key);
    }
}

if (!function_exists('links')) {
    function links($current_page, $pages)
    {
        return \TheKainCode\Database\Database::links($current_page, $pages);
    }
}

if (!function_exists('auth')) {
    function auth($table)
    {
        $auth = \TheKainCode\Session\Session::get($table) ?: \TheKainCode\Cookie\Cookie::get($table);
        return \TheKainCode\Database\Database::table($table)->where('id', '=', $auth)->first();
    }
}
