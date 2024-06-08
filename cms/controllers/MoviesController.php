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
        $movies = Movies::getMovies();
        $this->template->setParam('movies', $movies);
        return $this->render('views/movies/index.php');
    }

    public function actionView($params)
    {
        $movieId = $params[0];
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

    public function actionRate($params)
    {
        $movieId = $params[0];
        $rating = $_POST['rating'];
        $user = Users::IsUserLogged() ? Users::getUserById(Core::get()->session->get('user')['id']) : null;

        if ($user) {
            $existingRating = Ratings::getRatingsByMovieId($movieId, $user['id']);
            if ($existingRating) {
                Ratings::updateRating($existingRating['ID'], ['Rating' => $rating]);
            } else {
                Ratings::addRating(['Movie_ID' => $movieId, 'User_ID' => $user['id'], 'Rating' => $rating]);
            }
        }
        header("Location: /movies/view/{$movieId}");
        exit;
    }

    public function actionAddComment()
    {
        // Перевірка, чи був запит POST і чи залогінений користувач
        if ($this->isPost && Users::IsUserLogged()) {
            // Отримання ID користувача з сесії
            $userId = $_SESSION['user']['id'];

            // Отримання ID фільму та коментаря з POST-запиту
            $movieId = $this->post->get('movie_id');
            $commentContent = $this->post->get('comment');

            // Перевірка, чи були надані movie_id та comment
            if ($movieId && $commentContent) {
                // Додавання коментаря
                Comments::addComment($movieId, $userId, $commentContent);

                // Перенаправлення на сторінку перегляду фільму
                $this->redirect('/movies/view/' . $movieId);
            }
        }
    }
}
