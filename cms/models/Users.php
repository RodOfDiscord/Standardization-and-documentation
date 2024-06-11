<?php
namespace models;

use core\Model;
use core\Core;

/**
 * @property string $login Логін
 * @property string $password Пароль
 * @property string $firstName Ім'я
 * @property string $lastName Прізвище
 * @property int $id ID користувача
 * @property int $isAdmin Чи є користувач адміністратором
 */
class Users extends Model
{
    public static $tableName = 'users';

    public static function findByLoginAndPassword($login, $password)
    {
        $rows = self::findByCondition(['login' => $login, 'password' => self::hashPassword($password)]);
        return $rows[0] ?? null;
    }

    public static function findByLogin($login)
    {
        $rows = self::findByCondition(['login' => $login]);
        return $rows[0] ?? null;
    }

    public static function hashPassword($password)
    {
        return md5($password);
    }

    public static function isUserLogged()
    {
        return !empty(Core::get()->session->get('user'));
    }

    public static function loginUser($user)
    {
        Core::get()->session->set('user', $user);
    }

    public static function logoutUser()
    {
        Core::get()->session->remove('user');
    }

    public static function registerUser($login, $password, $lastName, $firstName)
    {
        $user = new Users();
        $user->login = $login;
        $user->password = self::hashPassword($password);
        $user->lastName = $lastName;
        $user->firstName = $firstName;
        $user->save();
    }

    public static function isAdmin()
    {
        if (!self::isUserLogged()) {
            return false;
        }

        $user = Core::get()->session->get('user');
        return isset($user['isAdmin']) && $user['isAdmin'] == 1;
    }

    public static function update($userId, $firstName, $lastName)
    {
        $db = Core::get()->db;
        $table = self::$tableName;
        $row_to_update = [
            'firstName' => $firstName,
            'lastName' => $lastName
        ];
        $where = ['id' => $userId];

        return $db->update($table, $row_to_update, $where);
    }

    public static function getUserById($id)
    {
        return self::findById($id);
    }

    public static function getLoggedUser()
    {
        return Core::get()->session->get('user');
    }
}
