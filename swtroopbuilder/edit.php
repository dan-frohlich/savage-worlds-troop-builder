<html>
<head>
<? include 'data.php'; ?>
<? # include 'ranged_weapon_table.php'; ?>
<link href="style.css" rel="stylesheet" type="text/css" />

<!-- dhtml tabs -->
   <style type="text/css">
      body { background-color: white; }
      #tabs {
        display: block;
        float: left;
        width: 100%;
      }
      a.tab {
        border-collapse: collapse;
        border-style: solid solid none solid;
        border-color: black;
        border-width: 1px 1px 0px 1px;
        background-color: #AAF;
        padding: 2px 0.5em 0px 0.5em;
        margin-top: 4px;
        margin-right: 2px;
        /*font-family: arial; */
        text-decoration: none;
        float: left;
      }
      a.tab:hover {
        border-color: black;
        background-color: white;
      }
      /*
       .panel { border: solid 1px black; background-color: white; padding: 5px; height: 300px; overflow: auto;}
       */
      .panel { }
    </style>

    <script language="JavaScript" type="text/javascript">
      var panels = new Array('panel0', 'panel1', 'panel2', 'panel3', 'panel4', 'panel5', "panel6" );
      var selectedTab = null;
      function showPanel(tab, name)
      {
        if (selectedTab)
        {
          selectedTab.style.backgroundColor = '';
          selectedTab.style.paddingTop = '';
          selectedTab.style.marginTop = '4px';
        }
        selectedTab = tab;
        selectedTab.style.backgroundColor = 'white';
        selectedTab.style.paddingTop = '6px';
        selectedTab.style.marginTop = '0px';
        for(i = 0; i < panels.length; i++)
        {
          document.getElementById(panels[i]).style.display = (name == panels[i]) ? 'block':'none';
        }
        return false;
      }
    </script>


