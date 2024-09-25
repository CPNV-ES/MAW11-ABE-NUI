<?php

namespace App\Controllers;

use App\Models\Exercise;

class ExercisesController
{
    public static function create()
    {
        $name = $_POST["exercise_name"];

        Exercise::addExercise($name);

        require_once(VIEW_DIR . '/home.php');
    }
}