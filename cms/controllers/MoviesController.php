<?php
namespace controllers;

use core\Controller;
use core\Core;
use models\Movies;
use models\Comments;
use models\Users;
use models\Ratings;

class MoviesController extends Controller
{
    // Метод для відображення списку фільмів
    public function actionIndex()
    {
        $movies = Movies::getMovies();
        $this->template->setParam('movies', $movies);
        return $this->render('views/movies/index.php');
    }

    // Метод для відображення деталей фільму та обробки додавання рейтингу і коментаря
    public function actionView($params)
    {
        $movieId = $params[0];

        // Якщо є POST-запит, обробимо його
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePostRequest($movieId);
        }

        // Отримуємо дані для відображення
        $movie = Movies::getMovieById($movieId);
        $averageRating = Ratings::getAverageRating($movieId);
        $comments = Comments::getCommentsByMovieId($movieId);

        $this->template->setParams([
            'movie' => $movie,
            'averageRating' => $averageRating,
            'comments' => $comments
        ]);

        return $this->render('views/movies/view.php');
    }

    // Метод для обробки POST-запитів на додавання рейтингу і коментаря
    private function handlePostRequest($movieId)
    {
        if (Users::IsUserLogged()) {
            $userId = $_SESSION['user']['id'];

            // Обробка рейтингу
            if (isset($_POST['rating'])) {
                $rating = $_POST['rating'];
                $existingRating = Ratings::getRatingsByMovieId($movieId, $userId);
                if ($existingRating) {
                    Ratings::updateRating($existingRating['ID'], ['Rating' => $rating]);
                } else {
                    Ratings::addRating(['Movie_ID' => $movieId, 'User_ID' => $userId, 'Rating' => $rating]);
                }
            }

            // Обробка коментаря
            if (isset($_POST['comment'])) {
                $commentContent = $_POST['comment'];
                if ($commentContent) {
                    Comments::addComment($movieId, $userId, $commentContent);
                }
            }

            // Перенаправлення на ту ж сторінку для уникнення повторної відправки форми
            $this->redirect("/movies/view/{$movieId}");
        }
    }
}