<script type="text/javascript" src="json2.js"></script>
<script type="text/javascript">
function loaded(){
}
function load(){
    document.forms[0].action="load.php";
    document.forms[0].TARGET="_self";
    document.forms[0].submit();
    return false;
}
function save(){
    document.forms[0].action="save.php";
    document.forms[0].TARGET="_self";
    document.forms[0].submit();
    return false;
}
function print(){
    document.forms[0].action="print.php";
    //window.open('print.php','printwin');
    document.forms[0].TARGET="printwin";
    document.forms[0].submit();
    return false;
}
function pdf(){
    //document.forms[0].action="render_pdf.php";
    document.forms[0].action="choosePdf.php";
    document.forms[0].TARGET="printwin";
    document.forms[0].submit();
    return false;
}
function computeCost(){
    //alert("called comp cost " );
    var cost=0;
    cost += (document.forms[0].pace.value*1)-6;
    if( document.forms[0].flying_pace.value > 0 )
    {
        cost += (document.forms[0].flying_pace.value*1)+5;
    }

    var dietype = (document.forms[0].agility.value*2)+2;
    cost += dietype-4;
    dietype = (document.forms[0].smarts.value*2)+2;
    cost += dietype-4;
    dietype = (document.forms[0].spirit.value*2)+2;
    cost += dietype-2;
    dietype = (document.forms[0].strength.value*2)+2;
    cost += dietype-2;
    dietype = (document.forms[0].vigor.value*2)+2;
    cost += ((dietype/2-1)*3);
//alert( 'cost1: ' + cost );
<?php foreach( $skills as $skill => $skillCost ) if($skillCost) { ?>
    cost += (document.forms[0].<?= $skill ?>.value*1-1);
    if( document.forms[0].<?= $skill ?>.value*1 > 0 ){
//alert( 'skill <?= $skill ?> cost: ' + ((document.forms[0].<?= $skill ?>.value*1)-1) );
    }
<?php } ?>
//alert( 'cost2: ' + cost );
<?php foreach( $edges as $edge => $edgeCost ){ ?>
    if(document.forms[0].<?= $edge ?>.checked){
        cost += <?= $edgeCost ?>;
    }
<?php } ?>
//alert( 'cost3: ' + cost );
<?php foreach( $powers as $power => $powerCost ){ ?>
    if(document.forms[0].<?= $power ?>.checked){
        cost += <?= $powerCost ?>;
    }
<?php } ?>
//alert( 'cost4: ' + cost );
<?php foreach( $hindrances as $hindrance => $hindranceCost ){ ?>
    if(document.forms[0].<?= $hindrance ?>.checked){
        cost += <?= $hindranceCost ?>;
    }
<?php } ?>

//alert( 'cost5: ' + cost );
<?php foreach( $special_abilities as $ability => $abilityCost ){ ?>
<?php if( $abilityCost != "var") { ?>
    if(document.forms[0].<?= $ability ?>.checked){
        cost += <?= $abilityCost ?>;
    }
<?php } ?>
<?php } ?>

//alert( 'cost6: ' + cost );
<?php foreach( $armorList as $armor => $armorCost )if($armorCost){ ?>
    if(document.forms[0].<?= str_replace("(","_", str_replace( ")","_", $armor)) ?>.checked){
        cost += <?= $armorCost ?>;
    }
<?php } ?>
//alert( 'cost7: ' + cost );
<?php foreach( $handWpnList as $handWpn => $handWpnCost ){ ?>
<?php if( $handWpnCost != "title") { ?>
    if(document.forms[0].<?= $handWpn ?>.checked){
        cost += <?= $handWpnCost ?>;
        //cost += (1*document.forms[0].strength.value) + 1;
    }
<?php } ?>
<?php } ?>

<?php # TODO replace with rangedWeaponData ?>
//alert( 'cost8: ' + cost );
<?php foreach( $rangedWeaponData as $wpnId => $weapon ) if( count( $weapon) > 1  ){ ?>
    if(document.forms[0].<?= $wpnId ?>.checked){
        cost += <?= $weapon[3] ?>;
    }
<?php } ?>
    ////alert(cost);
    cost += ((document.forms[0].size.value)*3);

    cost += (1*document.forms[0].special_ability_cost.value);
    cost += (1*document.forms[0].special_equipment_cost.value);

    if( document.forms[0].wildcard.checked)
        cost *=2;


    //add mounts / vehicle cost ?
//alert( 'cost9: ' + cost );


    document.forms[0].displaycost.value = cost;
    document.forms[0].cost.value = cost;
    return false;
    ////alert(document.forms[0].cost.value);
}
</script>
</head>
<body onLoad="loaded();computeCost();showPanel(document.getElementById('tab0'), 'panel0');">
  <?php if( $_REQUEST['load_data'] ) { ?>
<!--
json data:
  <?php $data = json_decode( str_replace("\\", "", $_REQUEST['load_data'] ), true ); ?>
 <?php print_r( $data )?>
-->
  <?php } ?>
<form action="print.php" method="post" >
<input name="cost" type="hidden" value="<?= $data['cost'] ?>" />
<table style="border:thin solid blue;float:left;">
<tr>
  <td><a href="." ><img src="../images/icons/house.png"/> Home</a></td>
  <td><span  class="disabled_link" disabled="true" ><img src="../images/icons/page_edit.png"/> Edit Unit</span></td>
  <td><a href="#" onClick="load();" ><img src="../images/icons/folder.png"/> Load Unit</a></td>
  <td><a href="#" onClick="save();" ><img src="../images/icons/disk.png"/> Save Unit</a></td>
  <td ><a href="#" onClick="pdf();"  ><img src="../images/icons/page_white_acrobat.png"/> PDF</a></td>
</tr>
</table>
<h3>&nbsp;&nbsp;&nbsp;Savage Worlds Troop Builder</h3>
<table>
<tr>
  <th>Troop Name:</th>
  <td><input name="troop_name" type="text" value="<?= $data['troop_name'] ?>"/></td>
  <th>Size:</th>
  <td>
  <select name="size" onChange="computeCost();" >
<?php $index = $data['size'] ?>
<?php for($i=-2;$i<11;$i++){ ?>
<option <?= $i==$index?"SELECTED":""?>><?= $i ?></option>
<?php } ?>
  </select>
  </td>
  <th>Count:</th>
  <td><input class="number" name="count" type="text" value="<?= $data['count'] ?>" /></td>
  <td><input name="wildcard" type="checkbox" onClick="computeCost();" <?= $data['wildcard']?"CHECKED":"" ?>/> Is Wild Card</td>
  <th>Cost:</th>
  <td><input class="number" disabled name="displaycost" type="text" value="0" /></td>
