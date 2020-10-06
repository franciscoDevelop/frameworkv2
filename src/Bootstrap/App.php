<?php

namespace TheKainCode\Bootstrap;

use TheKainCode\Http\Server;
use TheKainCode\Http\Request;
use TheKainCode\Session\Session;
use TheKainCode\Exceptions\Whoops;
use TheKainCode\File\File;
use TheKainCode\Http\Response;
use TheKainCode\Router\Route;

class App
{
    private function __construct()
    {
    }

    public static function run()
    {
        Whoops::handle();
        Session::start();
        Request::handle();
        File::require_directory('routes');
        $data = Route::handle();
        Response::output($data);
    }
}
