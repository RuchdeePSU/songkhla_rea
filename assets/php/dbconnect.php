<?php
class Database{

    //connect to mysql database
    private $host = "localhost";
    private $user = "root";
    //private $user = "skrea_surveying";
    private $passwd = "";
    //private $passwd = "NUwaoFwqCo";
    private $db_name = "songkhla_rea";
    //private $db_name = "skrea_surveying";
    public $conn;

    // get the database connection
    public function getConnection(){
        $this->conn = null;
        try{
            $this->conn = mysqli_connect($this->host, $this->user, $this->passwd, $this->db_name);
            //mysqli_query($this->conn, "SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
            mysqli_set_charset($this->conn, "utf8");
        }catch(Exception $exception){
            echo "Connection error: " . $exception.getMessage();
        }
        return $this->conn;
    }

    // close connection
    public function closeConnection(){
        mysqli_close($this->conn);
    }
}

?>
