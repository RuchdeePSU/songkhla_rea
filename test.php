<?php
    session_start();

    if (!isset($_SESSION['email'])) {
        header("Location: index.php");
    }

    include_once 'assets/php/dbconnect.php';
    include_once 'assets/php/property.php';
    include_once 'assets/php/property_municipal.php';
    include_once 'assets/php/property_type.php';

    // get connection
    $database = new Database();
    $db = $database->getConnection();

    $active = true;

    // pass connection to property_municipal tabel
    $prop_municipal = new Property_municipal($db);
    $result_municipal = $prop_municipal->readall($active);

    // pass connection to property_type table
    $prop_type = new Property_type($db);
    $result_type = $prop_type->readall($active);

    // form is submitted
    if (isset($_POST['property-submit'])) {
        // pass connection to property_types table
        $property = new Property($db);
        $property->prop_name = $_POST['property-title'];
        $property->prop_address_no = $_POST['property-address-no'];
        $property->prop_address_moo = $_POST['property-address-moo'];
        $property->prop_address_road = $_POST['property-address-road'];
        $property->prop_address_subdistrict = $_POST['property-subdistrict'];
        $property->prop_address_district = $_POST['property-district'];
        $property->prop_type_id = $_POST['property-type'];
        $property->prop_municipal_id = $_POST['property_municipal'];
        $property->prop_lat = $_POST['latitude'];
        $property->prop_long = $_POST['longitude'];
        $property->prop_min_price = $_POST['property-min-price'];
        $property->prop_max_price = $_POST['property-max-price'];
        $property->prop_status = $_POST['property-status'];
        $property->prop_created_date = date("Y/m/d");

        // insert
        if ($property->create()) {
            $success = true;
        } else {
            $success = false;
        }
    }

?>


<!DOCTYPE html>

<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="ThemeStarz">

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
    <link href="assets/fonts/font-awesome.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="assets/css/jquery.slider.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/fileinput.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pridi:300,400">
    <style>
        h1, h2, h3, h4, h5, h6, legend, a, .btn, label, .geo-location, ul { font-family: 'Pridi', serif; }
    </style>

    <title>Zoner | About Us</title>

</head>

