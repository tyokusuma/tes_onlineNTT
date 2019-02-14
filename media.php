<?php
session_start();
error_reporting(0);
include "timeout.php";
// header("Content-type: application/vnd-ms-excel");
// header("Content-Disposition: attachment; filename=DataSiswa.xls");

if($_SESSION[login]==1){
	if(!cek_login()){
		$_SESSION[login] = 0;
	}
}
if($_SESSION[login]==0){
  header('location:logout.php');
}
else{
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
	<title>..:: Computer Based Test ::.. </title>
	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon"/>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->

    <link href="css/sticky-footer-navbar.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
  </head>

  <body>

    <!-- Fixed navbar -->


<!-- css navbar sendiri -->

<style type="text/css">
    .navbar-fixed-top {
    background-color: #ADFF2F;
    font-size:18px;

    }
</style>


<!-- css navbar sendiri -->

<!-- css navbar sendiri footer -->
<style type="text/css">
.footer {

  position: absolute;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 60px;
  background-color: #000000;



</style>

<!-- css navbar sendiri footer -->


    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">


     <div class="navbar-header">


          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href ="media.php?module=home"><img src="images/logo1.png" height="41"></a>

        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="media.php?module=home">Beranda</a></li>
            <?php include "menu.php"; ?>

          </ul>
          <ul class="nav navbar-nav navbar-right">
                     <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrator <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="media.php?module=user">User</a></li>
                <li><a href="logout.php">Logout</a></li>

              </ul>
            </li>

          </ul>
        </div><!--/.nav-collapse -->

      </div>

    </nav>


    <div class="container">
<!--/.Bagian Isi -->

    <?php include "content.php"; ?>


    </div> <!-- /ISI AKHIR-->

        <footer class="footer">
      <div class="container">
        <p><a href="http://localhost/tes_online/media.php?module=home" target="_blank" title="Computer Based Test">Copyright@2018</a>.<b>MTs N Kota Kupang</b><a href="http://localhost/webmadrasah/" target="_blank" title="Computer Based Test">Team IT MTs N Kota Kupang</a>.<br></p>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script language="javascript" type="text/javascript"
	src="editor/tiny_mce_src.js"></script>
	<script type="text/javascript">
	tinyMCE.init({
			mode : "textareas",
			theme : "advanced",
			plugins : "table,youtube,advhr,advimage,advlink,emotions,flash,searchreplace,paste,directionality,noneditable,contextmenu",

			theme_advanced_buttons2_add : "separator,preview,zoom,separator,forecolor,backcolor,liststyle",
			theme_advanced_buttons2_add_before: "cut,copy,paste,separator,search,replace,separator",
			theme_advanced_buttons3_add_before : "tablecontrols,separator,youtube,separator",
			theme_advanced_buttons3_add : "emotions,flash",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			extended_valid_elements : "hr[class|width|size|noshade]",
			file_browser_callback : "fileBrowserCallBack",
			paste_use_dialog : false,
			theme_advanced_resizing : true,
			theme_advanced_resize_horizontal : false,
			theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
			apply_source_formatting : true
	});

		function fileBrowserCallBack(field_name, url, type, win) {
			var connector = "../../filemanager/browser.html?Connector=connectors/php/connector.php";
			var enableAutoTypeSelection = true;

			var cType;
			tinymcpuk_field = field_name;
			tinymcpuk = win;

			switch (type) {
				case "image":
					cType = "Image";
					break;
				case "flash":
					cType = "Flash";
					break;
				case "file":
					cType = "File";
					break;
			}

			if (enableAutoTypeSelection && cType) {
				connector += "&Type=" + cType;
			}

			window.open(connector, "tinymcpuk");
		}
	</script>

 </body>
</html>

<?php
}
}
?>
