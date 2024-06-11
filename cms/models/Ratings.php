<?php

namespace models;

use core\Model;
use core\Core;
/**
 * @property int $id ID рейтингу
 * @property int $movie_id ID фільму
 * @property int $user_id ID користувача
 * @property int $rating Рейтинг
 * @property string $created_at Дата створення рейтингу
 */

class Ratings extends Model
{
    public static $tableName = 'ratings';

    /**
     * Додати новий рейтинг
     * @param array $data
     * @return bool
     */
    public static function addRating($data) {
        $db = Core::get()->db;
        return $db->insert(self::$tableName, $data);
    }

    /**
     * Оновити рейтинг
     * @param int $id
     * @param array $data
     * @return bool
     */
    public static function updateRating($id, $data) {
        $db = Core::get()->db;
        return $db->update(self::$tableName, $data, ['ID' => $id]);
    }

    /**
     * Отримати рейтинг за ID
     * @param int $id
     * @return array|null
     */
    public static function getRatingById($id) {
        return self::findById($id);
    }

    /**
     * Отримати всі рейтинги для конкретного фільму
     * @param int $movieId
     * @return array|null
     */
    public static function getRatingsByMovieId($movieId) {
        return self::findByCondition(['Movie_ID' => $movieId]);
    }

    /**
     * Отримати середній рейтинг для фільму
     * @param int $movieId
     * @return float
     */
    public static function getAverageRating($movieId) {
        $db = Core::get()->db;
        $sql = "SELECT AVG(Rating) as average_rating FROM " . self::$tableName . " WHERE Movie_ID = :movieId";
        $sth = $db->pdo->prepare($sql);
        $sth->bindValue(':movieId', $movieId, \PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(\PDO::FETCH_ASSOC);
        return $result ? (float) $result['average_rating'] : null;
    }
    public static function getRatingByUserIdAndMovieId($userId, $movieId) {
        $db = Core::get()->db;
        $sql = "SELECT * FROM " . self::$tableName . " WHERE User_ID = :userId AND Movie_ID = :movieId";
        $sth = $db->pdo->prepare($sql);
        $sth->bindValue(':userId', $userId, \PDO::PARAM_INT);
        $sth->bindValue(':movieId', $movieId, \PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }
}
