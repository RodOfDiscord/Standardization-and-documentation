<?php
// models/Users.php

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

    public static function FindByLoginAndPassword($login, $password)
    {
        $rows = self::findByCondition(['login' => $login, 'password' => $password]);

        if (!empty($rows)) {
            return $rows[0];
        } else {
            return null;
        }
    }

    public static function FindByLogin($login)
    {
        $rows = self::findByCondition(['login' => $login]);

        if (!empty($rows)) {
            return $rows[0];
        } else {
            return null;
        }
    }

    public static function IsUserLogged()
    {
        return !empty(Core::get()->session->get('user'));
    }

    public static function LoginUser($user)
    {
        Core::get()->session->set('user', $user);
    }

    public static function LogoutUser($user)
    {
        Core::get()->session->remove('user', $user);
    }

    public static function RegisterUser($login, $password, $lastName, $firstName)
    {
        $user = new Users();
        $user->login = $login;
        $user->password = $password;
        $user->lastName = $lastName;
        $user->firstName = $firstName;
        $user->save();
    }

    public static function isAdmin()
    {
        if (!self::IsUserLogged()) {
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

