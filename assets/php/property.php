<?php
class Property{

    // database connection and table name
    private $conn;
    private $table_name = "properties";
    private $last_prop_id;

    // object properties
    public $prop_id;
    public $prop_name;
    public $prop_address_no;
    public $prop_address_moo;
    public $prop_address_road;
    public $prop_address_subdistrict;
    public $prop_address_district;
    public $prop_municipal_id;
    public $prop_phone_no;
    public $prop_email;
    public $prop_lat;
    public $prop_long;
    public $prop_detail_link;
    public $prop_thumbnail_img;
    public $prop_icon_type;
    public $prop_status;
    public $prop_created_date;
    public $prop_updated_date;

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

    // create property data
    function create(){
        // prop_detail_link
        $this->prop_detail_link = "properties-detail.php";
        // prop_thumbnail_img
        $this->prop_thumbnail_img = "assets/img/properties/property-sample.jpg";
        /*
        Property Types:
        1-บ้านเดียว, 2-บ้านแฝด, 3-ทาวน์เฮาส์+ทาวน์โฮม, 4-คอนโดมิเนียม, 5-อาคารพานิชย์, 6-อื่นๆ
        */
        // prop_icon_type
        $this->prop_icon_type = "assets/img/property-types/single-family.png";
        // switch ($this->prop_type_id) {
        //     case 1:
        //         $this->prop_icon_type = "assets/img/property-types/single-family.png";
        //         break;
        //     case 2:
        //         $this->prop_icon_type = "assets/img/property-types/single-family.png";
        //         break;
        //     case 3:
        //         $this->prop_icon_type = "assets/img/property-types/villa.png";
        //         break;
        //     case 4:
        //         $this->prop_icon_type = "assets/img/property-types/condominium.png";
        //         break;
        //     case 5:
        //         $this->prop_icon_type = "assets/img/property-types/warehouse.png";
        //         break;
        //     default:
        //         $this->prop_icon_type = "assets/img/property-types/single-family.png";
        //         break;
        // }

        // write statement
        $stmt = mysqli_prepare($this->conn, "INSERT INTO " . $this->table_name . " (prop_name, prop_address_no, prop_address_moo, prop_address_road, prop_address_subdistrict, prop_address_district, prop_municipal_id, prop_phone_no, prop_email, prop_lat, prop_long, prop_detail_link, prop_thumbnail_img, prop_icon_type, prop_status, prop_created_date) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ssssssssssssssss', $this->prop_name, $this->prop_address_no, $this->prop_address_moo, $this->prop_address_road, $this->prop_address_subdistrict, $this->prop_address_district, $this->prop_municipal_id, $this->prop_phone_no, $this->prop_email, $this->prop_lat, $this->prop_long, $this->prop_detail_link, $this->prop_thumbnail_img, $this->prop_icon_type, $this->prop_status, $this->prop_created_date);

        /* execute prepared statement */
        if (mysqli_stmt_execute($stmt)) {
            $this->last_prop_id = mysqli_stmt_insert_id($stmt);
            return true;
        }else {
            return false;
        }
    }  // function create()

    // get last prop_id
    function getlastproperty_id(){
        return $this->last_prop_id;
    }

    // update record
    function update(){
        // prop_detail_link
        $this->prop_detail_link = "properties-detail.php";
        // prop_thumbnail_img
        $this->prop_thumbnail_img = "assets/img/properties/property-sample.jpg";
        /*Property Types:
        1-บ้านเดียว, 2-บ้านแฝด, 3-ทาวน์เฮาส์+ทาวน์โฮม, 4-คอนโดมิเนียม, 5-อาคารพานิชย์, 6-อื่นๆ
        */
        // prop_icon_type
        $this->prop_icon_type = "assets/img/property-types/single-family.png";
        // switch ($this->prop_type_id) {
        //     case 1:
        //         $this->prop_icon_type = "assets/img/property-types/single-family.png";
        //         break;
        //     case 2:
        //         $this->prop_icon_type = "assets/img/property-types/single-family.png";
        //         break;
        //     case 3:
        //         $this->prop_icon_type = "assets/img/property-types/villa.png";
        //         break;
        //     case 4:
        //         $this->prop_icon_type = "assets/img/property-types/condominium.png";
        //         break;
        //     case 5:
        //         $this->prop_icon_type = "assets/img/property-types/warehouse.png";
        //         break;
        //     default:
        //         $this->prop_icon_type = "assets/img/property-types/single-family.png";
        //         break;
        // }

        $query = "UPDATE " . $this->table_name . " SET prop_name = ?, prop_address_no = ?, prop_address_moo = ?, prop_address_road = ?, prop_address_subdistrict = ?, prop_address_district = ?, prop_municipal_id = ?, prop_phone_no = ?, prop_email = ?, prop_lat = ?, prop_long = ?, prop_detail_link = ?, prop_thumbnail_img = ?, prop_icon_type = ?, prop_status = ?, prop_updated_date = ? WHERE prop_id = ?";
        // statement
        $stmt = mysqli_prepare($this->conn, $query);
        // bind parameters
        mysqli_stmt_bind_param($stmt, 'ssssssssssssssssssss', $this->prop_name, $this->prop_address_no, $this->prop_address_moo, $this->prop_address_road, $this->prop_address_subdistrict, $this->prop_address_district, $this->prop_municipal_id, $this->prop_phone_no, $this->prop_email, $this->prop_lat, $this->prop_long, $this->prop_detail_link, $this->prop_thumbnail_img, $this->prop_icon_type, $this->prop_status, $this->prop_updated_date, $this->prop_id);

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

    // write data from mysql to json file
    function writejson() {
        // json filename
        $jsfile = "assets/js/locations.js";
        try {
            //write to json file
            $jsfp = fopen($jsfile, "w");
            fwrite($jsfp, "var locations = [\n");

            // read all records
            // $query = "SELECT * FROM " . $this->table_name . " ORDER BY prop_id";
            // $result = mysqli_query($this->conn, $query);
            $active = false;
            $result = $this->readall($active);
            $nor = mysqli_num_rows($result);
            $cnt = 0;
            while ($row = mysqli_fetch_array($result)) {
                $cnt++;
                $straddr = "";
                if (!empty($row['prop_address_no'])) {
                    $straddr .= $row['prop_address_no'] . " ";
                }
                if (!empty($row['prop_address_moo'])) {
                    $straddr .= "ม." . $row['prop_address_moo'] . " ";
                }
                if (!empty($row['prop_address_road'])) {
                    $straddr .= "ถ." . $row['prop_address_road'] . " ";
                }
                if (!empty($row['prop_address_subdistrict'])) {
                    $straddr .= "ต." . $row['prop_address_subdistrict'] . " ";
                }
                if (!empty($row['prop_address_district'])) {
                    $straddr .= "อ." . $row['prop_address_district'];
                }

                //$strdata = '[' . '"' . $row['prop_name'] . '", "' . $straddr . '", "' . '฿' . number_format($row['prop_min_price']) . '-' . '฿' .  number_format($row['prop_max_price']) . '", ' . $row['prop_lat'] . ', ' . $row['prop_long'] . ', "' . $row['prop_detail_link'] . '", "' . $row['prop_thumbnail_img'] . '", "' . $row['prop_icon_type'] . '"' . ']';

                $strdata = '[' . '"' . $row['prop_name'] . '", "' . $straddr . '", "' . '฿0' . '-' . '฿0'  . '", ' . $row['prop_lat'] . ', ' . $row['prop_long'] . ', "' . $row['prop_detail_link'] . '", "' . $row['prop_thumbnail_img'] . '", "' . $row['prop_icon_type'] . '"' . ']';

                if ($cnt == $nor) {
                     $strdata .= "\n];";
                 } else {
                     $strdata .= ",\n";
                 }
                fwrite($jsfp, $strdata);
            }
            fclose($jsfp);
            return true;
        } catch (Exception $e) {
            return false;
        }

    }
}

?>
