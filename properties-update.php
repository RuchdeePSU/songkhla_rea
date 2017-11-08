<?php
    session_start();

    if (!isset($_SESSION['email'])) {
        header("Location: sign-in.php");
    }

    if (isset($_GET['property_id'])) {
        include_once 'assets/php/dbconnect.php';
        include_once 'assets/php/property.php';
        include_once 'assets/php/property_detail.php';
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
        $result_type2 = $prop_type->readall($active);
        $result_type3 = $prop_type->readall($active);
        $result_type4 = $prop_type->readall($active);

        // pass connection to property table
        $property = new Property($db);
        $property->prop_id = $_GET['property_id'];
        $result_prop = $property->readone();
        $row_prop = mysqli_fetch_array($result_prop);

        $property_detail = new Property_detail($db);
        $property_detail->prop_id = $_GET['property_id'];

        // form is submitted
        if (isset($_POST['property-submit'])) {
            if (!empty($_FILES['fileupload'])) {
                // get the files posted
                $images = $_FILES['fileupload'];
                // get file names
                $filenames = $images['name'];
                // file paths to store
                $paths= [];
                for($i=0; $i < count($filenames); $i++){
                    if ($filenames[$i] == '') {
                        $paths[] = $_POST['property-thumbnail'];
                    } else {
                        $ext = explode('.', basename($filenames[$i]));
                        $new_name = md5(uniqid()) . "." . array_pop($ext);
                        $target = "assets/img/properties" . DIRECTORY_SEPARATOR . $new_name;
                        if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                            $success = true;
                            $paths[] = $target;
                        } else {
                            $success = false;
                            break;
                        }
                    }
                }
            }

            $property->prop_name = $_POST['property-title'];
            $property->prop_address_no = $_POST['property-address-no'];
            $property->prop_address_moo = $_POST['property-address-moo'];
            $property->prop_address_road = $_POST['property-address-road'];
            $property->prop_address_subdistrict = $_POST['property-subdistrict'];
            $property->prop_address_district = $_POST['property-district'];
            $property->prop_municipal_id = $_POST['property_municipal'];
            $property->prop_phone_no = $_POST['property-phone-no'];
            $property->prop_email = $_POST['property-email'];
            $property->prop_lat = $_POST['latitude'];
            $property->prop_long = $_POST['longitude'];
            $property->prop_size1 = $_POST['property-size1'];
            $property->prop_size2 = $_POST['property-size2'];
            $property->prop_size3 = $_POST['property-size3'];
            $property->prop_regist_no = $_POST['property-regist-no'];
            $property->prop_owner_name = $_POST['property-owner'];
            $property->prop_membership = $_POST['property-membership'];
            $property->prop_corporation = $_POST['property-corporation'];
            $property->prop_started_date = $_POST['property-started-date'];
            $property->prop_contact_person = $_POST['property-contact-person'];
            $property->prop_website = $_POST['property-website'];
            $property->prop_thumbnail_img = $paths[0];
            $property->prop_youtube_link = $_POST['property-youtube'];
            $property->prop_status = $_POST['property-status'];
            $property->prop_updated_date = date("Y/m/d");

            // insert into properties table
            if ($property->update()) {
                // pass connection to property_details table
                $property_detail = new Property_detail($db);
                // get last prop_id
                $property_detail->prop_id = $_GET['property_id'];

                while ($row_type4 = mysqli_fetch_array($result_type4)) {
                    $property_detail->prop_type_id = $row_type4['prop_type_id'];
                    $property_detail->units_total = $_POST['units-total-' . $row_type4['prop_type_id']];
                    $property_detail->units_sold = $_POST['units-sold-' . $row_type4['prop_type_id']];
                    $property_detail->units_sold_avg = $_POST['units-sold-avg-' . $row_type4['prop_type_id']];
                    $property_detail->units_unsold = $_POST['units-unsold-' . $row_type4['prop_type_id']];
                    $property_detail->time_unsold_avg = $_POST['time-unsold-avg-' . $row_type4['prop_type_id']];
                    $property_detail->units_new_6m = $_POST['units-new-6m-' . $row_type4['prop_type_id']];
                    $property_detail->prop_min_price = $_POST['min-price-' . $row_type4['prop_type_id']];
                    $property_detail->prop_max_price = $_POST['max-price-' . $row_type4['prop_type_id']];

                    // insert into property_details table
                    if ($property_detail->update()) {
                        $success = true;
                        echo json_encode($success);
                        header("Location: properties-listing.php");
                    }else {
                        $success = false;
                        break;
                    }
                }
            } else {
                $success = false;
            }
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
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="assets/css/jquery.slider.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <!-- <link rel="stylesheet" href="assets/css/fileinput.min.css" type="text/css"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pridi:300,400">
    <style>
        h1, h2, h3, h4, h5, h6, legend, a, .btn, label, .geo-location, ul, input, address, figure { font-family: 'Pridi', serif; }
    </style>
    <title>โครงการสำรวจอุปทานที่อยู่อาศัยเพื่อจัดทำแผนที่เบื้องต้น | ข้อมูลโครงการ</title>

</head>

<body class="page-sub-page page-submit" id="page-top">
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
                      <a href="index.php"><img src="assets/img/main_logo.png" alt="brand"></a>
                      <!-- <legend>
                        โครงการสำรวจอุปทานที่อยู่อาศัยเพื่อจัดแผนที่เบื้องต้น
                      </legend> -->
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
                          <form role="form" id="properties" name="properties" method="post" action="<?php $_SERVER['PHP_SELF'] ?>" data-toggle="validator" enctype="multipart/form-data">
                              <div class="row">
                                <div class="col-md-8 col-sm-8">
                                    <div class="form-group">
                                      <label for="property-title">ชื่อโครงการ</label>
                                      <input type="text" class="form-control" id="property-title" name="property-title" placeholder="ใส่ชื่อโครงการ" data-error="กรุณใส่ชื่อโครงการ" value="<?php echo $row_prop['prop_name'] ?>" required>
                                      <div class="help-block with-errors"></div>
                                    </div><!-- /.form-group -->
                                </div>
                                <div class="col-md-4 col-sm-4">
                                  <div class="form-group">
                                      <label for="property-municipal">เทศบาลที่ตั้งโครงการ</label>
                                      <select name="property_municipal" id="property-municipal">
                                          <?php
                                            while ($row_municipal = mysqli_fetch_array($result_municipal)) {
                                              if ($row_prop['prop_municipal_id'] == $row_municipal['prop_municipal_id']) {
                                                echo "<option value='" . $row_municipal['prop_municipal_id'] . "' selected>" . $row_municipal['prop_municipal_desc'] . "</option>";
                                              } else {
                                                echo "<option value='" . $row_municipal['prop_municipal_id'] . "'>" . $row_municipal['prop_municipal_desc'] . "</option>";
                                              }
                                            }
                                          ?>
                                      </select>
                                  </div><!-- /.form-group -->
                                </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-3 col-sm-3">
                                      <div class="form-group">
                                          <label for="property-address-no">สถานที่ตั้ง เลขที่</label>
                                          <input type="text" class="form-control" id="property-address-no" name="property-address-no"  value="<?php echo $row_prop['prop_address_no'] ?>">
                                      </div><!-- /.form-group -->
                                  </div><!-- /.col-md-3 -->
                                  <div class="col-md-1 col-sm-1">
                                      <div class="form-group">
                                          <label for="property-address-moo">หมู่</label>
                                          <input type="text" class="form-control" id="property-address-moo" name="property-address-moo" maxlength="2" pattern="^[0-9]{1,}$" data-error="หมู่ที่ต้องเป็นตัวเลข"  value="<?php echo $row_prop['prop_address_moo'] ?>">
                                          <div class="help-block with-errors"></div>
                                      </div><!-- /.form-group -->
                                  </div><!-- /.col-md-2 -->
                                  <div class="col-md-4 col-sm-4">
                                      <div class="form-group">
                                          <label for="property-address-road">ถนน</label>
                                          <input type="text" class="form-control" id="property-address-road" name="property-address-road"  value="<?php echo $row_prop['prop_address_road'] ?>">
                                      </div><!-- /.form-group -->
                                  </div><!-- /.col-md-3 -->
                                  <div class="col-md-4 col-sm-4">
                                    <div class="form-group">
                                        <label for="property-subdistrict">ตำบล</label>
                                        <input type="text" class="form-control" id="property-subdistrict" name="property-subdistrict" maxlength="100"  value="<?php echo $row_prop['prop_address_subdistrict'] ?>">
                                    </div><!-- /.form-group -->
                                  </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4 col-sm-4">
                                  <div class="form-group">
                                      <label for="property-district">อำเภอ</label>
                                      <input type="text" class="form-control" id="property-district" name="property-district" maxlength="100"  value="<?php echo $row_prop['prop_address_district'] ?>">
                                  </div><!-- /.form-group -->
                                </div>
                                <div class="col-md-2 col-sm-2">
                                    <div class="form-group">
                                        <label for="property-size1">ขนาดพื้นที่ ไร่</label>
                                        <input type="number" class="form-control" id="property-size1" name="property-size1" min="0" placeholder="0" value="<?php echo $row_prop['prop_size1'] ?>">
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-md-3 -->
                                <div class="col-md-2 col-sm-2">
                                    <div class="form-group">
                                        <label for="property-size2">งาน</label>
                                        <input type="number" class="form-control" id="property-size2" name="property-size2" min="0" placeholder="0" value="<?php echo $row_prop['prop_size2'] ?>">
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-md-2 -->
                                <div class="col-md-2 col-sm-2">
                                    <div class="form-group">
                                        <label for="property-size3">ตร.วา</label>
                                        <input type="number" class="form-control" id="property-size3" name="property-size3" min="0" placeholder="0" value="<?php echo $row_prop['prop_size3'] ?>">
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-md-3 -->
                                <div class="col-md-2 col-sm-2">
                                  <div class="form-group">
                                      <label for="property-regist-no">เลขที่ใบอนุญาต</label>
                                      <input type="text" class="form-control" id="property-regist-no" name="property-regist-no" maxlength="30" value="<?php echo $row_prop['prop_regist_no'] ?>">
                                  </div><!-- /.form-group -->
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-8 col-sm-8">
                                  <div class="form-group">
                                      <label for="property-owner">ชื่อผู้ประกอบการเจ้าของโครงการ</label>
                                      <input type="text" class="form-control" id="property-owner" name="property-owner"  maxlength="100" value="<?php echo $row_prop['prop_owner_name'] ?>">
                                  </div><!-- /.form-group -->
                                </div>
                                <div class="col-md-4 col-sm-4">
                                  <div class="form-group">
                                      <label for="property-membership">สถานะสมาชิก</label>
                                      <select name="property-membership" id="property-membership">
                                          <option value="1" <?php if ($row_prop['prop_membership']) {
                                            echo "selected";
                                          } ?>>เป็นสมาชิกสมาคมอสังหาริมทรัพย์</option>
                                          <option value="0" <?php if (!$row_prop['prop_membership']) {
                                            echo "selected";
                                          } ?>>ไม่เป็นสมาชิกสมาคมอสังหาริมทรัพย์</option>
                                      </select>
                                  </div><!-- /.form-group -->
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4 col-sm-4">
                                  <div class="form-group">
                                      <label for="property-corporation">ชื่อนิติบุคคลบริหารโครงการ</label>
                                      <input type="text" class="form-control" id="property-corporation" name="property-corporation" maxlength="100" value="<?php echo $row_prop['prop_corporation'] ?>">
                                  </div><!-- /.form-group -->
                                </div>
                                <div class="col-md-4 col-sm-4">
                                  <div class="form-group">
                                      <label for="property-started-date">วันที่เริ่มดำเนินโครงการ</label>
                                      <input type="date" class="form-control" id="property-started-date" name="property-started-date" value="<?php echo $row_prop['prop_started_date'] ?>">
                                  </div><!-- /.form-group -->
                                </div>
                                <div class="col-md-4 col-sm-4">
                                  <div class="form-group">
                                      <label for="property-contact-person">ชื่อ-สกุลผู้ติดต่อของโครงการ</label>
                                      <input type="text" class="form-control" id="property-contact-person" name="property-contact-person"  maxlength="100" value="<?php echo $row_prop['prop_contact_person'] ?>">
                                  </div><!-- /.form-group -->
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4 col-sm-4">
                                  <div class="form-group">
                                      <label for="property-district">เบอร์โทรศัพท์</label>
                                      <input type="tel" class="form-control" id="property-phone-no" name="property-phone-no" pattern="^[0-9]{1,}$" data-error="เบอร์โทรศัพท์ต้องเป็นตัวเลข" maxlength="30"  value="<?php echo $row_prop['prop_phone_no'] ?>">
                                      <div class="help-block with-errors"></div>
                                  </div><!-- /.form-group -->
                                </div>
                                <div class="col-md-4 col-sm-4">
                                  <div class="form-group">
                                      <label for="property-district">อีเมล</label>
                                      <input type="email" class="form-control" id="property-email" name="property-email" data-error="อีเมลไม่ถูกต้อง" maxlength="50"  value="<?php echo $row_prop['prop_email'] ?>">
                                      <div class="help-block with-errors"></div>
                                  </div><!-- /.form-group -->
                                </div>
                                <div class="col-md-4 col-sm-4">
                                  <div class="form-group">
                                      <label for="property-website">เว็บไซต์ของโครงการ</label>
                                      <input type="text" class="form-control" id="property-website" name="property-website" maxlength="50" value="<?php echo $row_prop['prop_website'] ?>">
                                  </div><!-- /.form-group -->
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4 col-sm-4">
                                  <div class="form-group">
                                      <label for="property-status">สถานะการแสดงข้อมูล</label>
                                      <select name="property-status" id="property-status">
                                          <option value="1" <?php if ($row_prop['prop_status']) {
                                            echo "selected";
                                          } ?>>อนุญาตให้แสดงข้อมูล</option>
                                          <option value="0" <?php if (!$row_prop['prop_status']) {
                                            echo "selected";
                                          } ?>>ไม่อนุญาตให้แสดงข้อมูล</option>
                                      </select>
                                  </div><!-- /.form-group -->
                                </div>
                                <div class="col-md-offset-8 col-sm-offet-8">
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
                                                          <input type="text" maxlength="20"  class="form-control" id="latitude" name="latitude" data-error="กรุณาใส่ตำแหน่งละติจูด"  value="<?php echo $row_prop['prop_lat'] ?>" required>
                                                          <div class="help-block with-errors"></div>
                                                      </div><!-- /.form-group -->
                                                  </div>
                                                  <div class="col-md-5 col-sm-5">
                                                      <div class="form-group">
                                                          <input type="text" maxlength="20" class="form-control" id="longitude" name="longitude" data-error="กรุณาใส่ตำแหน่งลองจิจูด"  value="<?php echo $row_prop['prop_long'] ?>" required>
                                                          <div class="help-block with-errors"></div>
                                                      </div><!-- /.form-group -->
                                                  </div>
                                                  <div class="col-md-2 col-sm-2">
                                                    <div class="center-block">
                                                        <span class="link-arrow geo-location">ตำแหน่งปัจจุบัน</span>
                                                    </div>

                                                  </div>
                                              </div>
                                          </section><!-- /#place-on-map -->
                                      </div><!-- /.block -->
                                  </section>
                                </div>
                              </div><!-- /.row -->
                              <div class="row">
                                <div class="col-md-12 col-sm-12">
                                  <section id="property-type-details">
                                      <header><h2>ประเภทโครงการ</h2></header>
                                      <ul class="nav nav-pills">
                                        <?php
                                            $cnt = 0;
                                            while ($row_type2 = mysqli_fetch_array($result_type2)) {
                                                $cnt += 1;
                                                if ($cnt == 1) {
                                                    echo "<li class='active'><a data-toggle='pill' href='#tab" . $row_type2['prop_type_id'] . "'>" . $row_type2['prop_type_desc'] . "</a></li>";
                                                } else {
                                                    echo "<li><a data-toggle='tab' href='#tab" . $row_type2['prop_type_id'] . "'>" . $row_type2['prop_type_desc'] . "</a></li>";
                                                }
                                            }
                                        ?>
                                      </ul>
                                      <div class="tab-content">
                                        <?php $cnt = 0; ?>
                                        <?php while ($row_type3 = mysqli_fetch_array($result_type3)) { ?>
                                            <?php
                                                $cnt++;
                                                $property_detail->prop_type_id = $row_type3['prop_type_id'];
                                                $result_prop_detail = $property_detail->readone();
                                                $row_prop_detail = mysqli_fetch_array($result_prop_detail);
                                            ?>
                                            <div id="<?php echo "tab" . $row_type3['prop_type_id']; ?>" class="<?php if ($cnt == 1) {
                                                    echo "tab-pane fade in active";
                                                } else {
                                                    echo "tab-pane fade";
                                                } ?>">
                                              <div class="row"><br />
                                                <div class="col-md-3 col-sm-3">
                                                    <div class="form-group">
                                                        <label for="<?php echo "units-total-" . $row_type3['prop_type_id']; ?>">จำนวนยูนิตทั้งหมดของโครงการ</label>
                                                        <div class="input-group">
                                                          <span class="input-group-addon"><i class="glyphicon glyphicon-stats"></i></span>
                                                          <input type="number" class="form-control" id="<?php echo "units-total-" . $row_type3['prop_type_id']; ?>" name="<?php echo "units-total-" . $row_type3['prop_type_id']; ?>" pattern="\d*" placeholder="0" value="<?php echo $row_prop_detail['units_total']; ?>">
                                                        </div>
                                                    </div><!-- /.form-group -->
                                                </div><!-- /.col-md-4 -->
                                                <div class="col-md-3 col-sm-3">
                                                    <div class="form-group">
                                                        <label for="<?php echo "units-sold-" . $row_type3['prop_type_id']; ?>">จำนวนยูนิตที่จำหน่ายแล้ว</label>
                                                        <div class="input-group">
                                                          <span class="input-group-addon"><i class="glyphicon glyphicon-stats"></i></span>
                                                          <input type="number" class="form-control" id="<?php echo "units-sold-" . $row_type3['prop_type_id']; ?>" name="<?php echo "units-sold-" . $row_type3['prop_type_id']; ?>" pattern="\d*" placeholder="0" value="<?php echo $row_prop_detail['units_sold']; ?>">
                                                        </div>
                                                    </div><!-- /.form-group -->
                                                </div><!-- /.col-md-4 -->
                                                <div class="col-md-3 col-sm-3">
                                                  <div class="form-group">
                                                      <label for="<?php echo "units-sold-avg-" . $row_type3['prop_type_id']; ?>">จำนวนยูนิตที่จำหน่ายเฉลี่ย/เดือน</label>
                                                      <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-stats"></i></span>
                                                        <input type="number" class="form-control" id="<?php echo "units-sold-avg-" . $row_type3['prop_type_id']; ?>" name="<?php echo "units-sold-avg-" . $row_type3['prop_type_id']; ?>" pattern="\d*" placeholder="0" value="<?php echo $row_prop_detail['units_sold_avg']; ?>">
                                                    </div>
                                                  </div><!-- /.form-group -->
                                                </div>
                                                <div class="col-md-3 col-sm-3">
                                                  <div class="form-group">
                                                      <label for="<?php echo "units-unsold-" . $row_type3['prop_type_id']; ?>">จำนวนยูนิตคงค้าง ณ ปัจจุบัน</label>
                                                      <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-stats"></i></span>
                                                        <input type="number" class="form-control" id="<?php echo "units-unsold-" . $row_type3['prop_type_id']; ?>" name="<?php echo "units-unsold-" . $row_type3['prop_type_id']; ?>" pattern="\d*" placeholder="0" value="<?php echo $row_prop_detail['units_unsold']; ?>">
                                                    </div>
                                                  </div><!-- /.form-group -->
                                                </div>
                                              </div>
                                              <div class="row">
                                                <div class="col-md-3 col-sm-3">
                                                    <div class="form-group">
                                                        <label for="<?php echo "time-unsold-avg-" . $row_type3['prop_type_id']; ?>">ระยะเวลาคงค้างเฉลี่ย (เดือน)</label>
                                                        <div class="input-group">
                                                          <span class="input-group-addon"><i class="glyphicon glyphicon-stats"></i></span>
                                                          <input type="number" class="form-control" id="<?php echo "time-unsold-avg-" . $row_type3['prop_type_id']; ?>" name="<?php echo "time-unsold-avg-" . $row_type3['prop_type_id']; ?>" pattern="\d*" placeholder="0" value="<?php echo $row_prop_detail['time_unsold_avg']; ?>">
                                                        </div>
                                                    </div><!-- /.form-group -->
                                                </div><!-- /.col-md-4 -->
                                                <div class="col-md-3 col-sm-3">
                                                    <div class="form-group">
                                                        <label for="<?php echo "units-new-6m-" . $row_type3['prop_type_id']; ?>">จำนวนยูนิตที่จะสร้างเพิ่ม (6 เดือน)</label>
                                                        <div class="input-group">
                                                          <span class="input-group-addon"><i class="glyphicon glyphicon-stats"></i></span>
                                                          <input type="number" class="form-control" id="<?php echo "units-new-6m-" . $row_type3['prop_type_id']; ?>" name="<?php echo "units-new-6m-" . $row_type3['prop_type_id']; ?>" pattern="\d*" placeholder="0" value="<?php echo $row_prop_detail['units_new_6m']; ?>">
                                                        </div>
                                                    </div><!-- /.form-group -->
                                                </div><!-- /.col-md-4 -->
                                                <div class="col-md-3 col-sm-3">
                                                  <div class="form-group">
                                                      <label for="<?php echo "min-price-" . $row_type3['prop_type_id']; ?>">ราคาจำหน่ายต่ำสุด</label>
                                                      <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                                        <input type="number" class="form-control" id="<?php echo "min-price-" . $row_type3['prop_type_id']; ?>" name="<?php echo "min-price-" . $row_type3['prop_type_id']; ?>" pattern="\d*" placeholder="0" value="<?php echo $row_prop_detail['prop_min_price']; ?>">
                                                    </div>
                                                  </div><!-- /.form-group -->
                                                </div>
                                                <div class="col-md-3 col-sm-3">
                                                  <div class="form-group">
                                                      <label for="<?php echo "max-price-" . $row_type3['prop_type_id']; ?>">ราคาจำหน่ายสูงสุด</label>
                                                      <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                                        <input type="number" class="form-control" id="<?php echo "max-price-" . $row_type3['prop_type_id']; ?>" name="<?php echo "max-price-" . $row_type3['prop_type_id']; ?>" pattern="\d*" placeholder="0" value="<?php echo $row_prop_detail['prop_max_price']; ?>">
                                                    </div>
                                                  </div><!-- /.form-group -->
                                                </div>
                                              </div><hr />
                                            </div>
                                        <?php } ?>
                                      </div>
                                  </section>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-12 col-sm-12">
                                  <section class="block" id="gallery">
                                      <header><h2>เพิ่มรูปภาพของโครงการ</h2></header>
                                      <div class="center">
                                          <div class="form-group">
                                              <label for="fileupload">ไฟล์รูปภาพของโครงการควรมีขนาด 440x330 </label>
                                              <!-- <input id="file-upload" name="file-upload" type="file" class="file" data-show-upload="false" data-show-caption="false" data-show-remove="false" accept="image/jpeg,image/png" data-browse-class="btn btn-default" data-browse-label="เลือกรูปภาพ"> -->
                                              <div class="file-loading">
                                                  <input id="fileupload" name="fileupload[]" type="file">
                                              </div>
                                              <input id="property-thumbnail" name="property-thumbnail" type="hidden" value="<?php echo $row_prop['prop_thumbnail_img'] ?>" />
                                          </div>
                                      </div>
                                  </section>
                                  <hr />
                                </div>
                              </div><!-- /.row -->

                              <div class="row">
                                  <div class="col-md-10 col-sm-10">
                                      <header><h2>เพิ่มวิดีโอของโครงการ</h2></header>
                                      <div class="form-group">
                                          <label>ตัวอย่างลิงค์วิดีโอจาก youtube: https://www.youtube.com/embed/oI1gIfpEyXI</label>
                                          <input type="text" class="form-control" id="property-youtube" name="property-youtube" placeholder="ลิงค์วิดีโอของโครงการ" value="<?php echo $row_prop['prop_youtube_link'] ?>">
                                      </div><!-- /.form-group -->
                                  </div>
                                  <div class="col-md-offset-2 col-sm-offset-2">
                                  </div>
                              </div><!-- /.row -->
                              <hr />

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
                                <h3>ติดต่อ</h3>
                                <address>
                                    <strong>ศูนย์บริการวิชาการ</strong><br>
                                    อาคารสำนักทรัพยากรการเรียนรู้ฯ (LRC1)<br />
                                    ชั้น 10 มหาวิทยาลัยสงขลานครินทร์<br />
                                    เลขที่ 15 ถ.กาญจนวณิชย์<br />
                                    อ.หาดใหญ่ จ.สงขลา 90110<br />
                                    0-7428-6972-4
                                </address>
                            </article>
                        </div><!-- /.col-sm-3 -->
                        <div class="col-md-3 col-sm-3">
                            <article>
                                <h3>ลิงค์ที่เกี่ยวข้อง</h3>
                                <ul class="list-unstyled list-links">
                                    <li><a href="http://www.songkhlarea.org/frontpage" target="_blank">สมาคมอสังหาริมทรัพย์จังหวัดสงขลา</a></li>
                                    <li><a href="http://www.psu.ac.th/" target="_blank">มหาวิทยาลัยสงขลานครินทร์</a></li>
                                    <li><a href="http://www.outreach.psu.ac.th/" target="_blank">ศูนย์บริการวิชาการ มหาวิทยาลัยสงขลานครินทร์</a></li>
                                    <li><a href="http://www.fms.psu.ac.th/" target="_blank">คณะวิทยาการจัดการ มหาวิทยาลัยสงขลานครินทร์</a></li>
                                </ul>
                            </article>
                        </div><!-- /.col-sm-3 -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </aside><!-- /#footer-main -->
            <aside id="footer-thumbnails" class="footer-thumbnails"></aside><!-- /#footer-thumbnails -->
            <aside id="footer-copyright">
                <div class="container">
                    <span>Copyright © 2017 Songkhla Real Estate Association. All Rights Reserved.</span>
                    <span class="pull-right"><a href="#page-top" class="roll">Go to top</a></span>
                </div>
            </aside>
        </div><!-- /.inner -->
    </footer>
    <!-- end Page Footer -->
