<?php

namespace App\Models;

class FieldsHasFulfillments
{
    protected Field       $field;
    protected Fulfillment $fulfillment;
    protected string      $value;

    public function getValue(): string
    {
        return $this->value;
    }
}
