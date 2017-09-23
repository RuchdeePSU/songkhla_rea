<?php
    session_start();

    include_once 'assets/php/dbconnect.php';
    include_once 'assets/php/property_municipal.php';
    include_once 'assets/php/property_type.php';
    include_once 'assets/php/property.php';

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

    // pass connection to property table
    $property = new Property($db);

    if (isset($_GET['btn-search'])) {
        $property->srch_municipal_id = $_GET['prop_municipal'];
        $property->srch_type_id = $_GET['prop_type'];
        $property->srch_min_price = substr($_GET['price'], 0, strpos($_GET['price'],';'));
        $property->srch_max_price = substr($_GET['price'], strpos($_GET['price'],';')+1);
        if (!$property->search()) {
            $searchresult = 0;
            if (!$property->writejson()) {
                header("Location: 500.html");
            }
        }
    } else {
        if (!$property->writejson()) {
                 header("Location: 500.html");
        }
    }

    $number_of_properties = $property->getTotalRows();

    // perform search property data
    // if (!isset($_GET['searchresult'])) {
    //     if (!$property->writejson()) {
    //         header("Location: 500.html");
    //     }
    // } else {
    //     if (!$_GET['searchresult']) {
    //         if (!$property->writejson()) {
    //             header("Location: 500.html");
    //         }
    //     }
    // }

?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="ThemeStarz">

    <link href="assets/fonts/font-awesome.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/jquery.slider.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pridi:300,400">
    <style>
        h1, h2, h3, h4, h5, h6, legend, a, ul, p, button, address, .infobox-location { font-family: 'Pridi', serif; }
    </style>

    <title>โครงการสำรวจอุปทานที่อยู่อาศัยเพื่อจัดทำแผนที่เบื้องต้น</title>

</head>

