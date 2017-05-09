<?php
class Property{

    // database connection and table name
    private $conn;
    private $table_name = "properties";

    // object properties
    public $prop_id;
    public $prop_name;
    public $prop_address_no;
    public $prop_address_moo;
    public $prop_address_road;
    public $prop_address_subdistrict;
    public $prop_address_district;
    public $prop_type_id;
    public $prop_municipal_id;
    public $prop_lat;
    public $prop_long;
    public $prop_detail_link;
    public $prop_thumbnail_img;
    public $prop_icon_type;
    public $prop_min_price;
    public $prop_max_price;
    public $prop_status;
    public $prop_created_date;

    public function __construct($db){
        $this->conn = $db;
    }

    // read all records
    function readall($act){
        if ($act) {
          $query = "SELECT * FROM " . $this->table_name . " WHERE prop_status = 1 ORDER BY prop_id";
        } else {
          $query = "SELECT * FROM " . $this->table_name . " ORDER BY prop_id";
        }
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
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (prop_name, prop_address_no, prop_address_moo, prop_address_road, prop_address_subdistrict, prop_address_district, prop_type_id, prop_municipal_id, prop_lat, prop_long, prop_detail_link, prop_thumbnail_img, prop_icon_type, prop_min_price, prop_max_price, prop_status, prop_created_date) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ssssssssssssssss', $this->prop_name, $this->prop_address_no, $this->prop_address_moo, $this->prop_address_road, $this->prop_address_subdistrict, $this->prop_address_district, $this->prop_type_id, $this->prop_municipal_id, $this->prop_lat, $this->prop_long, $this->prop_detail_link, $this->prop_thumbnail_img, $this->prop_icon_type, $this->prop_min_price, $this->prop_max_price, $this->prop_status, $this->prop_created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            return true;
        }else {
            return false;
        }
    }  // function create()

    // update record
    function update(){
        $query = "UPDATE " . $this->table_name . " SET prop_name = ?, prop_address_no = ?, prop_address_moo = ?, prop_address_road = ?, prop_address_subdistrict = ?, prop_address_district = ?, prop_type_id = ?, prop_municipal_id = ?, prop_lat = ?, prop_long = ?, prop_detail_link = ?, prop_thumbnail_img = ?, prop_icon_type = ?, prop_min_price = ?, prop_max_price = ?, prop_status = ?, prop_created_date = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'sssssssssssssssss', $this->prop_name, $this->prop_address, $this->prop_type_id, $this->prop_municipal_id, $this->prop_lat, $this->prop_long, $this->prop_detail_link, $this->prop_thumbnail_img, $this->prop_icon_type, $this->prop_min_price, $this->prop_max_price, $this->prop_status, $this->prop_created_date);

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
