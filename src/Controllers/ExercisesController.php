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

    public static function showAnswering()
    {
        $exercises = Exercises::findAllByStatus("answering");

        include_once VIEW_DIR . "/TakeExercise.php";
    }
}
