<?php

namespace TheKainCode\Http;

use TheKainCode\Http\Server;

class Request
{
  private static $script_name;
  private static $base_url;
  private static $url;
  private static $full_url;
  private static $query_string;

  private function __construct()
  {
  }

  public static function handle()
  {
    static::$script_name = rtrim(str_replace('\\', '', dirname(Server::get('SCRIPT_NAME'))), '/');
    static::setBaseUrl();
    static::setUrl();
  }

  private static function setBaseUrl()
  {
    $protocol = Server::get('REQUEST_SCHEME') . '://';
    $host = Server::get('HTTP_HOST');
    $script_name = static::$script_name;

    static::$base_url = $protocol . $host . $script_name;
  }

  private static function setUrl()
  {
    $request_uri = urldecode(Server::get('REQUEST_URI'));
    $request_uri = preg_replace("#^" . static::$script_name . '#', '', $request_uri);

    $query_string = '';

    static::$full_url = $request_uri;
    if (strpos($request_uri, '?') !== false) {
      list($request_uri, $query_string) = explode('?', $request_uri);
    }

    static::$url = $request_uri ?: '/';
    static::$query_string = $query_string;
  }

  public static function baseUrl()
  {
    return static::$base_url;
  }

  public static function url()
  {
    return static::$url;
  }

  public static function query_string()
  {
    return static::$query_string;
  }

  public static function full_url()
  {
    return static::$full_url;
  }

  public static function method()
  {
    return Server::get('REQUEST_METHOD');
  }

  public static function has($type, $key)
  {
    return array_key_exists($key, $type);
  }

  public static function value($key, array $type = null)
  {
    $type = isset($type) ? $type : $_REQUEST;
    return static::has($type, $key) ? $type[$key] : null;
  }

  public static function get($key)
  {
    return static::value($key, $_GET);
  }

  public static function post($key)
  {
    return static::value($key, $_POST);
  }

  public static function set($key, $value)
  {
    $_REQUEST[$key] = $value;
    $_POST[$key] = $value;
    $_GET[$key] = $value;

    return $value;
  }

  public static function previous()
  {
    return Server::get('HTTP_REFERER');
  }

  public static function all()
  {
    return $_REQUEST;
  }
}
