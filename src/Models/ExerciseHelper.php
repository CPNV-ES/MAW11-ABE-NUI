<?php

namespace App\Models;

class ExerciseHelper extends Model
{
    protected static function tableName()
    {
        return 'exercises'; // Nom de la table correspondant dans la base de données
    }

    public function get($id = null)
    {
        if ($id) {
            return self::findBy('id', $id);
        } else {
            return self::findAll();
        }
    }

    public function save($exercise)
    {
        if (isset($exercise->id)) {
            $columnNames = ['title', 'state']; // Ajoute d'autres colonnes si nécessaire
            $parameters = [
                'title' => $exercise->title,
                'state' => $exercise->state,
                'id' => $exercise->id
            ];
            return self::update($columnNames, 'id', $parameters);
        } else {
            $columnNames = ['title', 'state']; // Ajoute d'autres colonnes si nécessaire
            $parameters = [
                'title' => $exercise->title,
                'state' => $exercise->state
            ];
            return self::insert($columnNames, $parameters);
        }
    }

    public function delete($id)
    {
        $tableName = self::tableName();
        $sql = "DELETE FROM $tableName WHERE id = :id";
        return self::getDatabaseInstance()->query($sql, [':id' => $id]);
    }
}
