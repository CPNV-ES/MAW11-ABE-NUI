<?php

namespace App\Models;

use App\Database\Query;
use PDOException;

class Exercise extends Model
{
    protected int    $id;
    protected string $title;
    protected string $state = 'building';
    protected Query  $query;

    public function __construct(array $params = [])
    {
        $this->query = new Query();
        if (array_key_exists('title', $params)) {
            $this->title = $params['title'];
        }
        parent::__construct($params);  // Appel au constructeur parent après initialisation
    }

    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getFields(int $fieldId = null): array|Field
    {
        if (is_null($fieldId)) {
            return $this->query->select('fields', Field::class, 'exercises_id = :id', [':id' => $this->id]);
        } else {
            return $this->query->select(
                'fields',
                Field::class,
                'id  = :field_id AND exercises_id = :exercises_id',
                ['field_id' => $fieldId, 'exercises_id' => $this->id],
                true
            );
        }
    }

    public function createField(Field $field): int
    {
        try {
            return $this->query->insert('fields', Field::class, [
                'label'        => $field->getLabel(),
                'value_kind'   => $field->getValueKind(),
                'exercises_id' => $this->id,
            ]);
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }

    public function deleteField(int $fieldId): void
    {
        foreach ($this->getFulfillments() as $fulfillment) {
            $fulfillment->delete();
        }
        $this->query->delete('fields', Field::class, 'id = :id', ['id' => $fieldId]);
    }

    public function getFulfillments(int $fulfillment = null): array|Fulfillment
    {
        if (is_null($fulfillment)) {
            return $this->query->select('fulfillments', Fulfillment::class, 'exercises_id = :id', [':id' => $this->id]);
        } else {
            return $this->query->select(
                'fulfillments',
                Fulfillment::class,
                'id = :field_id AND exercises_id = :exercises_id',
                ['field_id' => $fulfillment, 'exercises_id' => $this->id],
                true
            );
        }
    }
}
