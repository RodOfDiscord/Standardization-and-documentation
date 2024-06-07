<?php

namespace controllers;

use core\Controller;
use models\Movies;
use models\Comments;
use models\Users;

class MoviesController extends Controller
{
    public function actionIndex()
    {
        $movies = Movies::getMovies();
        $this->template->setParam('movies', $movies);
        return $this->render('views/movies/index.php');
    }

    public function actionView($id)
    {
        $movie = Movies::findById($id);
        $comments = Comments::getCommentsByMovieId($id);
        $this->template->setParam('movie', $movie);
        $this->template->setParam('comments', $comments);
        return $this->render('views/movies/view.php');
    }

    public function actionAddComment()
    {
        if ($this->isPost && isset($_SESSION['user_id'])) {
            // Отримання ID користувача з сесії
            $userId = $_SESSION['user_id'];

            // Отримання ID фільму та коментаря з POST-запиту
            $movieId = $this->post->get('movie_id');
            $commentContent = $this->post->get('comment');

            // Додавання коментаря
            Comments::addComment($movieId, $userId, $commentContent);

            // Перенаправлення на сторінку перегляду фільму
            $this->redirect('/movies/view/' . $movieId);
        } else {
            // Якщо користувач не залогінений, перенаправлення на головну сторінку
            $this->redirect('/');
        }
    }
}
