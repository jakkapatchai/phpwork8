<?php
session_start();
header('Access-Control-Allow-Origin: *');
ini_set('error_reporting', E_WARNING);  // E_ALL : get deprecated
ini_set('display_errors', 'on');
/* การอนุญาตให้ทำ CORS (Cross Origin Resource Sharing) ผ่าน chrome
https://chrome.google.com/webstore/detail/allow-cors-access-control/lhobafahddgcelffkeicbaginigeejlf?hl=en
http://www.thaiall.com/php/adminlte357.png
*/
?><!DOCTYPE html><html><head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>AdminLTE 357 - 1 table and 3 fields</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/jqvmap/jqvmap.min.css">
<link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css">
<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/summernote/summernote-bs4.css">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<style>
@font-face{
font-family:"Font Awesome 5 Brands";
font-style:normal;font-weight:normal;font-display:auto;
src:url('https://adminlte.io/themes/v3/plugins/fontawesome-free/webfontsfa-brands-400.eot');
src:url('https://adminlte.io/themes/v3/plugins/fontawesome-free/webfontsfa-brands-400.eot?#iefix') format("embedded-opentype"),
url('https://adminlte.io/themes/v3/plugins/fontawesome-free/webfontsfa-brands-400.woff2') format("woff2"),
url('https://adminlte.io/themes/v3/plugins/fontawesome-free/webfontsfa-brands-400.woff') format("woff"),
url('https://adminlte.io/themes/v3/plugins/fontawesome-free/webfontsfa-brands-400.ttf') format("truetype"),
url('https://adminlte.io/themes/v3/plugins/fontawesome-free/webfontsfa-brands-400.svg#fontawesome') format("svg")
}.fab{font-family:"Font Awesome 5 Brands"}
@font-face{
font-family:"Font Awesome 5 Free";
font-style:normal;font-weight:400;font-display:auto;
src:url('https://adminlte.io/themes/v3/plugins/fontawesome-free/webfontsfa-regular-400.eot');
src:url('https://adminlte.io/themes/v3/plugins/fontawesome-free/webfontsfa-regular-400.eot?#iefix') format("embedded-opentype"),
url('https://adminlte.io/themes/v3/plugins/fontawesome-free/webfontsfa-regular-400.woff2') format("woff2"),
url('https://adminlte.io/themes/v3/plugins/fontawesome-free/webfontsfa-regular-400.woff') format("woff"),
url('https://adminlte.io/themes/v3/plugins/fontawesome-free/webfontsfa-regular-400.ttf') format("truetype"),
url('https://adminlte.io/themes/v3/plugins/fontawesome-free/webfontsfa-regular-400.svg#fontawesome') format("svg")
}.far{font-weight:400}
@font-face{
font-family:"Font Awesome 5 Free";
font-style:normal;font-weight:900;font-display:auto;
src:url('https://adminlte.io/themes/v3/plugins/fontawesome-free/webfontsfa-solid-900.eot');
src:url('https://adminlte.io/themes/v3/plugins/fontawesome-free/webfontsfa-solid-900.eot?#iefix') format("embedded-opentype"),
url('https://adminlte.io/themes/v3/plugins/fontawesome-free/webfontsfa-solid-900.woff2') format("woff2"),
url('https://adminlte.io/themes/v3/plugins/fontawesome-free/webfontsfa-solid-900.woff') format("woff"),
url('https://adminlte.io/themes/v3/plugins/fontawesome-free/webfontsfa-solid-900.ttf') format("truetype"),
url('https://adminlte.io/themes/v3/plugins/fontawesome-free/webfontsfa-solid-900.svg#fontawesome') format("svg")
}.fa,.far,.fas{font-family:"Font Awesome 5 Free"}.fa,.fas{font-weight:900}
</style>
</head><body class="hold-transition sidebar-mini layout-fixed">
<div class="container-fluid">
<!-- Main row -->

