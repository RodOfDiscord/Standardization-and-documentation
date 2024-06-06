<?php

namespace controllers;

use core\Controller;
use models\Movies;
use core\Template;
use core\DB;

class MoviesController extends Controller
{
    public function actionIndex()
    {
        $movies = Movies::getMovies();
        $this->template->setParam('movies', $movies);
        return $this->render('views/movies/index.php');
    }
}




