<?php

namespace controllers;

use core\Controller;
use models\Movies;
use core\Template;
use core\DB;

class AdminController extends Controller
{
    public function actionAdd()
    {
        if ($this->isPost) {
            $imagePath = null;

            // Перевірка наявності файлу
            if (!empty($_FILES['image']['tmp_name'])) {
                $uploadDir = 'views/movies/images/';
                $uploadFile = $uploadDir . basename($_FILES['image']['name']);

                // Переміщення завантаженого файлу в директорію
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $imagePath = '/' . $uploadFile;
                } else {
                    echo "Помилка завантаження файлу.";
                }
            }
            $data = [
                'title' => $this->post->title,
                'release_Year' => $this->post->release_Year,
                'genre' => $this->post->genre,
                'Txt_Description' => $this->post->Txt_Description,
                'image_path' => $imagePath
            ];

            if (Movies::addMovie($data)) {
                $this->redirect('/');
            } else {
                echo "Помилка збереження даних.";
            }
        }

        return $this->render('views/admin/add.php');
    }
    public function actionEdit($params)
    {
        if (is_array($params) && !empty($params)) {
            $id = $params[0];
        } else {
            echo "ID фільму не вказано.";
            return null;
        }
        $movie = Movies::getMovieById($id);

        if (!$movie) {
            echo "Фільм не знайдено.";
            return null;
        }

        if ($this->isPost) {
            $imagePath = $movie['image_path'];

            // Перевірка наявності файлу
            if (!empty($_FILES['image']['tmp_name'])) {
                $uploadDir = 'views/movies/images/'; // Відносний шлях до директорії завантаження
                $uploadFile = $uploadDir . basename($_FILES['image']['name']);

                // Переміщення завантаженого файлу в директорію
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $imagePath = '/' . $uploadFile;
                } else {
                    // Обробка помилок завантаження файлу
                    echo "Помилка завантаження файлу.";
                }
            }

            $data = [
                'title' => $this->post->title,
                'release_Year' => $this->post->release_Year,
                'genre' => $this->post->genre,
                'Txt_Description' => $this->post->Txt_Description,
                'image_path' => $imagePath
            ];

            if (Movies::updateMovie($id, $data)) {
                $this->redirect('/');
            } else {
                echo "Помилка збереження даних.";
            }
        }

        $this->template->setParam('movie', $movie);
        return $this->render('views/admin/edit.php');
    }
    public function actionDelete($params)
    {
        if (is_array($params) && !empty($params)) {
            $id = $params[0];
        } else {
            echo "ID фільму не вказано.";
            return null;
        }

        $movie = Movies::getMovieById($id);

        if (!$movie) {
            echo "Фільм не знайдено.";
            return null;
        }

        $result = Movies::deleteMovieById($id);

        if ($result) {
            $_SESSION['message'] = "Фільм успішно видалено.";
        } else {
            $_SESSION['message'] = "Помилка при видаленні фільму.";
        }

        $this->template->setParam('message', $_SESSION['message']);
        return $this->render('views/admin/delete.php');
    }


}