<body class="page-homepage navigation-fixed-top map-google" id="page-top" data-spy="scroll" data-target=".navigation" data-offset="90">
<!-- Wrapper -->
<div class="wrapper">

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
                        <li class="active"><a href="#">หน้าแรก</a></li>
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

    <!-- <div class="container">
        <div class="geo-location-wrapper">
            <span class="btn geo-location"><i class="fa fa-map-marker"></i><span class="text">Find My Position</span></span>
        </div>
    </div> -->

    <!-- Map -->
    <div id="map" class="has-parallax">
    </div>
    <!-- end Map -->

    <!-- Search Box -->
    <div class="search-box-wrapper">
        <div class="search-box-inner">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4">
                        <div class="search-box map">
                            <form role="form" id="form-map" class="form-map form-search" method="get" action="index.php">
                                <!--<h2>Search Your Property</h2>-->
                                <h2>ค้นหาอสังหาริมทรัพย์</h2>
                                <div class="form-group">
                                    <select name="prop_municipal" id="prop_municipal">
                                        <option value="0">ทำเลที่ตั้ง</option>
                                        <?php while ($row_municipal = mysqli_fetch_array($result_municipal)) {
                                            if (isset($_GET['prop_municipal']) && $row_municipal['prop_municipal_id'] == $_GET['prop_municipal']) {
                                                echo "<option value='" . $row_municipal['prop_municipal_id'] . "' selected>" . $row_municipal['prop_municipal_desc'] . "</option>";
                                            } else {
                                                echo "<option value='" . $row_municipal['prop_municipal_id'] . "'>" . $row_municipal['prop_municipal_desc'] . "</option>";
                                            }

                                        } ?>
                                    </select>
                                </div><!-- /.form-group -->
                                <div class="form-group">
                                    <select name="prop_type" id="prop_type">
                                        <option value="0">ประเภทอสังหาริมทรัพย์</option>
                                        <?php while ($row_type = mysqli_fetch_array($result_type)) {
                                            if (isset($_GET['prop_type']) &&  $row_type[prop_type_id] == $_GET['prop_type']) {
                                                echo "<option value='" . $row_type[prop_type_id] . "' selected>" . $row_type['prop_type_desc'] . "</option>";
                                            } else {
                                                echo "<option value='" . $row_type[prop_type_id] . "'>" . $row_type['prop_type_desc'] . "</option>";
                                            }

                                        } ?>
                                    </select>
                                </div><!-- /.form-group -->
                                <div class="form-group">
                                    <div class="price-range">
                                        <?php
                                            if (isset($_GET['price'])) {
                                                echo "<input type='text' id='price-input' name='price'  value='" . $_GET['price'] ."'>";
                                            } else {
                                                echo "<input type='text' id='price-input' name='price'  value='0;30000000'>";
                                            }
                                        ?>

                                    </div>
                                </div>
                                <div class="form-group">
                                      <button type="submit" class="btn btn-default" id="btn-search" name="btn-search">ค้นหา</button>
                                </div><!-- /.form-group -->
                                <div class="form-group">
                                    <?php if (isset($_GET['btn-search'])) { ?>
                                            <button type="button" class="btn btn-default" id="btn-searchcancel" name="btn-search-cancel" onclick="return window.location='index.php';">ยกเลิกการค้นหา</button>
                                    <?php } else { ?>
                                            <button type="button" class="btn btn-default" id="btn-searchcancel" name="btn-search-cancel" onclick="return window.location='index.php';" disabled>ยกเลิกการค้นหา</button>
                                    <?php } ?>
                                </div><!-- /.form-group -->
                            </form><!-- /#form-map -->
                        </div><!-- /.search-box.map -->
                    </div><!-- /.col-md-3 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.search-box-inner -->
    </div>
    <!-- end Search Box -->

    <!-- Page Content -->
    <div id="page-content">
        <section id="banner">
            <div class="block has-dark-background background-color-default-darker center text-banner">
                <div class="container">
                    <!--
                    <h1 class="no-bottom-margin no-border">Zoner Is Fully Loaded Real Estate Template with <a href="#" class="text-underline">Tons of Features</a>!</h1>
                    -->
                        <h2 class="no-border">[ จำนวนโครงการทั้งสิ้น ]</h2>
                        <div class="number-wrapper">
                            <h1 class="number" data-from="1" data-to="<?php echo $number_of_properties; ?>"><?php echo $number_of_properties; ?></h1>
                        </div><!-- /.number-wrapper -->

                </div>
            </div>
        </section><!-- /#banner -->
        <!--
        <section id="new-properties" class="block">
            <div class="container">
                <header class="section-title">
                    <h2>โครงการใหม่ประจำเดือนเมษายน</h2>
                    <a href="properties-listing.html" class="link-arrow">แสดงโครงการทั้งหมด</a>
                </header>
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="property">
                            <a href="property-detail.html">
                                <div class="property-image">
                                    <img alt="" src="assets/img/properties/property-09.jpg">
                                </div>
                                <div class="overlay">
                                    <div class="info">
                                        <div class="tag price">$ 11,000</div>
                                        <h3>3398 Lodgeville Road</h3>
                                        <figure>Golden Valley, MN 55427</figure>
                                    </div>
                                    <ul class="additional-info">
                                        <li>
                                            <header>Area:</header>
                                            <figure>240m<sup>2</sup></figure>
                                        </li>
                                        <li>
                                            <header>Beds:</header>
                                            <figure>2</figure>
                                        </li>
                                        <li>
                                            <header>Baths:</header>
                                            <figure>2</figure>
                                        </li>
                                        <li>
                                            <header>Garages:</header>
                                            <figure>0</figure>
                                        </li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="property">
                            <a href="property-detail.html">
                                <div class="property-image">
                                    <img alt="" src="assets/img/properties/property-03.jpg">
                                </div>
                                <div class="overlay">
                                    <div class="info">
                                        <div class="tag price">$ 38,000</div>
                                        <h3>2186 Rinehart Road</h3>
                                        <figure>Doral, FL 33178 </figure>
                                    </div>
                                    <ul class="additional-info">
                                        <li>
                                            <header>Area:</header>
                                            <figure>240m<sup>2</sup></figure>
                                        </li>
                                        <li>
                                            <header>Beds:</header>
                                            <figure>3</figure>
                                        </li>
                                        <li>
                                            <header>Baths:</header>
                                            <figure>1</figure>
                                        </li>
                                        <li>
                                            <header>Garages:</header>
                                            <figure>1</figure>
                                        </li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="property">
                            <a href="property-detail.html">
                                <div class="property-image">
                                    <img alt="" src="assets/img/properties/property-06.jpg">
                                </div>
                                <div class="overlay">
                                    <div class="info">
                                        <div class="tag price">$ 325,000</div>
                                        <h3>3705 Brighton Circle Road</h3>
                                        <figure>Glenwood, MN 56334</figure>
                                    </div>
                                    <ul class="additional-info">
                                        <li>
                                            <header>Area:</header>
                                            <figure>240m<sup>2</sup></figure>
                                        </li>
                                        <li>
                                            <header>Beds:</header>
                                            <figure>3</figure>
                                        </li>
                                        <li>
                                            <header>Baths:</header>
                                            <figure>1</figure>
                                        </li>
                                        <li>
                                            <header>Garages:</header>
                                            <figure>1</figure>
                                        </li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="property">
                            <a href="property-detail.html">
                                <div class="property-image">
                                    <img alt="" src="assets/img/properties/property-01.jpg">
                                </div>
                                <div class="overlay">
                                    <div class="info">
                                        <div class="tag price">$ 16,000</div>
                                        <h3>362 Lynn Ogden Lane</h3>
                                        <figure>Galveston, TX 77550</figure>
                                    </div>
                                    <ul class="additional-info">
                                        <li>
                                            <header>Area:</header>
                                            <figure>240m<sup>2</sup></figure>
                                        </li>
                                        <li>
                                            <header>Beds:</header>
                                            <figure>3</figure>
                                        </li>
                                        <li>
                                            <header>Baths:</header>
                                            <figure>1</figure>
                                        </li>
                                        <li>
                                            <header>Garages:</header>
                                            <figure>1</figure>
                                        </li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="property">
                            <a href="property-detail.html">
                                <div class="property-image">
                                    <img alt="" src="assets/img/properties/property-02.jpg">
                                </div>
                                <div class="overlay">
                                    <div class="info">
                                        <div class="tag price">$ 18,000</div>
                                        <h3>2506 B Street</h3>
                                        <figure>New Brighton, MN 55112</figure>
                                    </div>
                                    <ul class="additional-info">
                                        <li>
                                            <header>Area:</header>
                                            <figure>280m<sup>2</sup></figure>
                                        </li>
                                        <li>
                                            <header>Beds:</header>
                                            <figure>3</figure>
                                        </li>
                                        <li>
                                            <header>Baths:</header>
                                            <figure>2</figure>
                                        </li>
                                        <li>
                                            <header>Garages:</header>
                                            <figure>1</figure>
                                        </li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="property">
                            <a href="property-detail.html">
                                <div class="property-image">
                                    <img alt="" src="assets/img/properties/property-12.jpg">
                                </div>
                                <div class="overlay">
                                    <div class="info">
                                        <div class="tag price">$ 136,000</div>
                                        <h3>3990 Late Avenue</h3>
                                        <figure>Kingfisher, OK 73750</figure>
                                    </div>
                                    <ul class="additional-info">
                                        <li>
                                            <header>Area:</header>
                                            <figure>30m<sup>2</sup></figure>
                                        </li>
                                        <li>
                                            <header>Beds:</header>
                                            <figure>1</figure>
                                        </li>
                                        <li>
                                            <header>Baths:</header>
                                            <figure>1</figure>
                                        </li>
                                        <li>
                                            <header>Garages:</header>
                                            <figure>0</figure>
                                        </li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="property">
                            <a href="property-detail.html">
                                <div class="property-image">
                                    <img alt="" src="assets/img/properties/property-05.jpg">
                                </div>
                                <div class="overlay">
                                    <div class="info">
                                        <div class="tag price">$ 12,680</div>
                                        <h3>297 Marie Street</h3>
                                        <figure>Towson, MD 21204 </figure>
                                    </div>
                                    <ul class="additional-info">
                                        <li>
                                            <header>Area:</header>
                                            <figure>240m<sup>2</sup></figure>
                                        </li>
                                        <li>
                                            <header>Beds:</header>
                                            <figure>3</figure>
                                        </li>
                                        <li>
                                            <header>Baths:</header>
                                            <figure>1</figure>
                                        </li>
                                        <li>
                                            <header>Garages:</header>
                                            <figure>1</figure>
                                        </li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="property">
                            <a href="property-detail.html">
                                <div class="property-image">
                                    <img alt="" src="assets/img/properties/property-10.jpg">
                                </div>
                                <div class="overlay">
                                    <div class="info">
                                        <div class="tag price">$ 12,800</div>
                                        <h3>64 Timberbrook Lane</h3>
                                        <figure>Denver, CO 80202</figure>
                                    </div>
                                    <ul class="additional-info">
                                        <li>
                                            <header>Area:</header>
                                            <figure>240m<sup>2</sup></figure>
                                        </li>
                                        <li>
                                            <header>Beds:</header>
                                            <figure>3</figure>
                                        </li>
                                        <li>
                                            <header>Baths:</header>
                                            <figure>1</figure>
                                        </li>
                                        <li>
                                            <header>Garages:</header>
                                            <figure>1</figure>
                                        </li>
                                    </ul>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        -->
        <section id="partners" class="block">
            <div class="container">
                <header class="section-title"><h2>ผู้สนับสนุน</h2></header>
                <div class="logos">
                    <div class="logo"><a href=""><img src="assets/img/logo-partner-01.png" alt=""></a></div>
                    <div class="logo"><a href=""><img src="assets/img/logo-partner-02.png" alt=""></a></div>
                    <div class="logo"><a href=""><img src="assets/img/logo-partner-03.png" alt=""></a></div>
                    <div class="logo"><a href=""><img src="assets/img/logo-partner-04.png" alt=""></a></div>
                    <div class="logo"><a href=""><img src="assets/img/logo-partner-05.png" alt=""></a></div>
                </div>
            </div><!-- /.container -->
        </section><!-- /#partners -->
    </div>
    <!-- end Page Content -->
    <!-- Page Footer -->
    <footer id="page-footer">
        <div class="inner">
            <aside id="footer-main">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-3">
                            <!--
                            <article>
                                <h3>About Us</h3>
                                <p>Vel fermentum ipsum. Suspendisse quis molestie odio. Interdum et malesuada fames ac ante ipsum
                                    primis in faucibus. Quisque aliquet a metus in aliquet. Praesent ut turpis posuere, commodo odio
                                    id, ornare tortor
                                </p>
                                <hr>
                                <a href="#" class="link-arrow">Read More</a>
                            </article>
                            -->
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
                    <span>Copyright © 2017. All Rights Reserved.</span>
                    <span class="pull-right"><a href="#page-top" class="roll">Go to top</a></span>
                </div>
            </aside>
        </div><!-- /.inner -->
    </footer>
    <!-- end Page Footer -->
