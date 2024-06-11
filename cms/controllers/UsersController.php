<?php

namespace controllers;

use core\Controller;
use core\Core;
use models\Users;

class UsersController extends Controller
{
    public function actionLogin()
    {
        if (Users::isUserLogged()) {
            return $this->redirect('/');
        }

        if ($this->isPost) {
            $user = Users::findByLoginAndPassword($this->post->get('login'), $this->post->get('password'));
            if (!empty($user)) {
                Users::loginUser($user);
                return $this->redirect('/');
            } else {
                $this->addErrorMessage('Неправильний логін і/або пароль');
            }
        }

        return $this->render();
    }

    public function actionLogout()
    {
        Users::logoutUser();
        return $this->redirect('/users/login');
    }

    public function actionRegister()
    {
        if ($this->isPost) {
            $user = Users::findByLogin($this->post->get('login'));
            if (!empty($user)) {
                $this->addErrorMessage('Користувач із таким логіном вже існує');
            }
            if ($this->post->get('password') != $this->post->get('password2')) {
                $this->addErrorMessage('Паролі не співпадають');
            }
            if (strlen($this->post->get('password')) < 5) {
                $this->addErrorMessage('Пароль повинен містити не менше 6 символів');
            }

            if (strlen($this->post->get('password')) === 0) {
                $this->addErrorMessage('Пароль не вказано');
            }
            if (strlen($this->post->get('password2')) === 0) {
                $this->addErrorMessage('Пароль(ще раз) не вказано');
            }
            if (strlen($this->post->get('lastname')) === 0) {
                $this->addErrorMessage('Прізвище не вказано');
            }
            if (strlen($this->post->get('firstname')) === 0) {
                $this->addErrorMessage("Ім'я не вказано");
            }
            if (!$this->isErrorMessageExists()) {
                Users::registerUser($this->post->get('login'), $this->post->get('password'), $this->post->get('lastname'), $this->post->get('firstname'));
                return $this->redirect("/users/registersuccess");
            }
        }

        return $this->render();
    }

    public function actionRegistersuccess()
    {
        return $this->render();
    }
}

