<?php

namespace App\Models;

class Fields extends Model
{
    public static function findAllByExerciseId($exercise_id)
    {
        parent::findBy("exercise_id", $exercise_id);
    }
}
