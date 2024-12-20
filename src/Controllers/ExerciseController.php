<?php

namespace App\Controllers; // Defines the namespace for the controller

use App\Database\Query; // Imports the Query class
use App\Models\Field; // Imports the Field model
use App\Models\ExerciseHelper; // Imports the ExerciseHelper model
use App\Models\Exercise; // Imports the Exercise model

class ExerciseController extends Controller {
    private int $id; // Private property to store the ID
    private string $title; // Private property to store the title
    private ExerciseHelper $exerciseHelper; // Private property to store the ExerciseHelper instance
    private Query $query; // Private property to store the Query instance

    public function __construct(array $params = []) {
        // Constructor logic here
        parent::__construct(); // Calls the parent constructor
        $this->exerciseHelper = new ExerciseHelper(); // Initializes the ExerciseHelper instance
    }

    public function index() {
        // Logic to show exercise
        
        $this->view('exercises/index', [
            'exercises' => $this->exerciseHelper->get(), // Retrieves exercises using ExerciseHelper
            'router'    => $this->router, // Passes the router to the view
        ]);
    }

    public function answering() {
        // Logic to show exercise
        
        $this->view('exercises/answering', [
            'exercises' => $this->exerciseHelper->get(), // Retrieves exercises using ExerciseHelper
            'router'    => $this->router, // Passes the router to the view
        ]);
    }

    public function new() {
        // Logic to show exercise
        
        $params['router'] = $this->router; // Sets the router parameter
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $exercise = new Exercise(['title' => $_POST['title']]); // Creates a new Exercise instance
            if ($exerciseId = $this->exerciseHelper->save($exercise)) {
                $this->router->redirect('fields_index', ['exercise' => $exerciseId]); // Redirects to fields index if exercise is saved
            }
            $params["error"] = "Le titre est déjà utilisé. Veuillez en choisir un autre."; // Sets error message if title is used
        }
        $this->view('exercises/new', $params); // Renders the new exercise view with parameters

    }

    public function getId(): int {
        // Getter logic here
        return $this->id; // Returns the ID
    }

    public function getTitle(): string {
        // Getter logic here
        return $this->title; // Returns the title
    }

    public function getFields(int $fieldId): array {
        // Logic to get fields by exercise ID and field ID
        $params = [':exerciseId' => $this->id, ':fieldId' => $fieldId]; // Sets parameters for query
        return $this->query->select('fields', Field::class, 'exercise_id = :exerciseId', $params); // Executes the select query to get fields
    }

    public function createField(Field $field): void {
        // Logic to create field
        
        $data = ['exercise_id' => $this->id, 'name' => $field->getName(), 'description' => $field->getDescription()]; // Sets data for insertion
        $field->setId($this->query->insert('fields', Field::class, $data)); // Inserts new field and sets its ID
        
    }

    public function deleteField(Field $field): void {
        // Logic to delete field
        $params = [':fieldId' => $field->getId()]; // Sets parameters for deletion
        $this->query->delete('fields', Field::class, 'id = :fieldId', $params); // Executes the delete query
        
    }

    public function getFulfillments(int $fulfillmentId): array {
        // Logic to get fulfillments
    }

    public function state(int $exerciseId, string $query) {
        parse_str($query, $params); // Parses the query string into parameters

        $exercise = $this->exerciseHelper->get($exerciseId); // Retrieves the exercise using ExerciseHelper
        $exercise->setState($params['state']); // Sets the state of the exercise

        $this->exerciseHelper->save($exercise); // Saves the exercise

        $this->view('exercises/index', [
            'exercises' => $this->exerciseHelper->get(), // Retrieves exercises using ExerciseHelper
            'router'    => $this->router, // Passes the router to the view
        ]);
    }
}
