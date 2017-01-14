<pre>
<?php print_r( $HTTP_POST_FILES ) ?>
<?php print_r( $_REQUEST ) ?>
<?php print_r( $_SERVER ) ?>
<?php print_r( $_ENV ) ?>
<?php print_r( $_FILES ) ?>
<?php print_r( $_FILES[$_REQUEST['upfile']] ) ?>
<?php print "tmp dir : {$_SERVER['upload_tmp_dir']}\n"?>

<?php #print "tmp: " $_FILES['upfile']['tmp_name'] ?>
</pre>
