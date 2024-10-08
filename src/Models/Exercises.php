<?php

namespace App\Models;

class Exercises extends Model
{
    public static function addExercise($title, $exercise_status = "building")
    {
        parent::insert(["title", "exercise_status"], ["title" => $title, "exercise_status" => $exercise_status]);
    }
}
