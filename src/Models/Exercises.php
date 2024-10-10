<?php

namespace App\Models;

class Exercises extends Model
{
    public static function addExercise($title, $exercise_status = "building")
    {
        parent::insert(["title", "exercise_status"], ["title" => $title, "exercise_status" => $exercise_status]);
    }

    public static function updateStatus($id, $exercise_status)
    {
        parent::update(["exercise_status"], "id", ["exercise_status" => $exercise_status, "id" => $id]);
    }
}
