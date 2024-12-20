<?php

namespace App\Models;

use App\Database\DBConnection;
use App\Database\Query;
use PDOException;


class ExerciseHelper
{
    protected Query $query;

    public function __construct()
    {
        $this->query = new Query();
    }

    
    public function get(int $exerciseId = null): array|Exercise
    {
        if (is_null($exerciseId)) {
            return $this->query->select('exercises', Exercise::class);
        } else {
            return $this->query->select('exercises', Exercise::class, 'id = :id', ['id' => $exerciseId], true);
        }
    }

    public function save(Exercise $exercise): int
    {
        if (is_null($exercise->getId())) {
            return $this->create($exercise);
        } else {
            return $this->update($exercise);
        }
    }


    private function create(Exercise $exercise): int
    {
        try {
            return $this->query->insert(
                'exercises',
                Exercise::class,
                ['title' => $exercise->getTitle(), 'state' => $exercise->getState()]
            );
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }


    private function update(Exercise $exercise): int
    {
        try {
            return $this->query->update(
                'exercises',
                Exercise::class,
                'id = :id',
                ['id' => $exercise->getId()],
                ['title' => $exercise->getTitle(), 'state' => $exercise->getState()]
            );
        } catch (PDOException $e) {
            error_log($e);
            return false;
        }
    }

    public function delete(int $exerciseId): bool
    {
        $exercise = $this->get($exerciseId);
        $pdo = DBConnection::getInstance()->getPDO();
        try {
            $pdo->beginTransaction();
            foreach ($exercise->getFields() as $field) {
                $exercise->deleteField($field->getId());
            }
            $this->query->delete('exercises', Exercise::class, 'id = :id', ['id' => $exerciseId]);
            $pdo->commit();
            return true;
        } finally {
            // If the transaction has not been committed, roll it back
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
                return false;
            }
        }
    }
}