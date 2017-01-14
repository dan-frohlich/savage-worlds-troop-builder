<?
require '../fpdf16/fpdf.php';
include 'data.php';


class PDF extends FPDF
{


function PDF($orientation='P',$unit='in', $format='letter')
{
    //Call parent constructor
    $this->FPDF($orientation,$unit,$format);
    $this->SetAutoPageBreak( true, 0 );
}


//Page header
function Header()
{
    $this->SetFont('Times','B',14);
    $this->Text( 0.1, 0.3, $_REQUEST['name'] );
    //Logo
    #$this->Image("images/msh.png",2,0.1,0.9);
    $this->Image("condemo_sheet_web.jpg",0,0,3,5);
    //Arial bold 15
    $this->SetFont('Arial','B',15);
}

//Page footer
#function Footer()
#{
#}
}

include 'constants.php';


//Instanciation of inherited class
$pdf=new PDF('P','in', array(3,5) );
#$pdf->AliasNbPages();
$pdf->AddPage('P');

#-- Set Name
$pdf->SetFont('Times','B',6);
$pdf->setXY( 0.05, 0.22 );
$troopCount = $_POST['count'];
$troop_name = $_POST['troop_name'] . ($_POST['count']?" (".$_POST['count'].")":"") . ($_POST['wildcard']?" *":"");

$pdf->Cell( 1.0, 0.14, $troop_name, 0, 0,"C", false );


#-- RENDER DERIVED STATS...
$pdf->SetFont('Times','B',10);

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
    $toughness .= ( $armorBns?" ({$armorBns})":"" );

$pdf->setXY( 1.15, 0.12 );
$pdf->Cell( 0.2, 0.18, $pace, 0, 0,"C", false );
$pdf->setXY( 1.6, 0.12 );
$pdf->Cell( 0.2, 0.18, $parry, 0, 0,"C", false );
$pdf->setXY( 2.1, 0.12 );
$pdf->Cell( 0.2, 0.18, $toughness, 0, 0,"C", false );

$pdf->SetFont('Times','B',7);
$pdf->SetFillColor(255,255,255);
$pdf->setXY( 2.42, 0.10 );
if( $_POST['count'] )
    $troopCost = $_POST['count']*$_POST['cost'];
else
    $troopCost = $_POST['cost'];
$pdf->Cell( 0.5, 0.28, $troopCost." Points", 0, 0,"R", true );




# -- render hindrances
$pdf->SetFont('Times','B',7);
$pdf->setXY( 0.9, 0.6 );
$count = 0;
foreach( $hindrances as $att => $value ){
    if($_POST[$att]){
        if( $count == 2 )
            $pdf->setXY( 1.9, 0.6 );
        $count++;
        $value = ucwords( str_replace( "_", " ", $att ) );
        $pdf->Cell( 1.0, 0.12, $value, 0, 2,"L", false );
    }
}
# -- render edges
$pdf->SetFont('Times','B',5);
$pdf->setXY( 0.9, 1.05 );
$count = 0;
foreach( $edges as $att => $value ){
    if($_POST[$att]){
        if( $count == 4 )
            $pdf->setXY( 1.9, 1.05 );
        $count++;
        $value = ucwords( str_replace( "_", " ", $att ) );
        $pdf->Cell( 1.0, 0.12, $value, 0, 2,"L", false );
    }
}
if( $_POST['flying_pace'] )
{
    if( $count == 4 )
            $pdf->setXY( 1.9, 1.05 );
    $count++;
    $att = "*Flying: ".$_POST['flying_pace'].'"';
    $value = ucwords( str_replace( "_", " ", $att ) );
    $pdf->Cell( 1.0, 0.12, $value, 0, 2,"L", false );
}
foreach( $special_abilities as $att => $value ){
    if($_POST[$att]){
        if( $count == 4 )
            $pdf->setXY( 1.9, 1.05 );
        $count++;
        $value = ucwords( str_replace( "_", " ", $att ) );
        if( $value == 'Size' )
            $value = 'Size: '.$_POST['size'];
        $pdf->Cell( 1.0, 0.12, $value, 0, 2,"L", false );
    }
}

