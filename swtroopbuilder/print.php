<html>
<head>
<? include 'data.php'; ?>
<style type="text/css">
th {
    text-align:right;
}
input.number{
  text-align:right;
  width: 40px;
}
</style>
</head>
<?php
    $armorBns = 0;
    foreach( $armorBnsList as $key => $val ){ 
        if( $_POST[$key] )
            $armorBns += $val;
    }
    if( $_POST['other_armor_bonus'] ){
        $armorBns += $_POST['other_armor_bonus'];
    }
    $parryBns = 0;
    foreach( $parryBnsList as $key => $val ){ 
        if( $_POST[$key] ){
            $parryBns += $val;
        }
    }
    if( $_POST['other_parry_bonus'] ){
        $parryBns += $_POST['other_parry_bonus'];
    }
    $toughnessBns = 0;
    foreach( $toughnessBnsList as $key => $val ){ 
        if( $_POST[$key] ){
            $toughnessBns += $val;
        }
    }
    if( $_POST['other_toughness_bonus'] ){
        $toughnessBns += $_POST['other_toughness_bonus'];
    }
?>
<body >
<?php if( $_POST['wildcard'] ) { ?>
<div style="border: none; width:5in; height: 3in;">
<?php }else{ ?>
<div style="border: none; width:5in; height: 3.1in;">
<?php } ?>
<table style="width:100%; border: thin solid black;">
<tr style="vertical-align:top;" >
  <td colspan=3><b>Name:</b> <?= $_POST['troop_name'] . ($_POST['wildcard']?" <b style='color:red'>(WC)</b>":"") ?>
&nbsp;<?= $_POST['count']>1?"({$_POST['count']})":""?></td>
  <th>Cost:</th><td ><?= $_POST['cost'] ?><?= $_POST['count']>1?"X{$_POST['count']}=".($_POST['count']*$_POST['cost']):""?></td>
</tr>
<tr style="vertical-align:top" >
  <td colspan=5>
<?php foreach( $attributes as $att ){ ?>
<b><?= ucwords( $att ) ?>:</b>&nbsp;<?= $dice[$_POST[$att]] ?>&nbsp;&nbsp;&nbsp;
<?php } ?>
  </td>
</tr>
<tr >
<tr style="vertical-align:top" >
  <td colspan=3>
<b>Pace:</b>&nbsp;<?= $_POST['pace']?><?= $_POST['flying_pace']?"/".$_POST['flying_pace']."*":""?>&nbsp;&nbsp;
<b>Parry:</b>&nbsp;<?= $_POST['fighting']?(($_POST['fighting']/2)+3+$parryBns):"2" ?>&nbsp;<?= $parryBns?"({$parryBns})":""; ?>&nbsp;
<b>Toughness:</b>&nbsp;<?= ($_POST['vigor']+$_POST['size'])+3+$armorBns+$toughnessBns ?>&nbsp;<?= $armorBns?"({$armorBns})":""; ?>&nbsp;
<?php if( $_POST['size'] != 0){ ?>
<b>Size:</b>&nbsp;<?= $_POST['size'] ?>&nbsp;&nbsp;
<?php } ?>
  </td>
<td colspan=2>
</td>
</tr>
<tr >
<td style="vertical-align:top; height:1.5in; border: thin solid black;width:1in;" colspan=2>
<span style="width:100%;float:left;font-weight:bold;text-align:left;border-bottom:thin solid black;">Skills</span><br/>
<?php foreach( $skills as $att => $value ){ ?>
<?php if($dice[$_POST[$att]/$skills[$att]]){ ?>
<span style="float:left;font-size:small; width:50%;float:left;font-weight:bold;text-align:left;"
   ><?=  ucwords( $att )  ?>:</span>
<span style="float:right;font-size:small;text-align:right;width:50%;"
   ><?= $dice[$_POST[$att]/$skills[$att]] ?></span><br/>
<?php } ?>
<?php } ?>
</td>

