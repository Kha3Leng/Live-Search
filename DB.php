<?php
class DB{
    private $con;
    private $host = "localhost";
    private $dbname = "LiveSearch";
    private $user = "root";
    private $password = "";

    public function __construct(){
        $dsn = "mysql:host=". $this->host . ";dbname=".$this->dbname;

        try{
            $this->con = new PDO($dsn, $this->user, $this->password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo 'CONNECTION SUCCESS';
        }catch(PDOException $e){
            echo "CONNECTIN FAILED ".$e->getMessage();
        }
    }

    public function viewData(){
        $query = "SELECT name from names";
        $stmt = $this->con->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function searchData($name){
        $query = "SELECT name from names where name like :name";
        $stmt = $this->con->prepare($query);
        $stmt->execute(["name"=>"%".$name."%"]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
?>