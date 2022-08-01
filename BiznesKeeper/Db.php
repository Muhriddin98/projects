<?php
class Db {
    private $host = '127.0.0.1';
    private $db = 'house_mall';
    private $user = 'root';
    private $pass = '';
    private $pdo = null;

    public function connect()
    {
        if(is_null($this->pdo)) {
            $this->setPdo();
        }
        return $this->pdo;
    }

    private function setPdo()
    {
        $dsn = "mysql:host=".$this->host.";dbname=".$this->db;
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            if($this->pdo){
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
?>