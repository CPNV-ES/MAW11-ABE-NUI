<?php

namespace App\Controllers; // Defines the namespace for the controller

use App\Models\ExerciseHelper; // Imports the ExerciseHelper model
use App\Models\Field; // Imports the Field model

class FieldsController extends Controller
{
    protected ExerciseHelper $exerciseHelper; // Protected property to store the ExerciseHelper instance

    public function __construct()
    {
        parent::__construct(); // Calls the parent constructor
        $this->exerciseHelper = new ExerciseHelper(); // Initializes the ExerciseHelper instance
    }

    public function index(int $exerciseId): void
    {
        $exercise = $this->exerciseHelper->get($exerciseId); // Retrieves the exercise using ExerciseHelper
        $params = [
            'exercise' => $exercise, // Sets the exercise parameter
            'router'   => $this->router, // Sets the router parameter
        ];
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $field = new Field([
                'label'      => $_POST['field']['label'], // Sets the label for the field
                'value_kind' => $_POST['field']['value_kind'], // Sets the value kind for the field
            ]);
    
            if ($exercise->createField($field)) {
                $this->router->redirect('fields_index', ['exercise' => $exercise->getId()]); // Redirects to fields index if the field is created
            } else {
                $params["error"] = "Le label déjà utilisé. Veuillez en choisir un autre."; // Sets error message if label is already used
            }
        }
    
        $this->view('fields/index', $params); // Renders the fields index view with parameters
    }
}