</div>

<script type="text/javascript" src="assets/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyCI9elmy3zkfLaXKTjO8rp8h9sZ1JPQD3o"></script>
<script type="text/javascript" src="assets/js/markerwithlabel_packed.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/smoothscroll.js"></script>
<script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<!--
<script type="text/javascript" src="assets/js/icheck.min.js"></script>
-->
<script type="text/javascript" src="assets/js/retina-1.1.0.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.magnific-popup.min.js"></script>
<!-- <script type="text/javascript" src="assets/js/fileinput.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/fileinput.min.js"></script>
<script type="text/javascript" src="assets/js/custom-map.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
<script type="text/javascript" src="assets/js/validator.min.js"></script>
<script>
    // _latitude = 7.006474666769294;
    // _longitude = 100.47486183575438;

    _latitude = <?php echo $row_prop['prop_lat']; ?>;
    _longitude = <?php echo $row_prop['prop_long']; ?>;

    google.maps.event.addDomListener(window, 'load', initSubmitMap(_latitude,_longitude));
    function initSubmitMap(_latitude,_longitude){
        var mapCenter = new google.maps.LatLng(_latitude,_longitude);
        var mapOptions = {
            zoom: 14,
            center: mapCenter,
            disableDefaultUI: false,
            //scrollwheel: false,
            styles: mapStyles
        };
        var mapElement = document.getElementById('submit-map');
        var map = new google.maps.Map(mapElement, mapOptions);
        var marker = new MarkerWithLabel({
            position: mapCenter,
            map: map,
            icon: 'assets/img/marker.png',
            labelAnchor: new google.maps.Point(50, 0),
            draggable: true
        });
        $('#submit-map').removeClass('fade-map');
        google.maps.event.addListener(marker, "mouseup", function (event) {
            var latitude = this.position.lat();
            var longitude = this.position.lng();
            $('#latitude').val( this.position.lat() );
            $('#longitude').val( this.position.lng() );
        });

//      Autocomplete
        var input = /** @type {HTMLInputElement} */( document.getElementById('address-map') );
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
            $('#latitude').val( marker.getPosition().lat() );
            $('#longitude').val( marker.getPosition().lng() );
            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }
        });

    }

    function success(position) {
        initSubmitMap(position.coords.latitude, position.coords.longitude);
        $('#latitude').val( position.coords.latitude );
        $('#longitude').val( position.coords.longitude );
    }

    $('.geo-location').on("click", function() {
        if (navigator.geolocation) {
            $('#submit-map').addClass('fade-map');
            navigator.geolocation.getCurrentPosition(success);
        } else {
            error('Geo Location is not supported');
        }
    });
</script>
<script>
  $(document).ready(function(){
    $("#fileupload").fileinput({
        overwriteInitial: true,
        showClose: false,
        showCaption: false,
        showUpload: false,
        showCancel: false,
        uploadAsync: false,
        browseClass: 'btn btn-default',
        browseLabel: 'เลือกรูปภาพ',
        allowedFileExtensions: ["jpg", "png"],
        initialPreview: [
           // IMAGE RAW MARKUP
           '<img src="<?php echo $row_prop['prop_thumbnail_img'] ?>" class="file-preview-image" width="210px" height="150px">'
        ],
        initialPreviewAsData: false, // allows you to set a raw markup
        initialPreviewFileType: 'image', // image is the default and can be overridden in config below
        initialPreviewShowDelete: false,
        initialPreviewConfig: [
          {type: "image", caption: "รูปโครงการ", size: 147000, width: "200px"}
        ]
        }).on('filecleared', function(event) {
            console.log("file cleared");
            $('#property-thumbnail').val("assets/img/properties/property-sample.jpg");
    });
  });
</script>

</body>
</html>
