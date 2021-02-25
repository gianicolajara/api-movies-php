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
            $arrayData = ["movies" => $arrayData];
            $this->info($arrayData);
        } else {
            $this->info = ['info' => "Not found movies"];
            $this->info($this->info);

        }
    }

    public function getMovieId($id)
    {
        $row = $this->connect()->prepare("SELECT * FROM slots WHERE id=:id");
        $row->execute(["id" => $id]);
        if ($row->rowCount() === 1) {
            $res = $row->fetch(PDO::FETCH_ASSOC);
            $res = ["movies" => $res];
            $this->info($res);
        } else {
            $this->info = ['info' => "Not found movies"];
            $this->info($this->info);
        }
    }

    public function info($info)
    {
        $message = json_encode($info);
        echo $message;
    }

}