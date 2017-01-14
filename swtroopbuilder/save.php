<?php 
header("Content-Type: text/plain");
header('Content-Disposition: attachment; filename="'.$_POST['troop_name'].'.txt"');
print json_encode( $_POST );
?>
