<?php

namespace App\Models;

use App\Database\Query;
use PDOException;

class Field
{
    protected int      $id;
    protected Exercise $exercise;
    protected string   $label;
    protected string   $value_kind;
    protected Query    $query;
    protected string $name;
    protected string $description;
    public ?int $exercises_id = null; // Ou adaptez le type selon vos besoins


    public function __construct(array $params = [])
    {
        $this->query = new Query();
        if (array_key_exists('label', $params)) {
            $this->label = $params['label'];
        }
        if (array_key_exists('value_kind', $params)) {
            $this->value_kind = $params['value_kind'];
        }
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function getValueKind(): string
    {
        return $this->value_kind;
    }

    public function setValueKind(string $value_kind): void
    {
        $this->value_kind = $value_kind;
    }

    public function update(): bool
    {
        try {
            return $this->query->update(
                'fields',
                Field::class,
                'id = :id',
                ['id' => $this->id],
                [
                    'label'      => $this->getLabel(),
                    'value_kind' => $this->getValueKind(),
                ]
            );
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }
}