<?php
namespace controllers;

use core\Controller;
use models\Movies;

class MainController extends Controller
{
    public function actionIndex()
    {
        // Отримуємо список фільмів та передаємо їх у шаблон
        $movies = Movies::getMoviesSorted('release_Year');
        $this->template->setParam('movies', $movies);
        return $this->render('views/index.php');
    }

    public function actionFilter()
    {
        $genre = $_GET['genre'] ?? null;
        $releaseYear = $_GET['release_Year'] ?? null;
        $movies = Movies::filterMovies($genre, $releaseYear);

        // Встановлюємо заголовок Content-Type
        header('Content-Type: application/json');

        echo json_encode($movies);
    }
}

