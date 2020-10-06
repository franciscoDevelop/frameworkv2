<?php

namespace TheKainCode\Validation;

use Rakit\Validation\Validator;
use TheKainCode\Http\Request;
use TheKainCode\Session\Session;
use TheKainCode\Url\Url;

class Validate
{
    private function __construct()
    {
    }

    public static function validate(array $rules, $json)
    {
        $validator = new Validator;

        $validation = $validator->make($_POST + $_FILES, $rules);
        $errors = $validation->errors();

        if ($validation->fails()) {
            if ($json) {
                return ['errors' => $errors->firstOfAll()];
            } else {
                Session::set('errors', $errors);
                Session::set('old', Request::all());
                return Url::redirect(Url::previous());
            }
        }
    }
}
