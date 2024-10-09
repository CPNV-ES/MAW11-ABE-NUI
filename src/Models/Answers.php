<?php

namespace App\Models;

class Answers extends Model
{
    public static function saveAnswers($field_id, $fulfillment_id, $contents)
    {
        parent::insert(["field_id", "fulfillment_id", "contents"], ["field_id" => $field_id, "fulfillment_id" => $fulfillment_id, "contents" => $contents]);
    }
}
