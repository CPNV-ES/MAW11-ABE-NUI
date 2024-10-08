<?php

namespace App\Controllers;

use App\Models\Exercise;

class ExercisesController extends Controller
{
    public static function create()
    {
        $name = $_POST["title"];

        Exercise::addExercise($name);

        include_once VIEW_DIR . '/home.php';
    }
}
