<?php

namespace App\Controllers;

use App\Models\Exercises;

class Controller
{
    protected array $variables;

    public function __construct(array $variables = [])
    {
        $this->variables = $variables;
    }

    public function getVariables(): array
    {
        return $this->variables;
    }

    public static function view($parameters)
    {
        $idsArray = $parameters[1];

        $data = [];

        if ($idsArray != []) {
            foreach ($idsArray as $key => $id) {
                if (str_contains($key, "exercise")) {
                    $data["exercise"] = Exercises::findBy("id", $id)[0];
                }
            }
        }

        require_once VIEW_DIR . $parameters[0];
    }
}
