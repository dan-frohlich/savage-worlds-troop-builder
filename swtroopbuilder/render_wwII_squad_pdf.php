<?
require '../fpdf16/fpdf.php';
include 'data.php';


class PDF extends FPDF
{


function PDF($orientation='L',$unit='in', $format='letter')
{
    //Call parent constructor
    $this->FPDF($orientation,$unit,$format);
    $this->SetAutoPageBreak( true, 0 );
}


//Page header
function Header()
{
    $this->SetFont('Courier','B',14);
    $this->Text( 0.1, 0.3, $_REQUEST['name'] );
    //Logo
    #$this->Image("images/msh.png",2,0.1,0.9);
    $this->Image("wwII_squad.png",0,0,8,5);
    //Arial bold 15
    $this->SetFont('Arial','B',15);
}

//Page footer
#function Footer()
#{
#}
}

// include 'constants.php';

$drawborder=0;

//Instanciation of inherited class
$pdf=new PDF('L','in', array(5,8) );
#$pdf->AliasNbPages();
$pdf->AddPage('L');

#-- Set Name
$pdf->SetFont('Courier','B',10);
$pdf->setXY( 2.6, 0.4 );
$troopCount = $_POST['count'];
$troop_name = $_POST['troop_name'] . ($_POST['count']?" (".$_POST['count'].")":"") . ($_POST['wildcard']?" *":"");

$pdf->Cell( 3.3, 0.20, $troop_name, $drawborder, 0,"C", false );


