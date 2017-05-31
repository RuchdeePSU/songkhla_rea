<?php
    session_start();

    if (!isset($_SESSION['email'])) {
        header("Location: sign-in.php");
    }

    include_once 'assets/php/dbconnect.php';
    include_once 'assets/php/admin.php';

    // get connection
    $database = new Database();
    $db = $database->getConnection();

    // pass connection to admin table
    $admin = new Admin($db);
    $admin->email = $_SESSION['email'];
    $result = $admin->readoneforupdate();
    $row = mysqli_fetch_array($result);

    // form is submitted
    if (isset($_POST['account-submit'])) {
        $admin->name = $_POST['form-account-name'];
        $admin->status = 1;
        //$admin->email = $_POST['form-account-email'];

        if ($admin->update_account()) {
            $success_update_account = true;
            $_SESSION['name'] = $_POST['form-account-name'];
        } else {
            $success_update_account = false;
        }
    }

    // form is submitted
    if (isset($_POST['form-password-submit'])) {
        $admin->passwd = $_POST['form-password-new'];
        //$admin->email = $_POST['form-account-email'];

        if ($admin->update_password()) {
            header("Location: assets/php/sign-out.php");
        } else {
            $success_update_passwd = false;
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
        h1, h2, h3, h4, h5, h6, legend, a, .btn, strong, ul, label, input, address { font-family: 'Pridi', serif; }
    </style>

    <title>โครงการสำรวจอุปทานที่อยู่อาศัยเพื่อจัดแผนที่เบื้องต้น | ข้อมูลผู้ใช้งาน</title>

</head>

<body class="page-sub-page page-profile page-account" id="page-top">
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
                    <a href="submit.html" class="btn btn-default"><i class="fa fa-plus"></i><span class="text">เพิ่มโครงการ</span></a>
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
                <li class="active">ข้อมูลผู้ใช้งาน</li>
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
                            <li class="active"><a href="profile.php"><i class="fa fa-user"></i><span>ข้อมูลผู้ใช้งาน</span></a></li>
                            <li><a href="property-types-listing.php"><i class="fa fa-list"></i><span>ข้อมูลประเภทอสังหาริมทรัพย์</span></a></li>
                            <li><a href="property-municipals-listing.php"><i class="fa fa-list"></i><span>ข้อมูลเทศบาล</span></a></li>
                            <li><a href="properties-listing.php"><i class="fa fa-home"></i><span>ข้อมูลโครงการ</span></a></li>
                        </ul>
                    </aside>
                </section><!-- /#sidebar -->
            </div><!-- /.col-md-3 -->
            <!-- end Sidebar -->
                <!-- My Properties -->
                <div class="col-md-9 col-sm-10">
                    <section id="profile">
                        <header><h1>เกี่ยวกับผู้ใช้งาน</h1></header>
                        <div class="account-profile">
                            <div class="row">
                                <!-- <div class="col-md-3 col-sm-3">
                                    <img alt="" class="image" src="assets/img/agent-01.jpg">
                                </div> -->
                                <div class="col-md-6 col-sm-6">
                                    <form role="form" id="form-account-profile" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                                        <section id="contact">
                                            <div class="form-group">
                                                <label for="form-account-email">อีเมล</label>
                                                <input type="text" class="form-control" id="form-account-email" name="form-account-email" placeholder="email@example.com" value="<?php echo $_SESSION['email']; ?>" readonly>
                                            </div><!-- /.form-group -->
                                            <div class="form-group">
                                                <label for="form-account-name">ชื่อผู้ใช้งาน</label>
                                                <input type="text" class="form-control" id="form-account-name" name="form-account-name" required placeholder="Your name" value="<?php echo $_SESSION['name']; ?>" required>
                                            </div><!-- /.form-group -->
                                            <div class="form-group clearfix">
                                                <button type="submit" class="btn pull-right btn-default" id="account-submit" name="account-submit">บันทึกการแก้ไข</button>
                                            </div><!-- /.form-group -->
                                        </section>
                                    </form><!-- /#form-contact -->
                                </div><!-- /.col-md-9 -->
                                <div class="col-md-6 col-sm-6">
                                    <div class="center-block">
                                        <?php
                                          if (isset($success_update_account)) {
                                              if ($success_update_account) {
                                                  echo "<div class='alert alert-success text-center'>บันทึกข้อมูลเรียบร้อยแล้ว</div>";
                                              } else {
                                                  echo "<div class='alert alert-danger text-center'>พบข้อผิดพลาด! ไม่สามารถบันทึกข้อมูลได้</div>";
                                              }
                                          }
                                        ?>
                                    </div>
                                </div>
                            </div><!-- /.row -->
                            <div class="row">
                              <div class="col-md-9 col-sm-9">
                                <section id="change-password">
                                    <header><h2>แก้ไขรหัสผ่าน</h2></header>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <form role="form" id="form-password" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                                                <div class="form-group">
                                                    <label for="form-password-current">รหัสผ่านปัจจุบัน</label>
                                                    <input type="password" class="form-control" id="form-password-current" name="form-password-current" maxlength="16" onkeyup="validateCurrentPass('<?php echo $row['passwd']; ?>')" required>
                                                </div><!-- /.form-group -->
                                                <div class="form-group">
                                                    <label for="form-password-new">รหัสผ่านใหม่</label>
                                                    <input type="password" class="form-control" id="form-password-new" name="form-password-new" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" maxlength="16" required>
                                                </div><!-- /.form-group -->
                                                <div class="form-group">
                                                    <label for="form-password-confirm">ยืนยันรหัสผ่านใหม่</label>
                                                    <input type="password" class="form-control" id="form-password-confirm" name="form-password-confirm" maxlength="16" required>
                                                </div><!-- /.form-group -->
                                                <div class="form-group clearfix">
                                                    <button type="submit" class="btn btn-default" id="form-password-submit" name="form-password-submit">บันทึกรหัสผ่านใหม่</button>
                                                </div><!-- /.form-group -->
                                            </form><!-- /#form-account-password -->
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <strong>คำแนะนำ: รหัสผ่านต้องประกอบด้วย</strong>
                                            <ul>
                                                <li>ตัวเลขอย่างน้อย 1 ตัว</li>
                                                <li>ตัวอักษรภาษาอังกฤษตัวใหญ่อย่างน้อย 1 ตัว</li>
                                                <li>ตัวอักษรภาษาอังกฤษตัวเล็กอย่างน้อย 1 ตัว</li>
                                                <li>รหัสผ่านต้องมีความยาวไม่น้อยกว่า 8 ตัวอักษร</li>
                                            </ul>
                                            <div class="center-block">
                                                <?php
                                                  if (isset($success_update_passwd)) {
                                                      if (!$success_update_passwd) {
                                                          echo "<div class='alert alert-danger text-center'>พบข้อผิดพลาด! ไม่สามารถบันทึกรหัสผ่านใหม่ได้</div>";
                                                      }
                                                  }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                              </div>
                            </div>
                        </div><!-- /.account-profile -->
                    </section><!-- /#profile -->
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

<script type="text/javascript" src="assets/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="assets/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/smoothscroll.js"></script>
<script type="text/javascript" src="assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="assets/js/icheck.min.js"></script>
<script type="text/javascript" src="assets/js/retina-1.1.0.min.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
<script type="text/javascript" src="assets/js/md5.min.js"></script>
<!--[if gt IE 8]>
<script type="text/javascript" src="assets/js/ie.js"></script>
<![endif]-->
<script>
    var password = document.getElementById("form-password-new"),
        confirm_password = document.getElementById("form-password-confirm");

    function validatePassword(){
      if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("ยืนยันรหัสผ่านไม่ตรงกัน!");
      } else {
        confirm_password.setCustomValidity('');
      }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;

    function validateCurrentPass(cpassword1) {
        var cpassword2 = document.getElementById("form-password-current");
        if (cpassword1 != md5(cpassword2.value)) {
            cpassword2.setCustomValidity("รหัสผ่านปัจจุบันไม่ถูกต้อง!");
        } else {
            cpassword2.setCustomValidity("");
        }
    }
</script>

</body>
</html>
