<?php

namespace TheKainCode\Url;

use TheKainCode\Http\Request;
use TheKainCode\Http\Server;

class Url
{
    private function __construct()
    {
    }

    public static function path($path)
    {
        return Request::baseUrl() . '/' . trim($path, '/');
    }

    public static function previous()
    {
        return Server::get('HTTP_REFERER');
    }

    public static function redirect($path)
    {
        header('location: ' . $path);
        exit();
    }
}
