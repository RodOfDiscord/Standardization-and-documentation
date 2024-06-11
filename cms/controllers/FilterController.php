<?php
namespace controllers;

use core\Controller;
use models\Movies;
use core\Core;
class FilterController extends Controller
{
    public function actionFilter($params) {
        $conditions = [];

        if (!empty($params['genre'])) {
            $conditions['genre'] = $params['genre'];
        }
        if (!empty($params['title'])) {
            $conditions['title'] = $params['title'];
        }
        if (!empty($params['release_Year'])) {
            $conditions['release_Year'] = $params['release_Year'];
        }

        $db = Core::get()->db;
        $where = !empty($conditions) ? $conditions : null;

        $movies = $db->select('movies', '*', $where);

        include_once 'views/movies/index.php';
    }
    public function actionSortByRating()
    {
        $movies = Movies::getMoviesSortedByRating();
        $this->template->setParam('movies', $movies);
        return $this->render('views/movies/index.php');
    }
}

