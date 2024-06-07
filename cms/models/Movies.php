<?php

namespace models;

use core\Model;
use core\Core;

/**
 * @property int $id ID фільму
 * @property varchar(100) $title Назва фільму
 * @property int $release_Year Рік випуску
 * @property varchar(50) $genre Жанр
 * @property text $Txt_Description Опис фільму
 * @property blob $image Зображення фільму
 * @property varchar(255) $image_path Шлях до зображення
 */
class Movies extends Model
{
    public static $tableName = 'movies';

    /**
     * Отримати всі фільми з бази даних
     * @return array|null
     */
    public static function getMovies() {
        $rows = self::getAll(self::$tableName);
        return !empty($rows) ? $rows : null;
    }

    /**
     * Отримати фільм за його ID
     * @param int $id
     * @return array|null
     */
    public static function getMovieById($id) {
        $db = Core::get()->db;
        $sql = "SELECT * FROM " . self::$tableName . " WHERE id = :id";
        $sth = $db->pdo->prepare($sql); // змінено з $db->prepare($sql) на $db->pdo->prepare($sql)
        $sth->bindValue(':id', $id, \PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }
    /**
     * Додати новий фільм в базу даних
     * @param array $data
     * @return bool
     */
    public static function addMovie($data) {
        $db = Core::get()->db;
        return $db->insert(self::$tableName, $data);
    }

    /**
     * Оновити фільм у базі даних
     * @param int $id
     * @param array $data
     * @return bool
     */
    public static function updateMovie($id, $data) {
        try {
            $db = Core::get()->db;
            return $db->update(self::$tableName, $data, ['id' => $id]);
        } catch (\PDOException $e) {
            // Вивести повідомлення про помилку
            echo "Помилка при оновленні фільму: " . $e->getMessage();
            return false;
        }
    }
    public static function deleteMovieById($id) {
        try {
            $db = Core::get()->db;
            return $db->delete(self::$tableName, ['id' => $id]);
        } catch (\PDOException $e) {
            // Вивести повідомлення про помилку
            echo "Помилка при видаленні фільму: " . $e->getMessage();
            return false;
        }
    }



}