#-- RENDER DERIVED STATS...
$pdf->SetFont('Courier','B',12);

    $pace = $_POST['pace'];
    if( $_POST['flying_pace'])
        $pace .= "/".$_POST['flying_pace']."*";


    $parryBns = 0;
    foreach( $parryBnsList as $key => $val ){
        if( $_POST[$key] ){
            $parryBns += $val;
        }
    }
    if( $_POST['other_parry_bonus'] ){
        $parryBns += $_POST['other_parry_bonus'];
    }
    $parry = $_POST['fighting']?(($_POST['fighting']/2)+3+$parryBns):2+$parryBns;

    $armorBns = 0;
    foreach( $armorBnsList as $key => $val ){
        if( $_POST[$key] )
            $armorBns += $val;
    }
    if( $_POST['other_armor_bonus'] ){
        $armorBns += $_POST['other_armor_bonus'];
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

    $toughness = ($_POST['vigor']+$_POST['size'])+3+$armorBns+$toughnessBns ;
    $toughness .= ( $armorBns?"({$armorBns})":"" );

$pdf->setXY( 5.98, 0.30 );
$pdf->Cell( 0.55, 0.33, $pace, $drawborder, 0,"C", false );
$pdf->setX( 6.6);
$pdf->Cell( 0.55, 0.33, $parry, $drawborder, 0,"C", false );
$pdf->setX( 7.21);
$pdf->Cell( 0.55, 0.33, $toughness, $drawborder, 0,"C", false );


# -- render hindrances
# 0.5in oer 7 characters
$pdf->SetFont('Courier','B',8);
$pdf->setXY( 2.25, 1.08 );
$count = 0;
$hindrancesList = "";
$hindrancesList2 = "";
foreach( $hindrances as $att => $value ){
    if($_POST[$att]){
        $value = ucwords( str_replace( "_", " ", $att ) );
        #$pdf->Cell( 0.5, 0.19, $value, $drawborder, 2,"L", false );
        $hindrancesList .= ", ".$value;
    }
}
$hindrancesList = substr( $hindrancesList, 2);
$pdf->Cell( 4.6, 0.15, $hindrancesList, $drawborder, 2,"L", false );

# -- render edges
# 0.5in oer 7 characters
$pdf->SetFont('Courier','B',8);
$pdf->setXY( 1.9, 0.66 );
$count = 0;
$edgeList = "";
$edgeList2 = "";
foreach( $edges as $att => $value ){
    if($_POST[$att]){
        $value = ucwords( str_replace( "_", " ", $att ) );
        #$pdf->Cell( 0.5, 0.19, $value, $drawborder, 2,"L", false );
        if(( strlen( $edgeList ) + strlen($value)+2)-2 < 56 )
        {
            $edgeList .= ", ".$value;
        } else {
            $edgeList2 .= ", ".$value;
        }
    }
}
foreach( $special_abilities as $att => $value ){
    if($_POST[$att]){
        $value = ucwords( str_replace( "_", " ", $att ) );

        if( $value == 'Size' )
            $value = 'Size: '.$_POST['size'];

        #$pdf->Cell( 0.5, 0.19, $value, $drawborder, 2,"L", false );
        if(( strlen( $edgeList ) + strlen($value)+2)-2 < 56 )
        {
            $edgeList .= ", ".$value;
        } else {
            $edgeList2 .= ", ".$value;
        }
    }
}

if($_POST['special_ability_description']){
    $value = $_POST['special_ability_description'];
        if(( strlen( $edgeList ) + strlen($value)+2)-2 < 56 )
        {
            $edgeList .= ", ".$value;
        } else {
            $edgeList2 .= ", ".$value;
        }
}


$edgeList = substr( $edgeList, 2);
$edgeList2 = substr( $edgeList2, 2);
$pdf->Cell( 4.0, 0.15, $edgeList, $drawborder, 2,"L", false );
$pdf->setXY( 1.5, 0.85 );
$pdf->Cell( 5.4, 0.15, $edgeList2, $drawborder, 2,"L", false );







if( $_POST['flying_pace'] )
{
    if( $count == 4 )
            $pdf->setXY( 1.9, 1.05 );
    $count++;
    $att = "*Flying: ".$_POST['flying_pace'].'"';
    $value = ucwords( str_replace( "_", " ", $att ) );
    $pdf->Cell( 1.0, 0.12, $value, $drawborder, 2,"L", false );
}
#-foreach( $special_abilities as $att => $value ){
#-    if($_POST[$att]){
#-        if( $count == 4 )
#-            $pdf->setXY( 1.9, 1.05 );
#-        $count++;
#-        $value = ucwords( str_replace( "_", " ", $att ) );
#-        if( $value == 'Size' )
#-            $value = 'Size: '.$_POST['size'];
#-        $pdf->Cell( 1.0, 0.12, $value, $drawborder, 2,"L", false );
#-    }
#-}

#-if($_POST['special_ability_description']){
#-    if( $count == 4 )
#-        $pdf->setXY( 1.9, 1.05 );
#-    $value = $_POST['special_ability_description'];
#-    $pdf->Cell( 1.0, 0.12, $value, $drawborder, 2,"L", false );
#-}


#-- RENDER SKILLS...
$pdf->SetFont('Courier','B',9);
$pdf->setXY( 0.4, 1.84 );
foreach( $skills as $att => $value ){
    if( $attack_skills[$att] == null ) {
        if($dice[$_POST[$att]-1]){
           $pdf->setX( 0.35);
           $pdf->Cell( 0.5, 0.215, substr( $dice[$_POST[$att]-1],1), $drawborder, 0,"L", false );
           $pdf->Cell( 0.90, 0.215, ucwords( $att ), $drawborder, 2,"R", false );
        }
    }else{
        if($dice[$_POST[$att]/3]){
           $pdf->setX( 0.35);
           $pdf->Cell( 0.5, 0.215, substr( $dice[$_POST[$att]/3],1), $drawborder, 0,"L", false );
           $pdf->Cell( 0.90, 0.215, ucwords( $att ), $drawborder, 2,"R", false );
        }
    }
}





#-- RENDER ATTRIBUTES...
$pdf->SetFont('Courier','B',9);
$pdf->setXY( 1.0, 0.27 );
foreach( $attributes as $att ){
    $val =  $dice[$_POST[$att]];
    $pdf->Cell( 0.44, 0.255, $val, $drawborder, 2,"L", false );
}

#-- Render ranged Weapons
$pdf->SetFont('Courier','B',6);
$pdf->setXY( 1.90, 3.77 );

$nameCellWidth=1.4;
$rangeCellWidth=1.2;
$damageCellWidth=0.7;
$notesCellWidth=1;
$wpnCellHeight=0.20;

foreach( $rangedWeaponData as $att => $value ){
    if($_POST[$att]){
        $pdf->setX( 1.90 );
        #Type	Range	Damage	Cost	Min Str.	Notes
        $pdf->Cell( $nameCellWidth, $wpnCellHeight, $value[0], $drawborder, 0,"L", false );
        $pdf->Cell( $rangeCellWidth, $wpnCellHeight, $value[1], $drawborder, 0,"L", false );
        $pdf->Cell( $damageCellWidth, $wpnCellHeight, $value[2], $drawborder, 0,"L", false );
        if( count( $value) > 3 ){
            $pdf->Cell( $notesCellWidth, $wpnCellHeight, $value[5], $drawborder, 2,"L", false );
        }
    }
}
#-- Render other Weapons
foreach( $handWpnList as $att => $value ){
    if($_POST[$att]){
        $pdf->setX( 1.90 );
        $val = $equipmentDescrList[$att]?$equipmentDescrList[$att]:ucwords( str_replace( "_", " ", $att ) ) ;
        $val = str_replace( "]","",$val );
        $valz = explode("[",$val);
        $pdf->Cell( $nameCellWidth, $wpnCellHeight, $valz[0], $drawborder, 0,"L", false );
        $details = explode(",", $valz[1] );
        $damage = $details[0];
        if( substr($damage,0,1) == '+')$damage = "Str".$damage;
        $pdf->Cell( $rangeCellWidth, $wpnCellHeight, $details[1], $drawborder, 0,"L", false );
        if( $details[2] )
        {
            $pdf->Cell( $damageCellWidth, $wpnCellHeight, $damage, $drawborder, 0,"L", false );
            $pdf->Cell( $notesCellWidth, $wpnCellHeight, $details[2], $drawborder, 2,"L", false );
        }
        else
        {
            $pdf->Cell( $damageCellWidth, $wpnCellHeight, $damage, $drawborder, 2,"L", false );
        }
    }
}

#-- Render powers
$pdf->SetFont('Courier','B',5);
$pdf->setXY( 0.05, 4.12 );
foreach( $powers as $att => $value ){
    if($_POST[$att]){
        $pdf->setX( 0.05);
        $pdf->Cell( 0.65, 0.155, ucwords( str_replace( "_", " ", $att)), $drawborder, 2,"L", false );
    }
}
#-- Render Armor
$pdf->SetFont('Courier','B',8);
$pdf->setY( 1.60 );
$pdf->setX( 5.0);
$count=0;
foreach( $armorList as $att => $value ){
    if($_POST[$att]){
        $count++;
        $val = $equipmentDescrList[$att]?$equipmentDescrList[$att]:ucwords( str_replace( "_", " ", $att ) ) ;
        $pdf->Cell( 1.50, 0.215, $val, $drawborder, 2,"L", false );
       #$pdf->Cell( 0.5, 0.215, substr( $dice[$_POST[$att]/$skills[$att]],1), $drawborder, 0,"L", false );
    }
}

if($_POST['special_equipment_description']){
    $value = $_POST['special_equipment_description'];
    $valuez = split("\n", $value);
    foreach( $valuez as $value )
        $pdf->Cell( 1.50, 0.215, $value, $drawborder, 2,"L", false );
}


$pdf->SetFont('Courier','B',9);
$pdf->SetFillColor(255,255,255);
$pdf->setXY( 7.25, 4.40 );
if( $_POST['count'] ){
    $troopCost = $_POST['count']*$_POST['cost'];
    if( $_POST['count'] > 1 )
        $troopCost = $troopCost * 0.75;
} else {
    $troopCost = $_POST['cost'];
}
$troopCost = round( $troopCost/5 );

$pdf->Cell( 0.5, 0.28, $troopCost." ", $drawborder, 0,"R", true );





$pdf->Output( );


?>