if($_POST['special_ability_description']){
    if( $count == 4 )
        $pdf->setXY( 1.9, 1.05 );
    $value = $_POST['special_ability_description'];
    $pdf->Cell( 1.0, 0.12, $value, 0, 2,"L", false );
}


#-- RENDER SKILLS...
$pdf->SetFont('Times','B',7);
$pdf->setXY( 0.0, 1.72 );
foreach( $skills as $att => $value ){
    if($dice[$_POST[$att]/$skills[$att]]){
       $pdf->setX( 0.10);
       $pdf->Cell( 0.2, 0.145, substr( $dice[$_POST[$att]/$skills[$att]], 1), 0, 0,"L", false );
       $pdf->Cell( 0.90, 0.145, ucwords( $att ), 0, 2,"R", false );
    }
}




#-- RENDER ATTRIBUTES...
$pdf->SetFont('Times','B',8);
$pdf->setXY( 0.59, 0.63 );
foreach( $attributes as $att ){
    $val = substr( $dice[$_POST[$att]], 1 );
    $pdf->Cell( 0.2, 0.18, $val, 0, 2,"L", false );
}

#-- Render ranged Weapons
$pdf->SetFont('Times','B',5);
$pdf->setXY( 0.05, 3.29 );
foreach( $rangedWeaponData as $att => $value ){
    if($_POST[$att]){
        $pdf->setX( 0.05);
        #Type	Range	Damage	Cost	Min Str.	Notes
        $pdf->Cell( 0.65, 0.15, $value[0], 0, 0,"L", false );
        $pdf->Cell( 0.50, 0.15, $value[1], 0, 0,"L", false );
        $pdf->Cell( 0.50, 0.15, $value[2], 0, 0,"L", false );
        if( count( $value) > 3 ){
            $pdf->Cell( 0.50, 0.15, $value[5], 0, 2,"L", false );
        }
    }
}
#-- Render other Weapons
foreach( $handWpnList as $att => $value ){
    if($_POST[$att]){
        $pdf->setX( 0.05);
        $val = $equipmentDescrList[$att]?$equipmentDescrList[$att]:ucwords( str_replace( "_", " ", $att ) ) ;
        $val = str_replace( "]","",$val );
        $valz = explode("[",$val);
        $pdf->Cell( 0.65, 0.15, $valz[0], 0, 0,"L", false );
        $details = explode(",", $valz[1] );
        $damage = $details[0];
        if( substr($damage,0,1) == '+')$damage = "Str".$damage;
        $pdf->Cell( 0.50, 0.15, $details[1], 0, 0,"L", false );
        if( $details[2] )
        {
            $pdf->Cell( 0.50, 0.15, $damage, 0, 0,"L", false );
            $pdf->Cell( 0.50, 0.15, $details[2], 0, 2,"L", false );
        }
        else
        {
            $pdf->Cell( 0.50, 0.15, $damage, 0, 2,"L", false );
        }
    }
}

#-- Render powers
$pdf->SetFont('Times','B',5);
$pdf->setXY( 0.05, 4.12 );
foreach( $powers as $att => $value ){
    if($_POST[$att]){
        $pdf->setX( 0.05);
        $pdf->Cell( 0.65, 0.155, ucwords( str_replace( "_", " ", $att)), 0, 2,"L", false );
    }
}
#-- Render Armor
$pdf->SetFont('Times','B',4);
$pdf->setY( 1.73 );
$pdf->setX( 1.3);
$count=0;
foreach( $armorList as $att => $value ){
    if($_POST[$att]){
        if( $count == 3 )
            $pdf->setXY( 1.9, 1.73 );
        $count++;
        $val = $equipmentDescrList[$att]?$equipmentDescrList[$att]:ucwords( str_replace( "_", " ", $att ) ) ;
        $pdf->Cell( 0.60, 0.15, $val, 0, 2,"L", false );
    }
}

if($_POST['special_equipment_description']){
    if( $count == 3 )
        $pdf->setXY( 1.9, 1.05 );
    $value = $_POST['special_equipment_description'];
    $pdf->Cell( 1.0, 0.12, $value, 0, 2,"L", false );
}

$pdf->Output( );


?>
