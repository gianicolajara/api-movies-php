<?php
include_once '../models/apiMovies.php';
$api = new apiMovie();

if ((isset($_POST['name']) && !empty($_POST['name'])) && (isset($_FILES['file']) && !empty($_FILES['file']))) {

    if ($api->submitImage($_FILES['file'])) {
        $data = array(
            "name" => $_POST['name'],
            "image" => $api->getImage(),
        );

        $api->uploadMovie($data);
    }

} else {
    $api->information("Not found name or file");
}