<?php

namespace App\Models;

use App\Models\Database;

class Exercise
{
    public static function addExercises($title, $exercise_status = "building")
    {
        $db = Database::getInstance('localhost', 'mydb', 'user', 'password');
        
        $db->query("INSERT INTO exercises (title, exercise_status) VALUES (:title, :exercise_status)", ["title" => $title, "exercise_status" => $exercise_status]);
    }
}
