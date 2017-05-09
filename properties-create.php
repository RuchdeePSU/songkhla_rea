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
        // $property->prop_municipal_desc = $_POST['property-municipal-desc'];
        // $property_municipal->prop_municipal_status = $_POST['property-municipal-status'];

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
        h1, h2, h3, h4, h5, h6, legend, a, .btn, label, .geo-location { font-family: 'Pridi', serif; }
    </style>

    <title>โครงการสำรวจอุปทานที่อยู่อาศัยเพื่อจัดแผนที่เบื้องต้น | ข้อมูลโครงการ</title>

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
                          <div class="row">
                            <div class="col-md-8 col-sm-8">
                                <div class="form-group">
                                    <label for="property-title">ชื่อโครงการ</label>
                                    <input type="text" class="form-control" id="property-title" name="property-title" required>
                                </div><!-- /.form-group -->
                            </div>
                            <div class="col-md-4 col-sm-4">
                              <div class="form-group">
                                  <label for="property-type">ประเภทโครงการ</label>
                                  <select name="type" id="property-type">
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
                                    <select name="type" id="property-municipal">
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
                                    <label for="submit-min_price">ราคาจำหน่ายต่ำสุด</label>
                                    <div class="input-group">
                                      <span class="input-group-addon">฿</span>
                                      <input type="number" class="form-control" id="property-min-price" name="property-min-price" pattern="\d*" placeholder="0" value="0" required>
                                    </div>
                                </div><!-- /.form-group -->
                            </div><!-- /.col-md-4 -->
                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <label for="submit-max_price">ราคาจำหน่ายสูงสุด</label>
                                    <div class="input-group">
                                      <span class="input-group-addon">฿</span>
                                      <input type="number" class="form-control" id="property-max-price" name="property-max-price" pattern="\d*" placeholder="0" value="0" required>
                                    </div>
                                </div><!-- /.form-group -->
                            </div><!-- /.col-md-4 -->
                            <div class="col-md-4 col-sm-4">
                              <div class="form-group">
                                  <label for="property-municipal-status">สถานะการใช้งาน</label>
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
                                                      <input type="text" class="form-control" id="latitude" name="latitude" readonly>
                                                  </div><!-- /.form-group -->
                                              </div>
                                              <div class="col-md-5 col-sm-5">
                                                  <div class="form-group">
                                                      <input type="text" class="form-control" id="longitude" name="longitude" readonly>
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

<script type="text/javascript" src="assets/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyCI9elmy3zkfLaXKTjO8rp8h9sZ1JPQD3o"></script>
<script type="text/javascript" src="assets/js/markerwithlabel_packed.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/smoothscroll.js"></script>
<script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/js/icheck.min.js"></script>
<script type="text/javascript" src="assets/js/retina-1.1.0.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.magnific-popup.min.js"></script>
<script type="text/javascript" src="assets/js/fileinput.min.js"></script>
<script type="text/javascript" src="assets/js/custom-map.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
<script>
    // var _latitude = 48.87;
    // var _longitude = 2.29;

    _latitude = 7.006474666769294;
    _longitude = 100.47486183575438;

    google.maps.event.addDomListener(window, 'load', initSubmitMap(_latitude,_longitude));
    function initSubmitMap(_latitude,_longitude){
        var mapCenter = new google.maps.LatLng(_latitude,_longitude);
        var mapOptions = {
            zoom: 16,
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

</body>
</html>
