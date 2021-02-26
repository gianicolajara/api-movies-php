<?php

class DB
{
    private $host;
    private $username;
    private $pass;
    private $charset;
    private $dbname;

    public function __construct()
    {
        $this->host = "localhost";
        $this->username = "root";
        $this->pass = "";
        $this->charset = "utf8";
        $this->dbname = "movies";
    }

    public function connect()
    {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset";
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false];
            $connect = new PDO($dsn, $this->username, $this->pass, $options);
            return $connect;

        } catch (PDOException $e) {
            echo 'Error db: ' . $e;
        }
    }

}