<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body >
<form action="edit.php" method="post" >
<table style="border:thin solid blue;float:left;">
  <td><a href="." ><img src="../images/icons/house.png"/> Home</a></td>
  <td><a href="edit.php" ><img src="../images/icons/page_edit.png"/> New Unit</a></td>
  <td><span  class="disabled_link" disabled="true" ><img src="../images/icons/folder.png"/> Load Unit</span></td>
</table>
<h3>&nbsp;&nbsp;&nbsp;Savage Worlds Troop Builder</h3>
<input type="submit" value="Load" />
<b>Paste the troop data here:</b><br/>
<textarea name="load_data" rows="20" cols="40" >
<?php if( $_REQUEST['file']){ 
    $file = $_REQUEST['file'];
    print `cat $file`;
    # print `cat $_REQUEST['file']`;
    }
?>
</textarea>
<br/>
</form>
</body>
</html>

