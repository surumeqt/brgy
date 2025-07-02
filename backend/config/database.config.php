<?php 
define("SERVER", "localhost");
define("DBNAME", "brgy_newkalalake_lgu");
define("USERNAME", "root");
define("PASSWORD", "");

class Connection {
    private $connString = "mysql:host=".SERVER.";dbname=".DBNAME.";charset=utf8";
    private $option = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::ATTR_EMULATE_PREPARES => false
    ];

    public function connect(){
        try {
            return new \PDO($this->connString, USERNAME, PASSWORD, $this->option);
        } catch (\PDOException $e) {
            echo "Database not connected";
        }
    }
}