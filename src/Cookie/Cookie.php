<?php

namespace TheKainCode\Cookie;

class Cookie
{
    private function __construct()
    {
    }

    public static function set($key, $value)
    {
        $expired = time() + (1 * 365 * 24 * 60 * 60);
        setcookie($key, $value, $expired, '/', '', false, true);
        return $value;
    }

    public static function has($key)
    {
        return isset($_COOKIE[$key]);
    }

    public static function get($key)
    {
        return static::has($key) ? $_COOKIE[$key] : null;
    }

    public static function remove($key)
    {
        unset($_COOKIE[$key]);
        setcookie($key, null, '-1', '/');
    }

    public static function all()
    {
        return $_COOKIE;
    }

    public static function destroy()
    {
        foreach (static::all() as $key => $value) {
            static::remove($key);
        }
    }

    public static function flash($key)
    {
        $value = null;
        if (static::has($key)) {
            $value = static::get($key);
            static::remove($key);
        }
        return $value;
    }
}
