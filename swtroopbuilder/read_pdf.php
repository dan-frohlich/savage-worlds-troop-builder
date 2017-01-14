<?
  $original_filename = $_REQUEST['file'];
  $filename = $_REQUEST['file'];
  if( $filename ){
     //if it exists, redirect to it.
    $filename = "/var/www/html/pdfs/" . $filename;

    if( file_exists  ( $filename  ) ) {
      header("Content-Type: application/pdf");
      header('Content-Disposition: attachment; filename="'.$_REQUEST['name'].'.pdf"');
      readfile( $filename );
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
<body onload="window.location='read_pdf.php?file=<?=$id?>.pdf&name=<?= $_REQUEST['troop_name']?>';">
</body>
</html>
<?php } ?>