<div class="row">
<a href="select.php" class="d-block">select |</a>
<a href="add.php" class="d-block"> add |</a>
<a href="delete.php" class="d-block"> delete |</a>
<a href="update.php" class="d-block"> update </a>
<?php
/* ปรับปรุง 13 ตุลาคม 2563
- เผยแพร่ใน http://www.thaiall.com/source
- เริ่มต้นต้องสร้างตารางก่อน ดูที่ตัวแปร $create_sql
- ตัวอย่างที่ http://www.thaiall.com/perlphpasp/source.pl?key=9144 (ก่อนปรับ)
- ตัวอย่างที่ http://www.thaiall.com/perlphpasp/source.pl?key=9146 (หลังปรับ)
*/
/* # 01 - ส่วนกำหนดค่าเริ่มต้นของระบบ */
$host = "localhost";
$db = "id15221735_northwind";
$tb = "order";
$user = "id15221735_root"; /* รหัสผู้ใช้ ให้สอบถามจากผู้ดูแลระบบ */
$password = "LNL25@a$n1s%QC+<"; /* รหัสผ่าน ให้สอบถามจากผู้ดูแลระบบ */
$create_sql = "create table order
(oid varchar(20),  empid varchar(20), cusid varchar(20))
engine = InnoDB default charset=utf8 collate=utf8_unicode_ci;";
$drop_sql = "drop table order";
if (isset($_REQUEST{'action'})) $act = $_REQUEST{'action'}; else $act = "";
/* # จัดการ session ของ php7 */
if (isset($_REQUEST["v7"])) {
  $_SESSION["v7"] = false;
  if($_REQUEST["v7"] == "obj") $_SESSION["v7"] = true;
}
/* # 02 - ส่วนสร้าง และลบตาราง */
if (strlen($act) > 0 && ($act == "createtable" || $act == "droptable")) {
  doconnect();
  if($act == "droptable") doquery($drop_sql); else  doquery($create_sql);
  footer("$act : completely<br/><a href='?'>back</a>");
  echo '<meta http-equiv="refresh" content="0; url='. $_SERVER["SCRIPT_NAME"] .'">';
}
/* # 03 - ส่วนแสดงผลหลัก ทั้งปกติ และหลังกดปุ่ม del หรือ edit */
if (strlen($act) == 0 || $act == "del" || $act == "edit") {
  doconnect();
  doquery("select * from order");
  if ($r) echo '<table class="table table-striped projects">
<thead><tr>
<th style="width: 10%">oid</th>
<th style="width: 40%">empid</th>
<th style="width: 10%" class="text-center">cusid</th>
<th style="width: 40%">Process</th>
</tr></thead>';
  while (dofetch("object")) {
    if (isset($_REQUEST{'oid'}) && $_REQUEST{'oid'}  == getfld("object","oid")) $chg = " style='background-color:#f9f9f9"; else $chg = " readonly style='background-color:#ffffdd";
    echo "<tr><form action='' method=post>
      <td><input name=oid size=5 value='". getfld("object","oid") . "' style='background-color:#dddddd' readonly></td>
      <td><input name=empid size=40 value='". getfld("object","empid") . "' $chg'></td>
      <td><input name=cusid size=20 value='". getfld("object","cusid") . "' $chg;text-align:right'></td>
      <td>";
    if (isset($_REQUEST{'oid'}) && $_REQUEST{'oid'} == getfld("object","oid")) {
      if ($act == "del") echo "";
      if ($act == "edit") echo "<input type=submit name=action value='edit : confirm' class='btn btn-info btn-sm' style='background-color:#000044'>";
    } else {
      echo "";
      echo "<input type=submit name=action value='edit' class='btn btn-info btn-sm' style='background-color:blue'>";
    }
    echo "</td></form></tr>";
  } /* dofetch */
  if ($r == true) {
    echo "</form></table>";
    if (isset($_SESSION["msg"]) && strlen($_SESSION["msg"]) > 1) {
      echo '<div class="col-12"><div class="small-box card-body"><div class="inner"><p style="text-align:center;">';
      echo $_SESSION["msg"]; /* แสดงผลค่านี้ หลังการ Refresh */
      echo '</p></div></div></div>';
    }
    $_SESSION["msg"] = "";  /* เมื่อแสดงผลแล้ว ก็ล้างค่านี้จากตัวแปร msg */
    footer(null);
  }
}
/
/* # 06 - ส่วนแก้ไขข้อมูล */
if ($act == "edit : confirm") {
  doconnect();
  doquery("update $tb set empid ='". $_REQUEST{'empid'} . "', cusid ='". $_REQUEST{'cusid'} . "' where oid =" . $_REQUEST{'oid'});
  footer("refresh");
}
/* # 07 - footer */
function footer($msg){
  global $conn;
  if($msg == "refresh") {
     echo '<meta http-equiv="refresh" content="0; url='. $_SERVER["SCRIPT_NAME"] .'">';
     if (isset($_SESSION["v7"]) && $_SESSION["v7"] == true) mysqli_close($conn); else $conn->close();
  }
  if (strlen($msg) > 1) {
    echo '<div class="col-lg-3 col-12"><div class="small-box bg-info"><div class="inner"><p>'. $msg .'</p></div></div></div>';
  }
  if ((int)phpversion() >=7)
    echo '<div class="col-lg-8 col-4"><div class="small-box card-body">';
  else
    echo '<div class="col-12"><div class="small-box bg-warning">';
  echo '<div class="inner"><p style="text-align:center;">';
  echo "<a href=?action=createtable>create table</a> : <a href=?action=droptable>drop table</a>";
  echo "<br/>version " . (int)phpversion() . " : ";
  echo '</h3></div></div></div>';
  if ((int)phpversion() >=7) {
    echo '<div class="col-lg-4 col-8"><div class="small-box bg-warning"><div class="inner"><p>';
    if (isset($_SESSION["v7"]) && $_SESSION["v7"] == false)
      echo "<a href=?v7=obj>mysqli object</a> : mysqli no object";
    else
      echo "mysqli object : <a href=?v7=noobj>mysqli no object</a>";
    echo '</p></div></div></div>';
  }
}
/* # 08 - connect */
function doconnect(){
  global $conn,$host,$user,$password,$db;
  if ((int)phpversion() >=7) {
    if (isset($_SESSION["v7"]) && $_SESSION["v7"]  == false) {
      /* v7 เลือก connect ได้ 2 แบบ */
      /* แบบแรก mysqli_connect */
      $conn = mysqli_connect($host, $user, $password, $db);
      if (!$conn) footer("Connection failed: " . mysqli_connect_error());
    } else {
      /* แบบที่สอง new mysqli */
      $conn = new mysqli($host, $user, $password, $db);
      if ($conn->connect_error) footer("Connection failed: " . $conn->connect_error);
    }
  } else {
    /* v5 ใช้แบบ mysql_connect */
    $conn = mysql_connect($host, $user, $password);
    if (!$conn) footer("Connection failed: " . mysql_error());
  }
}
/* # 09 - query */
function doquery($myq){
  global $r,$conn,$db;
  if ((int)phpversion() >=7) {
    if (isset($_SESSION["v7"]) && $_SESSION["v7"]  == false) {
      $r = mysqli_query($conn,$myq);
    } else {
      $r = $conn->query($myq);
    }
    if (!$r) footer("Query : Fail<br/>$myq");
  } else {
    $r = mysql_db_query($db,$myq);
    if (!$r) footer("Query : Fail<br/>$myq");
  }
}
/* # 10 - fetch */
function dofetch($t) {
  global $o, $r; /* object, assoc, array */
  if(!$r) { $o = false; return false; }
  if ((int)phpversion() >=7) {
    if($t == "object") return $o = $r->fetch_object();
  } else {
    if($t == "object") return $o = mysql_fetch_object($r);
  }
}
/* # 11 - get field value ตามชื่อเขตข้อมูล */
function getfld($t,$fld) {
  global $o; /* การอ้างอิงเขตข้อมูลเหมือนกันทั้งใน php7 และ php5 */
  if($t == "object") return ($o->{$fld});
}
?>
 
</div>
<!-- /.row (main row) -->
</div><!-- /.container-fluid -->

<!-- jQuery -->
<script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://adminlte.io/themes/v3/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>$.widget.bridge('uibutton', $.ui.button)</script>
<!-- Bootstrap 4 -->
<script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="https://adminlte.io/themes/v3/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="https://adminlte.io/themes/v3/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="https://adminlte.io/themes/v3/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="https://adminlte.io/themes/v3/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="https://adminlte.io/themes/v3/plugins/moment/moment.min.js"></script>
<script src="https://adminlte.io/themes/v3/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="https://adminlte.io/themes/v3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="https://adminlte.io/themes/v3/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="https://adminlte.io/themes/v3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="https://adminlte.io/themes/v3/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="https://www.masterhook.net/public/assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="https://adminlte.io/themes/v3/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="https://adminlte.io/themes/v3/dist/js/demo.js"></script>
</body></html>