</tr>
</table>

<table style="float:left; border:thin solid blue; width:200px;">
<tbody style="border: solid #0000FF; ">
<tr>
  <td colspan=2 style="border-bottom: medium double blue;color:blue;" ><b>Attributes</b></td>
</tr>
<?php foreach( $attributes as $att ){ ?>
<tr>
  <th><?= ucwords( $att ) ?>:</th>
  <td>
    <select name="<?= $att ?>" onChange="computeCost();" >
<?php foreach( $dice as $value => $die) if($value>0){ ?>
      <option <?= ($data[$att] == $value)?"SELECTED":""?> value="<?= $value ?>"><?= $die ?></option>
<?php } ?>
    </select>
  </td>
</tr>
<?php } ?>
<tr>
  <td colspan=2 style="border-bottom: medium double blue;color:blue;" ><b>Skills</b></td>
</tr>
</tbody>
<?php foreach( $skills as $skill => $skillCost) if($skillCost){ ?>
<tr>
  <th><?= ucwords( $skill ) ?>:</th>
  <td>
    <select name="<?= $skill ?>" onChange="computeCost();" >
<?php if( $attack_skills[$skill] != null ) { ?>
<?php foreach( $dice as $value => $die) { ?>
      <option <?=  ($data[$skill] == $value *3)?"SELECTED":"" ?> value="<?= $value *3 ?>"><?= $die ?></option>
<?php } # end foreach dice?>
<?php } else { ?>
<?php foreach( $dice as $value => $die) { ?>
      <option <?=  ($data[$skill] == $value +1 )?"SELECTED":"" ?> value="<?= $value +1  ?>"><?= $die ?></option>
<?php } # end foreach dice?>
<?php } # end if...else ?>
    </select>
<?php if( $attack_skills[$skill] != null ) { ?><b style='color:red'>*</b><?php } ?>
  </td>
</tr>
<?php } ?>
<tr>
</tr>

<!--</table>
<div  style="float: left;">&nbsp;</div>
<table style="float: left; border:thin solid blue;">
-->
<tr>
  <td colspan=2 style="border-bottom: medium double blue;color:blue;" ><b>Hindrances</b></td>
</tr>
<?php $newline=0; ?>
<?php foreach( $hindrances as $hind => $hindCost ) { ?>
<?php $hindTitle = ucwords( str_replace( "_", " ", $hind ) ); ?>
<?php #if(!$newline){?><tr><?php #} ?>
  <td colspan=2><input onClick="computeCost();" type=checkbox <?= $data[$hind]?"CHECKED":"" ?>
      name="<?= $hind ?>" /><?= $hindTitle ?> (<?= $hindCost ?>)</td>
<?php #if($newline){?></tr><?php #} ?>
<?php $newline=!$newline; } ?>
</table>

<div  style="float: left;">&nbsp;</div>

<div style="float: left;">
 <div id="tabs">
    <a href="" class="tab" onmousedown="return event.returnValue = showPanel(this, 'panel0');" id="tab0" onclick="return false;">Movement</a>
    <a href="" class="tab" onmousedown="return event.returnValue = showPanel(this, 'panel1');" onclick="return false;">Edges</a>
    <a href="" class="tab" onmousedown="return event.returnValue = showPanel(this, 'panel2');" onclick="return false;">Special Abilities</a>
    <a href="" class="tab" onmousedown="return event.returnValue = showPanel(this, 'panel3');" onclick="return false;">Ranged Weapons</a>
    <a href="" class="tab" onmousedown="return event.returnValue = showPanel(this, 'panel4');" onclick="return false;">Hand Weapons</a>
    <a href="" class="tab" onmousedown="return event.returnValue = showPanel(this, 'panel5');" onclick="return false;">Armor</a>
    <a href="" class="tab" onmousedown="return event.returnValue = showPanel(this, 'panel6');" onclick="return false;">Powers</a>
  </div>



<div class="panel" id="panel0" style="display: block">
<table style="float: left; border:thin solid blue; width:100%; ">

<tr>
  <td colspan=3 style="border-bottom: medium double blue;color:blue;" ><b>Movement</b></td>
