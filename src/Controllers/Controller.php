<?php

namespace App\Controllers;

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

    public static function view(string $path): void
    {
        require_once VIEW_DIR . $path;
    }
}
