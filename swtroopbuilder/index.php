<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<img style='float:right; width:150px;height:100px;' src="../images/SW_Fan.gif"/>
<table style="border:thin solid blue;float:left;">
  <td><span  class="disabled_link" disabled="true" ><img src="../images/icons/house.png"/> Home</span></td>
  <td><a href="edit.php" ><img src="../images/icons/page_edit.png"/> New Unit</a></td>
  <td><a href="load.php" ><img src="../images/icons/folder.png"/> Load Unit</a></td>
</table>
<h3>&nbsp;&nbsp;&nbsp;Savage Worlds Troop Builder - <span style="color:red">December 2009 Edition support!</span></h3>

<div style="float:left;padding:5px;border: thin solid black;">
<span style="padding:1px; text-decoration:underline;">Pre-made Units</span><br/>
<?php include 'templates.php'; ?>
<?php foreach( $templates as $template ){ if( $template) { ?>
<?php   $data = json_decode( $template , true ); ?>
 <p><a href="edit.php?load_data=<?= urlencode($template) ?>" ><img src="../images/icons/folder_page.png"/> Load</a> <?= $data['troop_name'] ?></p>
<?php    } } ?>
</div>
<p style='padding:2px' >&nbsp;
Welcome to my Troop Builder. To get Started select the Edit link or Load one of the pre-made Units on the left.</p>
<p style='padding:2px' >&nbsp;
This tool is very much a work in progress. Support for the Showdown rules released in December of 2009 is an ongoing effort.
<br/><span style='padding:2px;font-style:italic;' >&nbsp;
<?php
    $lcd = "$LastChangedDate: 2012-03-06 09:23:00 -0400 $";
    $lcdz = explode( " ", $lcd );
?>
Last updated on <?= date("m/d/y h:i a", strtotime($lcdz[1] . " " . $lcdz[2] ) ) ?></span>
</p>
<div style="float:left;padding:5px;border: thin solid black;display: none;">
<span style="padding:1px; text-decoration:underline;">Local File</span><br/>
<form action='load_from_file.php' method='POST' >
Select a file from your local computer: <input type="file" name="upfile">&nbsp;<input  type="submit" name="submit" value="Upload"><br>
</form>
</div>
<ol class="known_issues_title">Product Roadmap / Known Issues
<li class="known_issues_issue">Parry in pdf output is incorrect.<span class="known_issues_tag"> -03/05/2012</span></li>
<li class="known_issues_issue">Implement December 2009 point values<span class="known_issues_tag"> -12/20/2009</span></li>
<li class="known_issues_issue">Verify points for arcane backgrounds<span class="known_issues_tag"> -10/09/2009</span></li>
<li class="known_issues_issue">Implement Multiple PDF export options<span class="known_issues_tag"> -10/09/2009</span></li>
<li class="known_issues_issue">Support Unit Image (pic) on pdf output<span class="known_issues_tag"> -10/09/2009</span></li>
<li class="known_issues_issue">Direct Support for Mounts and Vehicles<span class="known_issues_tag"> -10/09/2009</span></li>
<li class="known_issues_issue">Direct Support for Power Points<span class="known_issues_tag"> -10/09/2009</span></li>
<li class="known_issues_issue">Newline characters in textareas are not saved and restored correctly.<span class="known_issues_tag"> -10/22/2009</span></li>
<li class="known_issues_issue">Need to start testing on windows firefox<span class="known_issues_tag"> -10/22/2009</span></li>
<ol class="change_log_title">Change History
<li class="change_log_issue">Began Pointing changes <span class="change_log_tag"> -12/20/2009</span></li>
<li class="change_log_issue">Implemented 2nd pdf output option<span class="change_log_tag"> -10/22/2009</span></li>
<li class="change_log_issue">Minor changes to pdf output<span class="change_log_tag"> -10/13/2009</span></li>
<li class="change_log_issue">Refactored Pre-Made Units<span class="change_log_tag"> -10/13/2009</span></li>
<li class="change_log_issue">Added History<span class="change_log_tag"> -10/13/2009</span></li>
</ol>
</ol>
<br/>
<p style='font-style:italic;float:left'>
This game references the Savage Worlds game system, available from Pinnacle Entertainment Group at www.peginc.com. Savage Worlds and all associated logos and trademarks are copyrights of Pinnacle Entertainment Group. Used with permission. Pinnacle makes no representation or warranty as to the quality, viability, or suitability for purpose of this product.
</p>
</body>
</html>