<td style="vertical-align:top; height:1.5in; border: thin solid black; width:2in" colspan=1>
<span style="width:100%;float:left;font-weight:bold;text-align:left;border-bottom:thin solid black;">Edges / Hindrances / Abilities</span>
<div style='font-size:small; padding:1px' >
<?php foreach( $edges as $att => $value ){ ?>
<?php if($_POST[$att]){ ?>
<?=  ucwords( str_replace( "_", " ", $att ) ) ?><br/>
<?php } ?>
<?php } ?>
<?php foreach( $hindrances as $att => $value ){ ?>
<?php if($_POST[$att]){ ?>
<?=  ucwords( str_replace( "_", " ", $att ) ) ?><br/>
<?php } ?>
<?php } ?>
<?= $_POST['flying_pace']?" *Flight:".$_POST['flying_pace'].'" ':"" ?>
<?php foreach( $special_abilities as $att => $value ){ ?>
<?php if($_POST[$att]){ ?>
<?=  ucwords( str_replace( "_", " ", $att ) ) ?><br/>
<?php } ?>
<?php } ?>
<?php if($_POST['special_ability_description']){ ?>
<?=  str_replace("[BR]","<br/>", $_POST['special_ability_description'] ) ?><br/>
<?php } ?>
<?php foreach( $powers as $att => $value ){ ?>
<?php if($_POST[$att]){ ?>
<?=  ucwords( str_replace( "_", " ", $att ) ) ?>, 
<?php } ?>
<?php } ?>
</div>
</td>
<td style="vertical-align:top; height:1.7in;width:1in;font-size:small;" colspan=2>
<?php if( $_POST['wildcard'] ){ ?>
<div style="width:100%;border:thin solid black;text-align:center;"><b>Wounds</b></div>
<div style="width:100%;text-align:right;">-1<input type="checkbox"/></div>
<div style="width:100%;text-align:right;">-2<input type="checkbox"/></div>
<div style="width:100%;text-align:right;">-3<input type="checkbox"/></div>
<?php } else { ?>
<div style="width:100%;border:thin solid black;text-align:center;"><b>Ammo</b></div>
<div style="width:100%;text-align:right;">Very High<input type="checkbox"/></div>
<div style="width:100%;text-align:right;">High<input type="checkbox"/></div>
<div style="width:100%;text-align:right;">Low<input type="checkbox"/></div>
<div style="width:100%;text-align:right;">Out<input type="checkbox"/></div>
<?php } ?>
<div style="width:100%;border:thin solid black; text-align:right;font-size:small;">Incapacitated<input type="checkbox"/></div>
<div style="width:100%;text-align:right;">-2<input type="checkbox"/></div>
<div style="width:100%;text-align:right;">-1<input type="checkbox"/></div>
<div style="width:100%;border:thin solid black;text-align:center;"><b>Fatigue</b></div>
</td>
</tr>




<tr>
<td style="vertical-align:top; height:.5in; border: thin solid black;width:100%" colspan=5>
<div style="font-size:small;" >
<span style="padding:1px;font-size:small;float:left;font-weight:bold;text-align:left;border-bottom:thin solid black;border-right:thin solid black;">Equipment&nbsp;</span>
&nbsp;&nbsp;
<?php foreach( $armorList as $att => $value ){ ?>
<?php if($_POST[$att]){ ?>
<?=  $equipmentDescrList[$att]?$equipmentDescrList[$att]:ucwords( str_replace( "_", " ", $att ) ) ; ?>,&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php foreach( $handWpnList as $att => $value ){ ?>
<?php if($_POST[$att]){ ?>
<?=  $equipmentDescrList[$att]?$equipmentDescrList[$att]:ucwords( str_replace( "_", " ", $att ) ) ; ?>,&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<!--#Type	Range	Damage	Cost	Min Str.	Notes-->
<?php foreach( $rangedWeaponData as $att => $value ){ ?>
<?php if($_POST[$att]){ ?>
<?=  $value[0]."[".$value[1]." ".$value[2] ?><? count($value)>3?"":$value[5]?>],&nbsp;&nbsp;
<?php } ?>
<?php } ?>
<?php if($_POST['special_equipment_description']){ ?>
<?=  $_POST['special_equipment_description']?>
<?php } ?>
</div>
</td>
</tr>
</table>
</div>
<!--
<?php print_r( $_POST ) ?>
-->
</body>
</html>

