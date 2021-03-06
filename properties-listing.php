<?php
    session_start();

    if (!isset($_SESSION['email'])) {
        header("Location: sign-in.php");
    }

    include_once 'assets/php/dbconnect.php';
    include_once 'assets/php/property.php';
    include_once 'assets/php/property_type.php';
    include_once 'assets/php/property_municipal.php';

    // get connection
    $database = new Database();
    $db = $database->getConnection();

    // pass connection to property_types table
    $property = new Property($db);
    $property_type = new Property_type($db);
    $property_municipal = new Property_municipal($db);

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $property->perpage = 10;
    $property->start = ($page - 1) * $property->perpage;
    //$total_rows = $property->getTotalRows();
    //$total_pages = ceil($total_rows / $property->perpage);

    $notfound = false;
    if (isset($_POST['btn-search'])) {
        if (!empty($_POST['property-search'])) {
            $property->srch_prop_name = $_POST['property-search'];
            $result = $property->search_listing();
            if (mysqli_num_rows($result) <= 0) {
                $notfound = true;
                $total_rows = 0;
            } else {
                $total_rows = mysqli_num_rows($result);
            }
        }
    } else {
        $result = $property->readforpagination();
        $total_rows = $property->getTotalRows();
    }
    $total_pages = ceil($total_rows / $property->perpage);

    if (isset($_GET['property_id'])) {
        $property->prop_id = $_GET['property_id'];
        if ($property->delete()) {
            header("Location: properties-listing.php");
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
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/datatables.css"/> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pridi:300,400">
    <style>
        h1, h2, h3, h4, h5, h6, legend, a, .btn, ul, th, td, input[type='search'], .alert, address { font-family: 'Pridi', serif; }
    </style>

    <title>โครงการสำรวจอุปทานที่อยู่อาศัยเพื่อจัดแผนที่เบื้องต้น | ข้อมูลโครงการ</title>

</head>

<body class="page-sub-page page-my-properties page-account" id="page-top">
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
              <div class="add-your-property">
                  <a href="properties-create.php" class="btn btn-default"><i class="fa fa-plus"></i><span class="text">เพิ่มข้อมูลโครงการ</span></a>
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
                              <div class="col-md-12 col-sm-12">
                                <form class="form-inline" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                                  <div class="form-group">
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                      <input type="search" class="form-control" id="property-search" name="property-search" maxlength="100" placeholder="ค้นหาชื่อโครงการ" required oninvalid="this.setCustomValidity('ใส่ชื่อโครงการก่อนทำการค้นหา!')" onchange="this.setCustomValidity('')">
                                    </div>
                                  </div>
                                  <button type="submit" class="btn btn-default" name="btn-search">ค้นหา</button>
                                  <button type="button" class="btn btn-success" onclick="return window.location='properties-listing.php';">แสดงข้อมูลทั้งหมด <span class="badge"><?php echo $property->getTotalRows(); ?> โครงการ</span></button>
                                </form>
                              </div>
                          </div>
                          <br />
                          <div class="row">
                            <div class="col-md-12 col-sm-12">
                              <div class="table-responsive">
                                  <table class="table" id="property-listing">
                                      <thead>
                                      <tr>
                                          <th>ชื่อโครงการ</th>
                                          <th>เทศบาล</th>
                                          <th>อำเภอ</th>
                                          <th>วันที่บันทึกข้อมูล</th>
                                          <th>สถานะการแสดงข้อมูล</th>
                                          <th class="center">แก้ไขข้อมูล</th>
                                          <th class="center">ลบข้อมูล</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <?php while ($row = mysqli_fetch_array($result)) { ?>
                                      <tr>
                                          <td>&nbsp;&nbsp;&nbsp;<?php echo $row['prop_name']; ?></td>
                                          <td>
                                          <?php
                                              $property_municipal->prop_municipal_id = $row['prop_municipal_id'];
                                              $result_prop_municipal = $property_municipal->readone();
                                              $row_prop_municipal = mysqli_fetch_array($result_prop_municipal);
                                              echo $row_prop_municipal['prop_municipal_desc'];
                                          ?>
                                          </td>
                                          <td><?php echo $row['prop_address_district']; ?></td>
                                          <td><?php echo $row['prop_created_date']; ?></td>
                                          <td><?php if ($row['prop_status']) {
                                              echo "อนุญาตให้แสดงข้อมูล";
                                          } else { echo "ไม่อนุญาตให้แสดงข้อมูล"; } ?></td>
                                          <td class="center">
                                              <a href="properties-update.php?property_id=<?php echo $row['prop_id']; ?>" class="edit"><i class="fa fa-pencil"></i></a>
                                          </td>
                                          <td class="center">
                                              <a href="#" class="delete" data-href="properties-listing.php?property_id=<?php echo $row['prop_id']; ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
                                          </td>
                                      </tr>
                                      <?php } ?>
                                      </tbody>
                                  </table>
                              </div><!-- /.table-responsive -->
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="center-block">
                                    <?php
                                      if (isset($notfound) && $notfound) {
                                          echo "<div class='alert alert-danger text-center'>ไม่พบข้อมูล</div>";
                                      }
                                    ?>
                                </div>
                            </div>
                          </div>
                          <!-- Pagination -->
                          <div class="center">
                              <ul class="pagination">
                                  <?php for ($i=1; $i <= $total_pages; $i++) {
                                      if ($page == $i) {
                                          echo "<li class='active'><a href='properties-listing.php?page=" . $i . "'>" . $i . "</a></li>";
                                      } else {
                                          echo "<li><a href='properties-listing.php?page=" . $i . "'>" . $i . "</a></li>";
                                      }
                                  } ?>
                              </ul><!-- /.pagination-->
                          </div><!-- /.center-->
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
                    <span>Copyright © 2013. All Rights Reserved.</span>
                    <span class="pull-right"><a href="#page-top" class="roll">Go to top</a></span>
                </div>
            </aside>
        </div><!-- /.inner -->
    </footer>
    <!-- end Page Footer -->
</div>

<!-- Modal Dialog -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">ยืนยันการลบข้อมูล</h4>
        </div>
        <div class="modal-body">
          <p>แน่ใจว่าต้องการลบข้อมูลนี้?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            <a class="btn btn-danger" id="confirm">ลบข้อมูล</a>
        </div>
    </div>
</div>
</div>

<script type="text/javascript" src="assets/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/smoothscroll.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="assets/js/retina-1.1.0.min.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
<!-- <script type="text/javascript" src="assets/js/datatables.min.js"></script> -->

<!--[if gt IE 8]>
<script type="text/javascript" src="assets/js/ie.js"></script>
<![endif]-->
<script>
  // $(document).ready(function() {
  //   $('#property-listing').DataTable({
  //     paging: false
  //   });
  // });

  $('#confirm-delete').on('show.bs.modal', function(e) {
      $(this).find('#confirm').attr('href', $(e.relatedTarget).data('href'));
  });
</script>

</body>
</html>
