<?php

namespace App\Models;

use App\Models\Database;

class Exercise
{
    public static function addExercise($title, $exercise_status = "building")
    {
        $db = Database::getInstance($_ENV["DATABASE_HOST"], $_ENV["DATABASE_NAME"], $_ENV["DATABASE_USERNAME"], $_ENV["DATABASE_PASSWORD"]);
        
        $db->query("INSERT INTO exercises (title, exercise_status) VALUES (:title, :exercise_status)", ["title" => $title, "exercise_status" => $exercise_status]);
    }
}
