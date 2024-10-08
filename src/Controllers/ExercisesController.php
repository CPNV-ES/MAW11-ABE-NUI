<?php

namespace App\Controllers;

use App\Models\Exercises;

class ExercisesController extends Controller
{
    public static function create()
    {
        $name = $_POST["title"];

        Exercises::addExercise($name);

        include_once VIEW_DIR . '/home.php';
    }
}