</tr>
<?php
    $pace = 6;
    if( $data['pace'] )$pace = $data['pace'];
    $flying_pace = 0;
    if( $data['flying_pace'] )$flying_pace = $data['flying_pace'];
?>
  <tr><th style="width:90px" >Pace:</th><td><input size=3 onChange="computeCost();" type=text name="pace" value="<?= $pace ?>" /></td></tr>
  <tr><th>Flying Pace:</th><td><input size=3 onChange="computeCost();" type=text name="flying_pace" value="<?= $flying_pace ?>"/></td></tr>
 <!-- <tr><th>Burrowing Pace:</th><td><input onChange="computeCost();" type=text name="burrowing_pace" /></td></tr>-->
</table>
</div>

<div class="panel" id="panel1" style="display: block">
<table style="float: left; border:thin solid blue; width:100%; ">

<tr>
  <td colspan=3 style="border-bottom: medium double blue;color:blue;" ><b>Edges</b></td>
</tr>
<?php $newline=0; ?>
<?php foreach( $edges as $edge => $edgeCost ) { ?>
<?php $edgeTitle = ucwords( str_replace( "_", " ", $edge ) ); ?>
<?php if($newline%3==0){?><tr><?php } ?>
  <td><input onClick="computeCost();" type=checkbox  <?= $data[$edge]?"CHECKED":"" ?>
     value="<?=$edgeCost?>" name="<?= $edge ?>" /><?= $edgeTitle ?> (<?= $edgeCost ?>)</td>
<?php if(($newline%3==2)){?></tr><?php } ?>
<?php $newline += 1; } ?>

</table>
</div>


<div class="panel" id="panel2" style="display: none">
<table style="float: left; border:thin solid blue; width:100%;">
<tr>
  <td colspan=3 style="border-bottom: medium double blue;color:blue;" ><b>Special Abilities</b></td>
</tr>
<?php $newline=0; ?>
<?php foreach( $special_abilities as $sa => $saCost ) { ?>
<?php $saTitle = ucwords( str_replace( "_", " ", $sa ) ); ?>
<?php if($newline%3==0){?><tr><?php } ?>
<?php if( $saCost == "var") { ?>
<td><i><?= $saTitle ?>&nbsp;*</i></td>
<?php } else { ?>
  <td><input onClick="computeCost();" type=checkbox  <?= $data[$sa]?"CHECKED":"" ?>
     value="<?=$saCost?>" name="<?= $sa ?>" /><?= $saTitle ?> (<?= $saCost ?>)</td>
<?php } ?>
<?php if(($newline%3==2)){?></tr><?php } ?>
<?php $newline += 1; } ?>
<tr>
  <td colspan=3 >&nbsp;<i>* These are variable cost Abilities which may be entered in the Extra Special Abilities (free-form) input area below.</i></td>
</tr>

<tr>
  <td colspan=3 style="border-bottom: medium double blue;color:blue;" ><b>Extra Special Abilities and Equipment</b></td>
</tr>
<tr>
  <th>Other Armor Bonus:</th>
  <td><input type='text' class='number' name='other_armor_bonus' value='<?= $data['other_armor_bonus'] ?>' onChange="computeCost();"/></td>
</tr>
<tr>
  <th>Other Parry Bonus:</th>
  <td><input type='text' class='number' name='other_parry_bonus' value='<?= $data['other_parry_bonus'] ?>' onChange="computeCost();"/></td>
</tr>
<tr>
  <th>Other Toughness Bonus:</th>
  <td><input type='text' class='number' name='other_toughness_bonus' value='<?= $data['other_toughness_bonus'] ?>' onChange="computeCost();"/></td>
</tr>
<tr>
  <th>Special Ability Cost:</th>
  <td><input type='text' class='number' name='special_ability_cost' value='<?= $data['special_ability_cost'] ?>' onChange="computeCost();"/></td>
</tr>
<tr>
  <th valign='top'>Special Ability Description:</th>
  <td colspan=2>
	<textarea name="special_ability_description" rows="3" cols="40" ><?= $data['special_ability_description'] ?></textarea>
  </td>
</tr>

<tr>
  <th>Special Equipment Cost:</th>
  <td><input type='text' class='number' name='special_equipment_cost' value='<?= $data['special_equipment_cost'] ?>' onChange="computeCost();"/></td>
