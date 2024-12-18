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

    // Fusion des deux méthodes view en une seule méthode polymorphe
    public static function view($viewPath, $params = [])
    {
        if (is_array($viewPath)) {
            $idsArray = $viewPath[1];
            $data = [];

            if ($idsArray != []) {
                foreach ($idsArray as $key => $id) {
                    if (str_contains($key, "exercise")) {
                        $data["exercise"] = Exercises::findBy("id", $id)[0];
                    }
                }
            }

            require_once VIEW_DIR . $viewPath[0];
        } else {
            extract($params);
            include(VIEW_DIR . '/' . $viewPath . '.php');
        }
    }
}
