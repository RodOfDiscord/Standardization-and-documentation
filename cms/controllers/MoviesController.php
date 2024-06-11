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
    public function actionIndex()
    {

        $movies = Movies::getAll();
        $this->template->setParam('movies', $movies);
        return $this->render('views/movies/index.php');
    }
    public function actionView($params)
    {
        $movieId = $params[0];

        // Якщо є POST-запит, обробимо його
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePostRequest($movieId);
        }

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

    private function handlePostRequest($movieId)
    {
        if (Users::IsUserLogged()) {
            $userId = $_SESSION['user']['id'];

            if (isset($_POST['rating'])) {
                $rating = $_POST['rating'];
                if ($rating !== '') {
                    $existingRating = Ratings::getRatingByUserIdAndMovieId($userId, $movieId);
                    if ($existingRating) {
                        Ratings::updateRating($existingRating['ID'], ['Rating' => $rating]);
                    } else {
                        Ratings::addRating(['Movie_ID' => $movieId, 'User_ID' => $userId, 'Rating' => $rating]);
                    }
                }
            }
            if (isset($_POST['comment'])) {
                $commentContent = $_POST['comment'];
                if ($commentContent) {
                    Comments::addComment($movieId, $userId, $commentContent);
                }
            }

            $this->redirect("/movies/view/{$movieId}");
        }
    }
}
