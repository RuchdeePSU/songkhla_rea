<?php
    session_start();

    if (!isset($_GET['prop_id'])) {
        header("Location: index.php");
    }

    include_once 'assets/php/dbconnect.php';
    include_once 'assets/php/property.php';
    include_once 'assets/php/property_type.php';
    include_once 'assets/php/property_municipal.php';
    include_once 'assets/php/property_detail.php';

    // get connection
    $database = new Database();
    $db = $database->getConnection();

    // pass connection to tables
    $property = new Property($db);
    $property_type = new Property_type($db);
    $property_municipal = new Property_municipal($db);
    $property_detail = new Property_detail($db);

    $property->prop_id = $_GET['prop_id'];
    $result_prop = $property->readone();
    $row_prop = mysqli_fetch_array($result_prop);

    $straddr = "";
    if (!empty($row_prop['prop_address_no'])) {
        $straddr .= $row_prop['prop_address_no'] . " ";
    }
    if (!empty($row_prop['prop_address_moo'])) {
        $straddr .= "ม." . $row_prop['prop_address_moo'] . " ";
    }
    if (!empty($row_prop['prop_address_road'])) {
        $straddr .= "ถ." . $row_prop['prop_address_road'] . " ";
    }
    if (!empty($row_prop['prop_address_subdistrict'])) {
        $straddr .= "ต." . $row_prop['prop_address_subdistrict'] . " ";
    }
    if (!empty($row_prop['prop_address_district'])) {
        $straddr .= "อ." . $row_prop['prop_address_district'];
    }

    $strsize = "";
    if (!empty($row_prop['prop_size1']) && $row_prop['prop_size1'] != 0) {
        $strsize .= $row_prop['prop_size1'] . " ไร่ ";
    }
    if (!empty($row_prop['prop_size2']) && $row_prop['prop_size2'] != 0) {
        $strsize .= $row_prop['prop_size2'] . " งาน ";
    }
    if (!empty($row_prop['prop_size3']) && $row_prop['prop_size3'] != 0) {
        $strsize .= $row_prop['prop_size3'] . " ตารางวา";
    }

    $property_municipal->prop_municipal_id = $row_prop['prop_municipal_id'];
    $result_municipal = $property_municipal->readone();
    $row_municipal = mysqli_fetch_array($result_municipal);

    $property_detail->prop_id = $row_prop['prop_id'];
    $result_prop_detail = $property_detail->readsome();

    $nodata = "[ไม่มีข้อมูล]";

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
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pridi:300,400">
    <style>
        h1, h2, h3, h4, h5, h6, legend, a, ul, p, button, figure, dt, dd, label { font-family: 'Pridi', serif; }
    </style>

    <title>โครงการสำรวจอุปทานที่อยู่อาศัยเพื่อจัดแผนที่เบื้องต้น | รายละเอียดโครงการ</title>

</head>

