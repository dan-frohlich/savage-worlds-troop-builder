<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
  th {
      text-align: right;
      font-weight:bold;
      vertical-align: top;
  }
  td {
      text-align: center;
      vertical-align: top;
  }
</style>
</head>
<body>

<table style="border:thin solid blue;float:left;">
<td><a href="index.php" ><img src="../images/icons/house.png"/> Home</a></td>
<td><a href="edit.php?load_data=<?= urlencode( json_encode( $_POST )); ?>" ><img src="../images/icons/page_edit.png"/> New Unit</a></td>
<td><a href="load.php" ><img src="../images/icons/folder.png"/> Load Unit</a></td>
</table>
<h3>&nbsp;&nbsp;&nbsp;Select a template to use for your troop sheet.</h3>

<table>
<tr>
<? #<td><a href="javascript:document.forms[0].action='render_troopcard_pdf.php';document.forms[0].submit();"><img src="../images/icons/page_white_acrobat.png"/> Troop Card</a></td>?>
<td><a href="javascript:document.forms[0].action='render_condemo_pdf.php';document.forms[0].submit();"><img src="../images/icons/page_white_acrobat.png"/> Con-Demo Sheet</a></td>
<td><a href="javascript:document.forms[0].action='render_wwII_squad_pdf.php';document.forms[0].submit();"><img src="../images/icons/page_white_acrobat.png"/> WWII Squad Sheet</a></td>
<? #<td><a href="javascript:document.forms[0].action='render_solomonkane_pdf.php';document.forms[0].submit();"><img src="../images/icons/page_white_acrobat.png"/> Soloman Kane Ally Sheet</a></td>?>
<? #<td><a href="javascript:document.forms[0].action='render_aceblankv1.php';document.forms[0].submit();"><img src="../images/icons/page_white_acrobat.png"/> Ace's Blank Sheet</a></td>?>
</tr>
<tr>
<? #<td><img style='border:thin solid grey;' src="TroopCardBackground2_sm.png" /></td> ?>
<td><img style='border:thin solid grey;' src="condemo_sheet_web_sm.png" /></td>
<td><img style='border:thin solid grey;' src="wwII_squad_sm.png" /></td>
<? #<td><img style='border:thin solid grey;' src="solomonKaneAllySheetSingle_sm.png" /></td> ?>
<? #<td><img style='border:thin solid grey;' src="AceBlankv1_sm.png" /></td>?>
</tr>

<form action="" method="POST">
<?php
    foreach( $_POST as $key => $value )
    {
?>
    <input type=hidden name="<?= $key ?>" value="<?= $value ?>" />
<?php
    }
?>
</form>

</body>
</html>
