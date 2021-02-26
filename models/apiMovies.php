<?php

include_once "pelicula.php";

class apiMovie extends Pelicula
{

    private $info;
    private $image;

    public function __construct()
    {
        parent::__construct();

    }

    public function getAll()
    {
        $rows = $this->getAllMovies();
        if ($rows->rowCount() > 0) {
            $arrayData = array();
            foreach ($rows->fetchAll() as $value) {
                $row = [
                    "id" => $value['id'],
                    "name" => $value["name"],
                    "img" => $value['image'],
                ];

                array_push($arrayData, $row);
            }
            $arrayData = ["movies" => $arrayData];
            $this->message($arrayData);
        } else {
            $this->information("Not found movies");

        }
    }

    public function getMovieId($id)
    {
        $row = $this->getMoviePerId($id);
        if ($row->rowCount() === 1) {
            $res = $row->fetch(PDO::FETCH_ASSOC);
            $res = ["movies" => $res];
            $this->message($res);
        } else {
            $this->information("Not found movies");
        }
    }

    public function uploadMovie($item)
    {
        $res = $this->submitMovie($item);
        if ($res) {
            $this->information('Movie submit successfully');
        } else {
            $this->information('can´t submit the movie');
        }
    }

    public function submitImage($image)
    {
        $directory = '../assets/images/';
        $name = $image['name'];
        $infoFile = pathinfo($directory . $name);
        $nameFile = $infoFile['filename'];
        $extFile = $infoFile['extension'];

        if (getimagesize($image['tmp_name'])) {

            if ($extFile === 'jpg' || $extFile === 'jpeg') {

                if ($image['size'] < 500000) {

                    if (move_uploaded_file($image['tmp_name'], $directory . $name)) {
                        $this->information('image submit successfully');
                        $this->image = $nameFile;
                        return true;
                    } else {
                        $this->information('image not submit');
                    }

                } else {

                    $this->information('image is heavy(500000kb+)');

                }

            } else {
                $this->information('Image is not a jpg extension');

            }

        } else {
            $this->information('Not is a image');
        }

    }

    public function getImage()
    {
        return $this->image;
    }

    public function information($info)
    {
        $message = array("error" => $info);
        $message = json_encode($message);
        echo $message;
    }

    public function message($info)
    {

        $message = json_encode($info);
        echo $message;
    }

}