<body class="page-sub-page page-property-detail" id="page-top">
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
                        <li class="active"><a href="index.php">หน้าแรก</a></li>
                        <li><a href="#">ความเป็นมาของโครงการ</a></li>
                        <li><a href="#">ติดต่อ</a></li>
                        <?php
                            if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == "admin") {
                              echo "<li><a href='profile.php'>จัดการข้อมูล</a></li>";
                            } else {
                              // menu for typical user
                              echo "<li><a href='#'>ลงทะเบียน</a></li>";
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
                <div class="add-your-property">
                    <?php if (isset($_SESSION['email'])) {
                        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin') {
                            echo "<a href='properties-create.php' class='btn btn-default'><i class='fa fa-plus'></i><span class='text'>เพิ่มโครงการ</span></a>";
                        }
                    } ?>
                </div>
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
                <li class="active">รายละเอียดโครงการ</li>
            </ol>
        </div>
        <!-- end Breadcrumb -->

        <div class="container">
            <div class="row">
                <!-- Property Detail Content -->
                <div class="col-md-9 col-sm-9">
                    <section id="property-detail">
                        <header class="property-title">
                            <h1><?php echo $row_prop['prop_name']; ?></h1>
                            <figure><?php echo $straddr; ?></figure>
                            <!-- <span class="actions">
                                <a href="#" class="bookmark" data-bookmark-state="empty"><span class="title-add">Add to bookmark</span><span class="title-added">Added</span></a>
                            </span> -->
                        </header>
                        <!-- <section id="property-gallery">
                            <div class="owl-carousel property-carousel">
                                <div class="property-slide">
                                    <a href="assets/img/properties/property-detail-01.jpg" class="image-popup">
                                        <div class="overlay"><h3>Front View</h3></div>
                                        <img alt="" src="assets/img/properties/property-detail-01.jpg">
                                    </a>
                                </div>
                                <div class="property-slide">
                                    <a href="assets/img/properties/property-detail-02.jpg" class="image-popup">
                                        <div class="overlay"><h3>Bedroom</h3></div>
                                        <img alt="" src="assets/img/properties/property-detail-02.jpg">
                                    </a>
                                </div>
                                <div class="property-slide">
                                    <a href="assets/img/properties/property-detail-03.jpg" class="image-popup">
                                        <div class="overlay"><h3>Bathroom</h3></div>
                                        <img alt="" src="assets/img/properties/property-detail-03.jpg">
                                    </a>
                                </div>
                            </div>
                        </section> -->
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <section id="quick-summary" class="clearfix">
                                    <header><h2>ประเภทโครงการ</h2></header>
                                    <?php while ($row_prop_detail = mysqli_fetch_array($result_prop_detail)) { ?>
                                        <dl>
                                            <dt>ประเภทโครงการ</dt>
                                                <dd><?php
                                                    $property_type->prop_type_id = $row_prop_detail['prop_type_id'];
                                                    echo $property_type->gettype_name();
                                                ?></dd>
                                            <dt>จำนวนยูนิตทั้งหมด</dt>
                                                <dd><?php echo $row_prop_detail['units_total']; ?></dd>
                                            <dt>จำนวนยูนิตที่จำหน่ายแล้ว</dt>
                                                <dd><?php echo $row_prop_detail['units_sold']; ?></dd>
                                            <dt>จำนวนยูนิตที่จำหน่ายได้เฉลี่ย/เดือน</dt>
                                                <dd><?php echo $row_prop_detail['units_sold_avg']; ?></dd>
                                            <dt>จำนวนยูนิตคงค้าง ณ ปัจจุบัน</dt>
                                                <dd><?php echo $row_prop_detail['units_unsold']; ?></dd>
                                            <dt>ระยะเวลาคงค้างเฉลี่ย (เดือน)</dt>
                                                <dd><?php echo $row_prop_detail['time_unsold_avg']; ?></dd>
                                            <dt>จำนวนยูนิตที่จะสร้างเพิ่ม (6 เดือน)</dt>
                                                <dd><?php echo $row_prop_detail['units_new_6m']; ?></dd>
                                            <dt>ราคาจำหน่ายต่ำสุด</dt>
                                                <dd><span class="tag price">฿<?php echo number_format($row_prop_detail['prop_min_price']); ?></span></dd>
                                            <dt>ราคาจำหน่ายสูงสุด</dt>
                                                <dd><span class="tag price">฿<?php echo number_format($row_prop_detail['prop_max_price']); ?></span></dd>
                                            <dt>ราคาจำหน่ายเฉลี่ย</dt>
                                                <dd><span class="tag price">฿<?php echo number_format(($row_prop_detail['prop_min_price']+$row_prop_detail['prop_max_price'])/2); ?></span></dd>
                                        </dl>
                                        <hr class="thick">
                                    <?php } ?>


                                </section><!-- /#quick-summary -->
                            </div><!-- /.col-md-4 -->
                            <div class="col-md-8 col-sm-12">
                                <section id="description">
                                    <header><h2>รายละเอียดโครงการ</h2></header>
                                    <dl>
                                        <dt><i class="fa fa-map-marker"></i> เทศบาลที่ตั้งโครงการ:</dt>
                                          <dd><?php echo $row_municipal['prop_municipal_desc']; ?></dd>
                                        <dt><i class="fa fa-home"></i> ขนาดพื้นที่ (ไร่/งาน/ตารางวา):</dt>
                                          <dd><?php if ($strsize != "") {
                                              echo $strsize;
                                          } else {
                                              echo $nodata;
                                          } ?></dd>
                                        <dt><i class="fa fa-certificate"></i> เลขที่ใบอนุญาตของโครงการ  :</dt>
                                          <dd><?php if ($row_prop['prop_regist_no'] != "") {
                                            echo $row_prop['prop_regist_no'];
                                        } else {
                                            echo $nodata;
                                        } ?></dd>
                                        <dt><i class="fa fa-user"></i> ผู้ประกอบการเจ้าของโครงการ:</dt>
                                          <dd><?php if ($row_prop['prop_owner_name'] != "") {
                                            echo $row_prop['prop_owner_name'];
                                        } else {
                                            echo $nodata;
                                        } ?></dd>
                                        <dt><i class="fa fa-calendar"></i> วันที่เริ่มดำเนินโครงการ:</dt>
                                          <dd><?php if ($row_prop['prop_started_date'] != "") {
                                            echo $row_prop['prop_started_date'];
                                        } else {
                                            echo $nodata;
                                        } ?></dd>
                                        <dt><i class="fa fa-users"></i> นิติบุคคลบริหารโครงการ:</dt>
                                          <dd><?php if ($row_prop['prop_corporation'] != "") {
                                            echo $row_prop['prop_corporation'];
                                        } else {
                                            echo $nodata;
                                        } ?></dd>
                                        <dt><i class="fa fa-check-square"></i> สถานะสมาชิก:</dt>
                                          <dd><?php if ($row_prop['prop_membership']) {
                                            echo "เป็นสมาชิกสมาคมอสังหาริมทรัพย์";
                                        } else {
                                            echo "ไม่เป็นสมาชิกสมาคมอสังหาริมทรัพย์";
                                        } ?></dd>
                                    </dl>
                                </section><!-- /#description -->
                                <br />
                                <section id="property-map">
                                    <header><h2>ที่ตั้งโครงการ</h2></header>
                                    <div class="property-detail-map-wrapper">
                                        <div class="property-detail-map" id="property-detail-map"></div>
                                    </div>
                                </section><!-- /#property-map -->
                            </div><!-- /.col-md-8 -->
                            <div class="col-md-12 col-sm-12">
                                <section id="contact-agent">
                                    <header><h2>ติดต่อโครงการ</h2></header>
                                    <div class="row">
                                        <section class="agent-form">
                                            <div class="col-md-7 col-sm-12">
                                                <aside class="agent-info clearfix">
                                                    <figure><a href="agent-detail.html"><img alt="" src="<?php echo $row_prop['prop_thumbnail_img'] ?>"></a></figure>
                                                    <div class="agent-contact-info">
                                                        <dl>
                                                            <dt><i class="fa fa-user"></i> ชื่อผู้ติดต่อของโครงการ:</dt>
                                                            <dd><?php if ($row_prop['prop_contact_person'] != "") {
                                                                echo $row_prop['prop_contact_person'];
                                                            } else {
                                                                echo $nodata;
                                                            } ?></dd>
                                                            <dt><i class="fa fa-phone"></i> โทรศัพท์:</dt>
                                                            <dd><?php if ($row_prop['prop_phone_no'] != "") {
                                                                echo substr($row_prop['prop_phone_no'], 0, 3). " " . substr($row_prop['prop_phone_no'], 3, 3) . " " . substr($row_prop['prop_phone_no'], 6);
                                                            } else {
                                                                echo $nodata;
                                                            } ?></dd>
                                                            <dt><i class="fa fa-envelope"></i> อีเมล:</dt>
                                                            <dd><?php if ($row_prop['prop_email'] != "") {
                                                                echo "<a href='mailto:#' class='link-arrow'>" . $row_prop['prop_email'] ."</a>";
                                                            } else {
                                                                echo $nodata;
                                                            } ?></dd>
                                                            <dt><i class="fa fa-sitemap"></i> เว็บไซต์:</dt>
                                                            <dd><?php if ($row_prop['prop_website'] != "") {
                                                                echo "<a href='" . $row_prop['prop_website'] . "' class='link-arrow' target='_blank'>" . $row_prop['prop_website'] . "</a>";
                                                            } else {
                                                                echo $nodata;
                                                            } ?></dd>
                                                        </dl>
                                                        <hr>
                                                    </div>
                                                </aside><!-- /.agent-info -->
                                            </div><!-- /.col-md-7 -->
                                            <div class="col-md-5 col-sm-12">
                                                <div class="agent-form">
                                                    <form role="form" id="form-contact-agent" method="post"  class="clearfix">
                                                        <div class="form-group">
                                                            <label for="form-contact-agent-name">ชื่อและนามสกุล<em>*</em></label>
                                                            <input type="text" class="form-control" id="form-contact-agent-name" name="form-contact-agent-name" required>
                                                        </div><!-- /.form-group -->
                                                        <div class="form-group">
                                                            <label for="form-contact-agent-email">อีเมล<em>*</em></label>
                                                            <input type="email" class="form-control" id="form-contact-agent-email" name="form-contact-agent-email" required>
                                                        </div><!-- /.form-group -->
                                                        <div class="form-group">
                                                            <label for="form-contact-agent-message">ข้อความ<em>*</em></label>
                                                            <textarea class="form-control" id="form-contact-agent-message" rows="2" name="form-contact-agent-message" required></textarea>
                                                        </div><!-- /.form-group -->
                                                        <div class="form-group">
                                                            <button type="submit" class="btn pull-right btn-default" id="form-contact-agent-submit">ส่งข้อความถึงโครงการ</button>
                                                        </div><!-- /.form-group -->
                                                        <div id="form-contact-agent-status"></div>
                                                    </form><!-- /#form-contact -->
                                                </div><!-- /.agent-form -->
                                            </div><!-- /.col-md-5 -->
                                        </section><!-- /.agent-form -->
                                    </div><!-- /.row -->
                                </section><!-- /#contact-agent -->
                                <hr class="thick">


                            </div><!-- /.col-md-12 -->
                        </div><!-- /.row -->
                    </section><!-- /#property-detail -->
                </div><!-- /.col-md-9 -->
                <!-- end Property Detail Content -->

                <!-- sidebar -->
                <div class="col-md-offset-3 col-sm-offset-3">
                </div><!-- /.col-md-3 -->
                <!-- end Sidebar -->
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
                                <!-- <address>
                                    <strong>Your Company</strong><br>
                                    4877 Spruce Drive<br>
                                    West Newton, PA 15089
                                </address>
                                +1 (734) 123-4567<br>
                                <a href="#">hello@example.com</a> -->
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
                    <span>Copyright © 2017. All Rights Reserved.</span>
                    <span class="pull-right"><a href="#page-top" class="roll">Go to top</a></span>
                </div>
            </aside>
        </div><!-- /.inner -->
    </footer>
    <!-- end Page Footer -->
