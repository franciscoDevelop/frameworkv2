<?php

namespace TheKainCode\View;

use TheKainCode\File\File;
use Jenssegers\Blade\Blade;
use TheKainCode\Session\Session;

class View
{
    private function __construct()
    {
    }

    public static function render($path, $data = [])
    {
        $errors = Session::flash('errors');
        $old = Session::flash('old');
        $data = array_merge($data, ['errors' => $errors, 'old' => $old]);
        return static::bladeRender($path, $data);
    }

    public static function bladeRender($path, $data = [])
    {
        $blade = new Blade(File::path('views'), File::path('storage/cache'));
        echo $blade->make($path, $data)->render();
    }

    public static function viewRender($path, $data = [])
    {
        $path = 'views' . File::ds() . str_replace(['/', '\\', '.'], File::ds(), $path) . '.php';
        if (!File::exist($path)) {
            throw new \Exception("The view file {$path} is not exists");
        }

        ob_start();
        extract($data);
        include File::path($path);
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}