</tr>
<tr>
  <th valign='top'>Special Equipment Description:</th>
  <td colspan=2>
	<textarea name="special_equipment_description" rows="3" cols="40" ><?= $data['special_equipment_description'] ?></textarea>
  </td>
</tr>

</table>
</div>

<div class="panel" id="panel3" style="display: none">
<table style="float: left; border:thin solid blue; width:100%;">
<tr>
  <td colspan=2 style="border-bottom: medium double blue;color:blue;" ><b>Ranged Weapons</b></td>
</tr>
<?php
#type	Range	Damage	Cost	Min Str.	Notes
?>
<?php foreach( $rangedWeaponData as $wpnId => $weapon ) { ?>
<?php if( count( $weapon) > 0  ) { ?>
<?php $title = ucwords( str_replace( "_", " ", $weapon[0] ) ); ?>
<?php if( count( $weapon) == 1  ) { ?>
<tr>
  <td colspan=2 style="border-bottom: thin solid blue;color:blue;" ><?= $title ?></td>
</tr>
<?php } else { ?>
<?php $cost = $weapon[3]; ?>
<tr>
  <td><input onClick="computeCost();" type=checkbox  <?= $data[$title]?"CHECKED":"" ?>
        value="<?=$cost?>" name="<?= $wpnId ?>" /><?= $title ?> (<?= $cost ?>)</td>
</tr>
<?php } ?>
<?php } ?>
<?php } ?>
</table>
</div>

<div class="panel" id="panel4" style="display: none">
<table style="float: left; border:thin solid blue; width:100%;">
<tr>
  <td colspan=2 style="border-bottom: medium double blue;color:blue;" ><b>Hand Weapons</b></td>
</tr>
<?php foreach( $handWpnList as $handWpn => $handWpnCost ) { ?>
<?php $handWpnTitle = ucwords( str_replace( "_", " ", $handWpn ) ); ?>
<?php if( $handWpnCost == "title") { ?>
  <td colspan=2 style="border-bottom: thin solid blue;color:blue;" ><?= $handWpnTitle ?></td>
<?php } else { ?>
<tr>
  <td><input onClick="computeCost();" type=checkbox  <?= $data[$handWpn]?"CHECKED":"" ?>
        value="<?=$handWpnCost?>" name="<?= $handWpn ?>" /><?= $handWpnTitle ?> (<?= $handWpnCost ?>)</td>
</tr>
<?php } ?>
<?php } ?>
</table>
</div>

<div class="panel" id="panel5" style="display: none">
<table style="float: left; border:thin solid blue; width:100%;">
<tr>
  <td colspan=2 style="border-bottom: medium double blue;color:blue;" ><b>Armor</b></td>
</tr>
<?php foreach( $armorList as $armor => $armorCost ) { ?>
<?php $armorTitle = ucwords( str_replace( "_", " ", $armor ) ); ?>
<tr>
  <?php if( $armorCost ) { ?>
  <td><input onClick="computeCost();" type=checkbox <?= $data[$armor]?"CHECKED":"" ?>
     value="<?=$armorCost?>" name="<?= str_replace("(","_", str_replace( ")","_", $armor)) ?>" /><?= $armorTitle ?> (<?= $armorCost ?>)</td>
  <?php } else { ?>
  <td colspan=2 style="border-bottom: thin solid blue;color:blue;" ><?= $armorTitle ?></td>
  <?php } ?>
</tr>
<?php } ?>
</table>
</div>




<div class="panel" id="panel6" style="display: none">
<table style="float: left; border:thin solid blue; width:100%;">
<tr>
  <td colspan=2 style="border-bottom: medium double blue;color:blue;" ><b>Powers</b></td>
</tr>
<?php foreach( $powers as $power => $powerCost ) { ?>
<?php $powerTitle = ucwords( str_replace( "_", " ", $power ) ); ?>
<tr>
  <td><input onClick="computeCost();" type=checkbox  <?= $data[$power]?"CHECKED":"" ?>
        value="<?=$powerCost?>" name="<?= $power ?>" /><?= $powerTitle ?> (<?= $powerCost ?>)</td>
</tr>
<?php } ?>
</table>
</div>


</div>
</form>
</body>
</html>

