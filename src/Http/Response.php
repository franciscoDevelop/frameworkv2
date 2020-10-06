<?php

namespace TheKainCode\Http;

class Response
{
    private function __construct()
    {
    }

    public static function json($data)
    {
        return json_encode($data);
    }

    public static function output($data)
    {
        if (!$data) {
            return;
        }
        if (!is_string($data)) {
            $data = static::json($data);
        }
        echo $data;
    }
}
