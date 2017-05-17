<?php
/**
 *
 */
class Property_detail
{
    // database connection and table name
    private $conn;
    private $table_name = "property_details";

    // object properties
    public $prop_id;
    public $prop_type_id;
    public $units_total;
    public $units_sold;
    public $units_sold_avg;
    public $units_unsold;
    public $time_unsold_avg;
    public $units_new_6m;
    public $prop_min_price;
    public $prop_max_price;

    // default constructor
    function __construct($db)
    {
      $this->conn = $db;
    }

    // read one property
    function readone(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE prop_id = " . $this->prop_id;
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    // create property_details data
    function create(){

    }

    // update property_details data
    function update(){

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
