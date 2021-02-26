<?php

include_once "models/apiMovies.php";

$apiMovie = new apiMovie();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    if (is_numeric($id)) {
        $apiMovie->getMovieId($id);
    } else {
        $apiMovie->information("id not is numeric");
    }
} else {
    $apiMovie->getAll();
}