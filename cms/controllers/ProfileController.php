<?php

namespace controllers;

use core\Controller;
use models\Users;
use core\Model;
class ProfileController extends Controller
{
    public function actionIndex()
    {
        // Отримання даних користувача
        $user = Users::getLoggedUser();

        // Відображення сторінки профілю
        return $this->render('views/users/profile.php', ['user' => $user]);
    }

    public function actionUpdate()
    {
        // Перевірка, чи користувач залогінений
        if (!Users::IsUserLogged()) {
            return $this->redirect('/users/login');
        }

        // Обробка POST-запиту для зміни даних користувача

        // Перевірка наявності POST-даних
        if ($this->request->isPost()) {
            // Отримання POST-даних
            $userId = Users::getLoggedUser()['id'];
            $address = $this->request->post('address');
            $nickname = $this->request->post('nickname');

            // Оновлення даних користувача
            Users::updateUser($userId, $address, $nickname);

            // Повернення на сторінку профілю
            return $this->redirect('/users/profile');
        }

        // Якщо не POST-запит, перенаправлення на головну сторінку
        return $this->redirect('/');
    }
}