</div>

<div class="modal fade" id="search-notfound" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">ผลการค้นหาโครงการอสังหาริมทรัพย์</h4>
        </div>
        <div class="modal-body">
          <p>ไม่พบข้อมูล! ระบบจะแสดงข้อมูลโครงการอสังหาริมทรัพย์ทั้งหมดในแผนที่ </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ปิดหน้าต่าง</button>
        </div>
    </div>
</div>
</div>

<script type="text/javascript" src="assets/js/jquery-2.1.0.min.js"></script>
<!--add key #Ruchdee -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyCI9elmy3zkfLaXKTjO8rp8h9sZ1JPQD3o"></script>
<!--
<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.exp"></script>
-->
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
<script type="text/javascript" src="assets/js/jquery.vanillabox-0.1.5.min.js"></script>
<script type="text/javascript" src="assets/js/retina-1.1.0.min.js"></script>
<script type="text/javascript" src="assets/js/jshashtable-2.1_src.js"></script>
<script type="text/javascript" src="assets/js/jquery.numberformatter-1.2.3.js"></script>
<script type="text/javascript" src="assets/js/tmpl.js"></script>
<script type="text/javascript" src="assets/js/jquery.dependClass-0.1.js"></script>
<script type="text/javascript" src="assets/js/draggable-0.1.js"></script>
<script type="text/javascript" src="assets/js/jquery.slider.js"></script>
<script type="text/javascript" src="assets/js/markerclusterer_packed.js"></script>
<script type="text/javascript" src="assets/js/custom-map.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
<script type="text/javascript" src="assets/js/jquery.countTo.js"></script>
<script type="text/javascript" src="assets/js/waypoints.min.js"></script>
<!--[if gt IE 8]>
<script type="text/javascript" src="assets/js/ie.js"></script>
<![endif]-->
<script>
//    _latitude = 48.87;
//    _longitude = 2.29;
// change them to hatyai city #Ruchdee
//     _latitude = 7.008647;
//     _longitude = 100.504688;
      _latitude = 6.991580;
      _longitude = 100.482645;
//    _latitude = 6.896111;
//    _longitude = 100.476111;
    createHomepageGoogleMap(_latitude,_longitude);
    $(window).load(function(){
        initializeOwl(false);
    });
</script>
<script>
    $.urlParam = function(name){
      var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
      if (results==null){
        return null;
      }
      else{
        return results[1] || 0;
      }
    }
    // if ($.urlParam('searchresult') == '0') {
    //     $('#search-notfound').modal('show');
    // }
    var searchfound = <?php if (isset($searchresult)) {
      echo $searchresult . ";";
    } else {
      echo 1 . ";";
    } ?>
    if (!searchfound) {
        $('#search-notfound').modal('show');
    }
</script>

</body>
</html>
