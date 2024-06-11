<?php
namespace controllers;

use core\Controller;
use models\Movies;
use core\Core;
class FilterController extends Controller
{
    public function actionFilter() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Отримуємо дані з форми
            $release_Year = $_POST['release_Year'];
            $genre = $_POST['genre'];
            $title = $_POST['title'];
            $conditions = [];

            if (!empty($genre)) {
                $conditions['genre'] = $genre;
            }
            if (!empty($title)) {
                $conditions['title'] = $title;
            }
            if (!empty($release_Year)) {
                $conditions['release_Year'] = $release_Year;
            }

            $db = Core::get()->db;
            $where = !empty($conditions) ? $conditions : null;

            $movies = $db->select('movies', '*', $where);

            include_once 'views/movies/index.php';
        } else {
            echo "Метод не підтримується";
        }
    }

    public function actionSortByRating()
    {
        $movies = Movies::getMoviesSortedByRating();
        $this->template->setParam('movies', $movies);
        return $this->render('views/movies/index.php');
    }


}

