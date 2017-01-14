<?
  $original_filename = $_REQUEST['file'];
  $filename = $_REQUEST['file'];
  if( $filename ){
     //if it exists, redirect to it.
    $filename = "/var/www/html/pdfs/" . $filename;

    if( file_exists  ( $filename  ) ) {
?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body onload="window.location='read_pdf.php?file=<?=$_REQUEST['file']?>&name=<?= $_REQUEST['name']?>';">
<table style="border:thin solid blue;float:left;">
<tr>
  <td><a href="." ><img src="../images/icons/house.png"/> Index</a></td>
  <!--<td><a href="#" onClick="history.go(-1);" ><img src="../images/icons/page_edit.png"/> Edit <?= $_REQUEST['name'] ?></a></td>-->
  <td><span  class="disabled_link" disabled="true" ><img src="../images/icons/page_white_acrobat.png"/> PDF</span></td>
  <td><a href="load.php" ><img src="../images/icons/folder.png"/> Load</a></td>
</tr>
</table>
<div>
 When your document is complete, you can use on of the links above or the back button of your browser to continue.
</div>
</body>
</html>
<?php
    }else{
      notReadyYet( $original_filename );
    }
  }else{
      notReadyYet( $original_filename );
  }

 function notReadyYet( $filename )
 {
 ?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body onload="setTimeout('window.location.reload()', 10000);">
<div style='height:20%'>&nbsp;</div>
<div style='font-weight:bold; font-size:large;text-align:center;'><img src="../images/wait.gif"/> Our PDF gnomes are preparing your document...</div>
<pre><?php `/usr/bin/fortune 2>&1` ?></pre>
</body>
</html>
<?php } ?>
