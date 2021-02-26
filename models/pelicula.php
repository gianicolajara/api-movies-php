<?php

require_once 'db.php';

class Pelicula extends DB
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllMovies()
    {
        $query = $this->connect()->query("SELECT * FROM slots");
        return $query;
    }

    public function getMoviePerId($id)
    {
        $query = $this->connect()->prepare("SELECT * FROM slots WHERE id=:id");
        $query->execute(["id" => $id]);
        return $query;
    }

    public function submitMovie($item)
    {

        $query = $this->connect()->prepare("INSERT INTO slots(name, image) VALUES(:name, :image)");
        $query->execute(["name" => $item['name'], "image" => $item['image']]);
        return $query;
    }

}