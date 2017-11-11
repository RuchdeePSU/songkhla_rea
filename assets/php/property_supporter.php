<?php
class Property_supporter{
    // database connection and table name
    private $conn;
    private $table_name = "property_supporters";

    // object properties
    public $prop_id;
    public $prop_img;

    public function __construct($db){
        $this->conn = $db;
    }

    // read all records
    function readall($act){
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY prop_id";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    // read one record
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE prop_id = " . $this->prop_id;
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    // create contact information
    function create(){
        // write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (prop_id, prop_img) VALUES (?,?)");
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ss', $this->prop_id, $this->prop_img);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        }else {
            return false;
        }
    }  // function create()

    // update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET prop_img = ? WHERE prop_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ss', $this->prop_img, $this->prop_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        }else {
            return false;
        }
    }

    // delete record
    function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE prop_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameter
        mysqli_stmt_bind_param($stmt, 's', $this->prop_id);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        }else {
            return false;
        }
    }

}
?>
