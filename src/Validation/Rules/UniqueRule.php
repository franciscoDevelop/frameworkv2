<?php

namespace TheKainCode\Validation\Rules;

use Rakit\Validation\Rule;
use TheKainCode\Database\Database;

class UniqueRule extends Rule
{
    protected $message = ":attribute :value has been used";

    protected $fillableParams = ['table', 'column', 'except'];

    public function check($value): bool
    {
        // make sure required parameters exists
        $this->requireParameters(['table', 'column']);

        // getting parameters
        $column = $this->parameter('column');
        $table = $this->parameter('table');
        $except = $this->parameter('except');

        if ($except and $except == $value) {
            return true;
        }

        $data = Database::table($table)->where($column, '=', $value)->first();

        return $data ? false : true;
    }
}
