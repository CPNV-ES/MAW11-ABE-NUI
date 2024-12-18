<?php

namespace App\Controllers;

use App\Models\Exercise;
use App\Models\ExerciseHelper;
use App\Router\Router;


class ExercisesController extends Controller
{
    protected ExerciseHelper $exerciseHelper;

    public function __construct()
    {
        parent::__construct();
        $this->router = new Router();
        $this->exerciseHelper = new ExerciseHelper();
    }
    public function index(): void
    {
        $exercises = $this->exerciseHelper->get();
        var_dump($exercises); // Affiche les exercices récupérés pour vérifier
        $this->view('exercises/index', [
            'exercises' => $exercises,
            'router'    => $this->router,
        ]);
    }

    public function create(): void
    {
        $params['router'] = $this->router;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $exercise = new Exercise(['title' => $_POST['title']]);
            if ($exerciseId = $this->exerciseHelper->save($exercise)) {
                $this->router->redirect('fields_index', ['exercise' => $exerciseId]);
            }
            $params["error"] = "Le titre est déjà utilisé. Veuillez en choisir un autre.";
        }
        $this->view('exercises/new', $params);
    }

    public function state(int $exerciseId, string $query): void
    {
        parse_str($query, $params);

        $exercise = $this->exerciseHelper->get($exerciseId);
        $exercise->setState($params['state']);

        $this->exerciseHelper->save($exercise);

        $this->router->redirect('exercises_index');
    }

    public function answering(): void
    {
        $this->view('exercises/answering', [
            'exercises' => $this->exerciseHelper->get(),
            'router'    => $this->router,
        ]);
    }

    public function results(int $exerciseId): void
    {
        $exercise = $this->exerciseHelper->get($exerciseId);

        $this->view('exercises/results', [
            'exercise'     => $exercise,
            'fields'       => $exercise->getFields(),
            'fulfillments' => $exercise->getFulfillments(),
            'router'       => $this->router,
        ]);
    }

    public function delete(int $exerciseId): void
    {
        $this->exerciseHelper->delete($exerciseId);
        $this->router->redirect('exercises_index');
    }
}
