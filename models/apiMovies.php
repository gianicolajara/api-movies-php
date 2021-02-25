<?php

include_once "db.php";

class apiMovie extends DB
{

    private $info;

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        $rows = $this->connect()->query("SELECT * FROM slots");
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
            $this->info = json_encode(["movies" => $arrayData]);
            print_r($this->info);
        } else {
            $this->info = ['info' => "Not found movies"];
            $this->error($this->info);

        }
    }

    public function getMovieId($id)
    {
        $row = $this->connect()->prepare("SELECT * FROM slots WHERE id=:id");
        $row->execute(["id" => $id]);
        if ($row->rowCount() === 1) {
            $res = $row->fetch(PDO::FETCH_ASSOC);
            $res = json_encode(["movies" => $res]);
            echo $res;
        } else {
            $this->info = ['info' => "Not found movies"];
            $this->error($this->info);
        }
    }

    public function error($error)
    {
        $error = json_encode($error);
        echo $error;
    }

}