<?php
	session_start();
	if(!isset($_SESSION['logged_in_ytds']))
		header('location:logout.php');
	include 'ajax/conn.php';
?><!DOCTYPE html>

<html lang="en">
<head>
<title>TGT</title>
<meta charset="UTF-8" />
<meta name="theme-color" content="#505050">
<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/fullcalendar.css" />
<link rel="stylesheet" href="css/maruti-style.css" />

<link rel="stylesheet" href="css/uniform.css" />
<link rel="stylesheet" href="css/maruti-media.css" class="skin-color" />

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.jqueryui.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
<!--link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.css"-->


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />

<script>
  var jsNilai = 0;
  var jsAnggota = 0;
  var jsUnit = 0;
  var jsAbsen = 0;
</script>
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">TGT</a></h1>
</div>
<!--close-Header-part-->

<!--top-Header-messaages-->
<div class="btn-group rightzero"> <a class="top_message tip-left" title="Manage Files"><i class="icon-file"></i></a> <a class="top_message tip-bottom" title="Manage Users"><i class="icon-user"></i></a> <a class="top_message tip-bottom" title="Manage Comments"><i class="icon-comment"></i><span class="label label-important">5</span></a> <a class="top_message tip-bottom" title="Manage Orders"><i class="icon-shopping-cart"></i></a> </div>
<!--close-top-Header-messaages-->

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
      <li class="" ><a title="" ><?=date('Y-m-d h:i')?></a></li>
    <li class="" ><a title="" ><i class="icon icon-user"></i> <span class="text"> Halo, <?=$_SESSION['nama_lengkap']?> </span> </a></li>

    <li class=""><a title="" href="logout.php"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->

<div id="sidebar"><a id="nav_mobile_title" href="#" class="visible-phone"><i class="icon-chevron-down"></i> Pilih Menu:</a><ul>
    <li class="active"><a href="#front_page" onclick="loadView('v_front_page.php');"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li><a href="#absensi" onclick="loadView('v_absensi.php');"><i class="icon-ok-sign"></i> <span>Absensi</span></a> </li>
    <li class="submenu"> <a id="menu_db"><i class="icon icon-th-large"></i> <span>Database</span><i class="icon-chevron-down"></i> </a>
      <ul>
        <li><a href="#db_anggota" onclick="$('#menu_db').click();loadView('v_db_anggota.php');">Database Anggota</a></li>
        <li><a href="#db_unit" onclick="$('#menu_db').click();loadView('v_db_unit.php');">Database Unit</a></li>
      </ul>
    </li>
    <li class="submenu"><a id="menu_lap"><i class="icon-file"></i> <span>Laporan</span></a>
		<ul>
			<li><a href="#laporan_absensi" onclick="$('#menu_lap').click();loadView('v_laporan_absensi.php');">Laporan Absensi</a></li>
			<li><a href="#laporan_prestasi" onclick="$('#menu_lap').click();loadView();">Laporan Prestasi</a></li>
			<li><a href="#laporan_anggota" onclick="$('#menu_lap').click();loadView('v_laporan_anggota.php');">Laporan Anggota</a></li>
		</ul>
	</li>
	
    <li><a href="#nilai" onclick="loadView();"><i class="icon-list-alt"></i> <span>Parameter</span></a></li>
   <!--  <li><a href="interface.html"><i class="icon icon-pencil"></i> <span>Eelements</span></a></li>
    <li class="submenu"> <a href="#"><i class="icon icon-file"></i> <span>Addons</span> <span class="label label-important">4</span></a>
      <ul>
        <li><a href="index2.html">Dashboard2</a></li>
        <li><a href="gallery.html">Gallery</a></li>
        <li><a href="calendar.html">Calendar</a></li>
        <li><a href="chat.html">Chat option</a></li>
      </ul>
    </li> -->
  </ul>
</div>
<div id="content">

	<div id="main_view" class="container-fluid">

	</div>
</div>
<div class="row-fluid">
  <div id="footer" class="span12 font10"> 2019 &copy; TGT | Developer : TR DATA </div>
</div>
<script src="js/excanvas.min.js"></script>
<script src="js/jquery.min.js"></script>
<!--script src="https://code.jquery.com/jquery-3.3.1.js"></script-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="js/jquery.uniform.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.jqueryui.min.js"</script>
<!--script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.js"</script-->
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.jqueryui.min.js "></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<!-- <script src="js/jquery.ui.custom.js"></script>  -->
<script src="js/bootstrap.min.js"></script>
<!-- <script src="js/jquery.flot.min.js"></script>
<script src="js/jquery.flot.resize.min.js"></script> -->
<script src="js/jquery.peity.min.js"></script>
<script src="js/fullcalendar.min.js"></script>
<script src="js/maruti.js"></script>
<script src="js/maruti.dashboard.js"></script>
<script src="js/jquery.ba-hashchange.js"></script>

<script src="js/ajax-loading.js"></script>
<!-- <script src="js/jquery.dataTables.min.js"></script> -->
 <script src="js/Buttons-1.5.1/js/dataTables.buttons.min.js"></script>
 <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script> -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {

          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();
          }
          // else, send page to designated URL
          else {
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>
