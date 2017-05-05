<?php
class Admin{

    // database connection and table name
    private $conn;
    private $table_name = "tbl_admin";

    // object properties
    public $email;
    public $passwd;
    public $name;
    public $status;

    public function __construct($db){
        $this->conn = $db;
    }

    // create contact information
    function create(){

        // write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (email, passwd, name, status) VALUES (?,?,?,?)");
        mysqli_stmt_bind_param($stmt, 'ssss', $this->email, $this->passwd, $this->name, $this->status);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        }else {
            return false;
        }
    }  // function create()

    // read all records
    function readall(){
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY name";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    // read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = " . $this->email . " and passwd = " . $this->passwd;
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = '" . $this->email . "' and passwd = '" . md5($this->passwd) . "' and status = 1";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    // update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET passwd = ?, name = ?, status = ? WHERE email = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ssss', $this->passwd, $this->name, $this->status, $this->email);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        }else {
            return false;
        }
    }

    // delete record
    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE email = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->email);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        }else {
            return false;
        }
    }
}

?>
