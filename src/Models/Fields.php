<?php

namespace App\Models;

class Fields extends Model
{
    public static function addField($title, $field_types, $exercises_id)
    {
        parent::insert(["title", "field_types", "exercises_id"], ["title" => $title, "field_types" => $field_types, "exercises_id" => $exercises_id]);
    }
}
