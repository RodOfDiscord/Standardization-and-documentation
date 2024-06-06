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
}