<body class="page-sub-page page-about-us" id="page-top">

    <div class="container"><br/>
    <div class="form-group">
    <div class="checkbox switch">
      <label data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
        <input type="checkbox"/> A checkbox
      </label>
    </div>
    </div>
    <div id="collapseOne" aria-expanded="false" class="collapse">
    <div class="well">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe ut molestias eius, nam neque esse eos modi corrupti harum fugit, hic recusandae praesentium, minima ipsa eligendi architecto at! Culpa, explicabo.</div>
    </div>
    <div class="form-group">
    <div class="checkbox">
      <label data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <input type="checkbox" checked/> Another checkbox
      </label>
    </div>
    </div>
    <div id="collapseTwo" aria-expanded="true" class="collapse in">
    <div class="well">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe ut molestias eius, nam neque esse eos modi corrupti harum fugit, hic recusandae praesentium, minima ipsa eligendi architecto at! Culpa, explicabo.</div>
    </div>
    </div>

    <!-- Wrapper -->
    <div class="wrapper">
        <!-- Navigation -->
        <div class="navigation">
            <div class="container">
              <header class="navbar" id="top" role="banner">
                  <div class="navbar-header">
                      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>
                      <div class="navbar-brand nav" id="brand">
                          <!--
                          <a href="index-google-map-fullscreen.html"><img src="assets/img/logo.png" alt="brand"></a>
                        -->
                          <legend>
                            โครงการสำรวจอุปทานที่อยู่อาศัยเพื่อจัดแผนที่เบื้องต้น
                          </legend>
                      </div>
                  </div>
                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                      <ul class="nav navbar-nav">
                          <li><a href="index.php">หน้าแรก</a></li>
                          <li><a href="#">ความเป็นมาของโครงการ</a></li>
                          <li><a href="#">ติดต่อ</a></li>
                          <?php
                              if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == "admin") {
                                echo "<li class='active'><a href='#'>จัดการข้อมูล</a></li>";
                              } else {
                                // menu for typical user
                              }
                          ?>
                          <?php
                              if (isset($_SESSION['email']) && isset($_SESSION['name'])) {
                                  echo "<li>" . $_SESSION['name'] . "<a href='assets/php/sign-out.php'>[ออกจากระบบ]</a></li>";
                              } else {
                                  echo "<li><a href='sign-in.php'>ลงชื่อเข้าใช้</a></li>";
                              }
                          ?>
                      </ul>
                  </nav><!-- /.navbar collapse-->
                  <!-- <div class="add-your-property">
                      <a href="#" class="btn btn-default"><i class="fa fa-plus"></i><span class="text">เพิ่มประเภทอสังหาริมทรัพย์</span></a>
                  </div> -->
              </header><!-- /.navbar -->
            </div><!-- /.container -->
        </div><!-- /.navigation -->
        <!-- end Navigation -->
        <!-- Page Content -->
        <div id="page-content">
            <!-- Breadcrumb -->
            <div class="container">
                <ol class="breadcrumb">
                  <li>หน้าแรก</li>
                  <li>จัดการข้อมูล</li>
                  <li class="active">ข้อมูลโครงการ</li>
                </ol>
            </div>
            <!-- end Breadcrumb -->

            <div class="container">
                <div class="row">
                <!-- sidebar -->
                <div class="col-md-3 col-sm-2">
                    <section id="sidebar">
                        <header><h3>ประเภทข้อมูล</h3></header>
                        <aside>
                            <ul class="sidebar-navigation">
                              <li><a href="profile.php"><i class="fa fa-user"></i><span>ข้อมูลผู้ใช้งาน</span></a></li>
                              <li><a href="property-types-listing.php"><i class="fa fa-list"></i><span>ข้อมูลประเภทอสังหาริมทรัพย์</span></a></li>
                              <li><a href="property-municipals-listing.php"><i class="fa fa-list"></i><span>ข้อมูลเทศบาล</span></a></li>
                              <li class="active"><a href="properties-listing.php"><i class="fa fa-home"></i><span>ข้อมูลโครงการ</span></a></li>
                            </ul>
                        </aside>
                    </section><!-- /#sidebar -->
                </div><!-- /.col-md-3 -->
                <!-- end Sidebar -->
                    <!-- My Properties -->
                    <div class="col-md-9 col-sm-10">
                        <section id="my-properties">
                            <header><h1>โครงการอสังหาริมทรัพย์</h1></header>
                            <div class="my-properties">
                              <form role="form" id="property-municipals" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                                  <div class="row">
                                    <div class="col-md-8 col-sm-8">
                                        <div class="form-group">
                                            <label for="property-title">ชื่อโครงการ</label>
                                            <input type="text" class="form-control" id="property-title" name="property-title" placeholder="ใส่ชื่อโครงการ" required>
                                        </div><!-- /.form-group -->
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                      <div class="form-group">
                                          <label for="property-type">ประเภทโครงการ</label>
                                          <select id="property-type" name="property-type">
                                              <?php while ($row_municipal = mysqli_fetch_array($result_type)) {
                                                  echo "<option value='" . $row_municipal['prop_type_id'] . "'>" . $row_municipal['prop_type_desc'] . "</option>";
                                              } ?>
                                          </select>
                                      </div><!-- /.form-group -->
                                    </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-3 col-sm-3">
                                          <div class="form-group">
                                              <label for="property-address-no">สถานที่ตั้ง เลขที่</label>
                                              <input type="text" class="form-control" id="property-address-no" name="property-address-no">
                                          </div><!-- /.form-group -->
                                      </div><!-- /.col-md-3 -->
                                      <div class="col-md-1 col-sm-1">
                                          <div class="form-group">
                                              <label for="property-address-moo">หมู่</label>
                                              <input type="text" class="form-control" id="property-address-moo" name="property-address-moo">
                                          </div><!-- /.form-group -->
                                      </div><!-- /.col-md-2 -->
                                      <div class="col-md-4 col-sm-4">
                                          <div class="form-group">
                                              <label for="property-address-road">ถนน</label>
                                              <input type="text" class="form-control" id="property-address-road" name="property-address-road">
                                          </div><!-- /.form-group -->
                                      </div><!-- /.col-md-3 -->
                                      <div class="col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label for="property-municipal">เทศบาลที่ตั้งโครงการ</label>
                                            <select name="property_municipal" id="property-municipal">
                                                <?php while ($row_municipal = mysqli_fetch_array($result_municipal)) {
                                                    echo "<option value='" . $row_municipal['prop_municipal_id'] . "'>" . $row_municipal['prop_municipal_desc'] . "</option>";
                                                } ?>
                                            </select>
                                        </div><!-- /.form-group -->
                                      </div><!-- /.col-md-4 -->
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                      <div class="form-group">
                                          <label for="property-subdistrict">ตำบล</label>
                                          <input type="text" class="form-control" id="property-subdistrict" name="property-subdistrict">
                                      </div><!-- /.form-group -->
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                      <div class="form-group">
                                          <label for="property-district">อำเภอ</label>
                                          <input type="text" class="form-control" id="property-district" name="property-district">
                                      </div><!-- /.form-group -->
                                    </div>
                                    <div class="col-md-offset-4 col-sm-offset-4">
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label for="property-min-price">ราคาจำหน่ายต่ำสุด</label>
                                            <div class="input-group">
                                              <span class="input-group-addon">฿</span>
                                              <input type="number" class="form-control" id="property-min-price" name="property-min-price" pattern="\d*" placeholder="0">
                                            </div>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-md-4 -->
                                    <div class="col-md-4 col-sm-4">
                                        <div class="form-group">
                                            <label for="property-max-price">ราคาจำหน่ายสูงสุด</label>
                                            <div class="input-group">
                                              <span class="input-group-addon">฿</span>
                                              <input type="number" class="form-control" id="property-max-price" name="property-max-price" pattern="\d*" placeholder="0">
                                            </div>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-md-4 -->
                                    <div class="col-md-4 col-sm-4">
                                      <div class="form-group">
                                          <label for="property-status">สถานะการใช้งาน</label>
                                          <select name="property-status" id="property-status">
                                              <option value="1" selected>ใช้งานปกติ</option>
                                              <option value="0">ยกเลิกการใช้งาน</option>
                                          </select>
                                      </div><!-- /.form-group -->
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                      <section>
                                          <div class="block clearfix">
                                              <section id="place-on-map">
                                                  <label for="address-map">กำหนดตำแหน่งบนแผนที่</label>
                                                  <div id="submit-map"></div>
                                                  <div class="row">
                                                      <div class="col-md-5 col-sm-5">
                                                          <div class="form-group">
                                                              <input type="text" class="form-control" id="latitude" name="latitude">
                                                          </div><!-- /.form-group -->
                                                      </div>
                                                      <div class="col-md-5 col-sm-5">
                                                          <div class="form-group">
                                                              <input type="text" class="form-control" id="longitude" name="longitude">
                                                          </div><!-- /.form-group -->
                                                      </div>
                                                      <div class="col-md-2 col-sm-2">
                                                        <span class="link-arrow geo-location">ตำแหน่งปัจจุบัน</span>
                                                      </div>
                                                  </div>
                                              </section><!-- /#place-on-map -->
                                          </div><!-- /.block -->
                                      </section>
                                    </div>
                                  </div><!-- /.row -->
                                  <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                      <section id="add-property-type">
                                        <header><h2>ประเภทโครงการ</h2></header>
                                      </section>
                                          <div class="table-responsive">
                                              <table class="table">
                                                  <thead>
                                                  <tr>
                                                      <th>ประเภทโครงการ</th>
                                                      <th>ราคาจำหน่ายต่ำสุด</th>
                                                      <th>ราคาจำหน่ายสูงสุด</th>
                                                      <th>ราคาจำหน่ายต่ำสุด</th>
                                                      <th>ราคาจำหน่ายต่ำสุด</th>
                                                  </tr>
                                                  </thead>
                                                  <tbody>
                                                  <tr>
                                                      <td><div class="checkbox switch" id="checkbox-property-type">
                                                          <input type="checkbox" id="property-type-desc" name="property-type-desc">
                                                          <label for="property-type-desc">บ้านเดี่ยว</label>
                                                      </div></td>
                                                      <td><div class="input-group">
                                                        <input type="number" class="form-control" id="property-min-price" name="property-min-price" pattern="\d*" placeholder="0">
                                                      </div>
                                                      </td>
                                                      <td><div class="input-group">
                                                        <input type="number" class="form-control" id="property-min-price" name="property-min-price" pattern="\d*" placeholder="0">
                                                      </div>

                                                      </td>
                                                      <td><div class="input-group">
                                                        <input type="number" class="form-control" id="property-min-price" name="property-min-price" pattern="\d*" placeholder="0">
                                                      </div></td>
                                                      <td><div class="input-group">
                                                        <input type="number" class="form-control" id="property-min-price" name="property-min-price" pattern="\d*" placeholder="0">
                                                      </div>

                                                      </td>

                                                  </tr>
                                                  </tbody>
                                              </table>
                                          </div><!-- /.table-responsive -->
                                    </div>
                                  </div>

                                  <div class="form-group">
                              <div class="checkbox switch">
                                <label data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                  <input type="checkbox"/> A checkbox
                                </label>
                              </div>
                            </div>
                            <div id="collapseOne" aria-expanded="false" class="collapse">
                              <div class="well">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe ut molestias eius, nam neque esse eos modi corrupti harum fugit, hic recusandae praesentium, minima ipsa eligendi architecto at! Culpa, explicabo.</div>
                            </div>
                            <div class="form-group">
                              <div class="checkbox">
                                <label data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                  <input type="checkbox" checked/> Another checkbox
                                </label>
                              </div>
                            </div>
                            <div id="collapseTwo" aria-expanded="true" class="collapse in">
                              <div class="well">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe ut molestias eius, nam neque esse eos modi corrupti harum fugit, hic recusandae praesentium, minima ipsa eligendi architecto at! Culpa, explicabo.</div>
                            </div>


                                  <div class="row">
                                      <div class="col-md-3 col-sm-3">
                                          <div class="form-group">
                                              <div class="checkbox switch" id="checkbox-property-type">
                                                  <label for="property-type-desc">บ้านเดี่ยว</label>
                                                  <input type="checkbox" id="property-type-desc" name="property-type-desc">
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-offset-9 col-sm-offset-9">
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-md-4 col-sm-4">
                                          <div class="form-group">
                                              <label for="property-min-price">ราคาจำหน่ายต่ำสุด</label>
                                              <div class="input-group">
                                                <span class="input-group-addon">฿</span>
                                                <input type="number" class="form-control" id="property-min-price" name="property-min-price" pattern="\d*" placeholder="0">
                                              </div>
                                          </div><!-- /.form-group -->
                                      </div><!-- /.col-md-4 -->
                                      <div class="col-md-4 col-sm-4">
                                          <div class="form-group">
                                              <label for="property-max-price">ราคาจำหน่ายสูงสุด</label>
                                              <div class="input-group">
                                                <span class="input-group-addon">฿</span>
                                                <input type="number" class="form-control" id="property-max-price" name="property-max-price" pattern="\d*" placeholder="0">
                                              </div>
                                          </div><!-- /.form-group -->
                                      </div><!-- /.col-md-4 -->
                                      <div class="col-md-offset-4 col-sm-offset-4">
                                      </div>
                                  </div>


                                  <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                      <section class="block" id="gallery">
                                          <div class="center">
                                              <div class="form-group">
                                                  <input id="file-upload" type="file" class="file" multiple="true" data-show-upload="false" data-show-caption="false" data-show-remove="false" accept="image/jpeg,image/png" data-browse-class="btn btn-default" data-browse-label="เลือกรูปภาพ">
                                              </div>
                                          </div>
                                      </section>
                                      <hr />
                                    </div>
                                  </div><!-- /.row -->
                                  <div class="row">
                                      <div class="block">
                                          <div class="col-md-12 col-sm-12">
                                              <div class="center">
                                                  <div class="form-group">
                                                      <button type="submit" class="btn btn-default large" name="property-submit">บันทึกโครงการ</button>
                                                  </div><!-- /.form-group -->
                                                  <!--<figure class="note block">By clicking the “Proceed to Payment” or “Submit” button you agree with our <a href="terms-conditions.html">Terms and conditions</a></figure>-->
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </form>
                              <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="center-block">
                                        <?php
                                          if (isset($success)) {
                                              if ($success) {
                                                  echo "<div class='alert alert-success text-center'>บันทึกข้อมูลเรียบร้อยแล้ว</div>";
                                              } else {
                                                  echo "<div class='alert alert-danger text-center'>พบข้อผิดพลาด! ไม่สามารถบันทึกข้อมูลได้</div>";
                                              }
                                          }
                                        ?>
                                    </div>
                                </div>
                              </div>
                            </div><!-- /.my-properties -->
                        </section><!-- /#my-properties -->
                    </div><!-- /.col-md-9 -->
                    <!-- end My Properties -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div>
        <!-- end Page Content -->
        <!-- Page Footer -->
        <footer id="page-footer">
            <div class="inner">
                <aside id="footer-main">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <!-- <article>
                                    <h3>About Us</h3>
                                    <p>Vel fermentum ipsum. Suspendisse quis molestie odio. Interdum et malesuada fames ac ante ipsum
                                        primis in faucibus. Quisque aliquet a metus in aliquet. Praesent ut turpis posuere, commodo odio
                                        id, ornare tortor
                                    </p>
                                    <hr>
                                    <a href="#" class="link-arrow">Read More</a>
                                </article> -->
                            </div><!-- /.col-sm-3 -->
                            <div class="col-md-3 col-sm-3">
                            </div><!-- /.col-sm-3 -->
                            <div class="col-md-3 col-sm-3">
                                <article>
                                    <h3>Contact</h3>
                                </article>
                            </div><!-- /.col-sm-3 -->
                            <div class="col-md-3 col-sm-3">
                                <article>
                                    <h3>Useful Links</h3>
                                    <ul class="list-unstyled list-links">
                                        <li><a href="#">All Properties</a></li>
                                        <li><a href="#">Privacy Policy</a></li>
                                        <li><a href="#">Login and Register Account</a></li>
                                        <li><a href="#">FAQ</a></li>
                                        <li><a href="#">Terms and Conditions</a></li>
                                    </ul>
                                </article>
                            </div><!-- /.col-sm-3 -->
                        </div><!-- /.row -->
                    </div><!-- /.container -->
                </aside><!-- /#footer-main -->
                <aside id="footer-thumbnails" class="footer-thumbnails"></aside><!-- /#footer-thumbnails -->
                <aside id="footer-copyright">
                    <div class="container">
                        <span>Copyright © 2013. All Rights Reserved.</span>
                        <span class="pull-right"><a href="#page-top" class="roll">Go to top</a></span>
                    </div>
                </aside>
            </div><!-- /.inner -->
        </footer>
        <!-- end Page Footer -->
    </div>

    <script type="text/javascript" src="assets/js/waypoints.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.countTo.js"></script>


    <script type="text/javascript" src="assets/js/jquery-2.1.0.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery-migrate-1.2.1.min.js"></script>

    <script type="text/javascript" src="assets/js/markerwithlabel_packed.js"></script>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/smoothscroll.js"></script>
    <script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="assets/js/retina-1.1.0.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="assets/js/fileinput.min.js"></script>
    <script type="text/javascript" src="assets/js/custom-map.js"></script>
    <script type="text/javascript" src="assets/js/custom.js"></script>


</body>
</html>
