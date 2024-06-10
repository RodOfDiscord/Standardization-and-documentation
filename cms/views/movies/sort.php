<?php
use models\Movies;

$genre = $_GET['genre'] ?? null;
$release_Year = $_GET['releaseYear'] ?? null; // Changed release_Year to releaseYear

$movies = Movies::filterMovies($genre, $release_Year);
header('Content-Type: application/json');
echo json_encode($movies);
?>
