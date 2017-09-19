<?php
    session_start();

    if (!isset($_SESSION['email'])) {
        header("Location: sign-in.php");
    }

    include_once 'assets/php/dbconnect.php';
    include_once 'assets/php/property_type.php';

    // get connection
    $database = new Database();
    $db = $database->getConnection();

    // pass connection to property_types table
    $property_type = new Property_type($db);

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $property_type->perpage = 5;
    $property_type->start = ($page - 1) * $property_type->perpage;

    $active = false;

    // read all records
    $result = $property_type->readall($active);
    $total_rows = $property_type->getTotalRows();
    $total_pages = ceil($total_rows / $property_type->perpage);

    if (isset($_GET['type_id'])) {
        $property_type->prop_type_id = $_GET['type_id'];
        if ($property_type->delete()) {
            header("Location: property-types-listing.php");
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Pridi:300,400">
    <style>
        h1, h2, h3, h4, h5, h6, legend, a, .btn, ul, th, td, address { font-family: 'Pridi', serif; }
    </style>

    <title>โครงการสำรวจอุปทานที่อยู่อาศัยเพื่อจัดแผนที่เบื้องต้น | ข้อมูลประเภทอสังหาริมทรัพย์</title>

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
                  <a href="property-types-create.php" class="btn btn-default"><i class="fa fa-plus"></i><span class="text">เพิ่มประเภทอสังหาริมทรัพย์</span></a>
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
              <li class="active">ข้อมูลประเภทอสังหาริมทรัพย์</li>
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
                          <li class="active"><a href="property-types-listing.php"><i class="fa fa-list"></i><span>ข้อมูลประเภทอสังหาริมทรัพย์</span></a></li>
                          <li><a href="property-municipals-listing.php"><i class="fa fa-list"></i><span>ข้อมูลเทศบาล</span></a></li>
                          <li><a href="properties-listing.php"><i class="fa fa-home"></i><span>ข้อมูลโครงการ</span></a></li>
                        </ul>
                    </aside>
                </section><!-- /#sidebar -->
            </div><!-- /.col-md-3 -->
            <!-- end Sidebar -->
                <!-- My Properties -->
                <div class="col-md-9 col-sm-10">
                    <section id="my-properties">
                        <header><h1>ประเภทอสังหาริมทรัพย์</h1></header>
                        <div class="my-properties">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>ประเภทอสังหาริมทรัพย์</th>
                                        <th>สถานะ</th>
                                        <th class="center">แก้ไขข้อมูล</th>
                                        <th class="center">ลบข้อมูล</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                                    <tr>
                                        <td>&nbsp;&nbsp;&nbsp;<?php echo $row['prop_type_desc']; ?></td>
                                        <td><?php if ($row['prop_type_status']) {
                                            echo "ใช้งานปกติ";
                                        } else { echo "ยกเลิกการใช้งาน"; } ?></td>
                                        <td class="center">
                                            <a href="property-types-update.php?type_id=<?php echo $row['prop_type_id']; ?>" class="edit"><i class="fa fa-pencil"></i></a>
                                        </td>
                                        <td class="center">
                                            <a href="#" class="delete disabled" data-href="property-types-listing.php?type_id=<?php echo $row['prop_type_id']; ?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div><!-- /.table-responsive -->
                            <!-- Pagination -->
                            <div class="center">
                                <ul class="pagination">
                                    <?php for ($i=1; $i <= $total_pages; $i++) {
                                        if ($page == $i) {
                                            echo "<li class='active'><a href='property-types-listing.php?page=" . $i . "'>" . $i . "</a></li>";
                                        } else {
                                            echo "<li><a href='property-types-listing.php?page=" . $i . "'>" . $i . "</a></li>";
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
<!--[if gt IE 8]>
<script type="text/javascript" src="assets/js/ie.js"></script>
<![endif]-->
<script>
  $('#confirm-delete').on('show.bs.modal', function(e) {
      $(this).find('#confirm').attr('href', $(e.relatedTarget).data('href'));
  });
</script>

</body>
</html>
