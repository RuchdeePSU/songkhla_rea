<?php
    include_once 'dbconnect.php';
    include_once 'admin.php';

    // get connection
    $database = new Database();
    $db = $database->getConnection();

    // pass connection to tbl_admin table
    $admin = new Admin($db);

    if (isset($_POST['email']) && isset($_POST['password'])) {
      $admin->email = $_POST['email'];

    }
?>