</div>

<script type="text/javascript" src="assets/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyCI9elmy3zkfLaXKTjO8rp8h9sZ1JPQD3o"></script>
<script type="text/javascript" src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/smoothscroll.js"></script>
<script type="text/javascript" src="assets/js/markerwithlabel_packed.js"></script>
<script type="text/javascript" src="assets/js/infobox.js"></script>
<script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.placeholder.js"></script>
<script type="text/javascript" src="assets/js/icheck.min.js"></script>
<script type="text/javascript" src="assets/js/retina-1.1.0.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.raty.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="assets/js/jshashtable-2.1_src.js"></script>
<script type="text/javascript" src="assets/js/jquery.numberformatter-1.2.3.js"></script>
<script type="text/javascript" src="assets/js/tmpl.js"></script>
<script type="text/javascript" src="assets/js/jquery.dependClass-0.1.js"></script>
<script type="text/javascript" src="assets/js/draggable-0.1.js"></script>
<script type="text/javascript" src="assets/js/jquery.slider.js"></script>
<script type="text/javascript" src="assets/js/jquery.fitvids.js"></script>
<script type="text/javascript" src="assets/js/custom-map.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
<!--[if gt IE 8]>
<script type="text/javascript" src="assets/js/ie.js"></script>
<![endif]-->
<script>
    // var propertyId = 0;
    _latitude = <?php echo $row_prop['prop_lat']; ?>;
    _longitude = <?php echo $row_prop['prop_long']; ?>;
    _pictureLabel = "<?php echo $row_prop['prop_icon_type']; ?>";
    google.maps.event.addDomListener(window, 'load', initMap(_latitude, _longitude, _pictureLabel));
    $(window).load(function(){
        initializeOwl(false);
    });
</script>

</body>
</html>
