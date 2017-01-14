<?
require '../fpdf6/fpdf.php';
include 'data.php';


class PDF extends FPDF
{


function PDF($orientation='P',$unit='in',$format='3x5')
{
    //Call parent constructor
    $this->FPDF($orientation,$unit,$format);
}


//Page header
function Header()
{
    $this->SetFont('Times','B',14);
    $this->Text( 0.1, 0.3, $_REQUEST['name'] );
    $this->SetFont('Times','B',10);
    $this->Text( 0.2, 0.5, $_REQUEST['secretname'] );
    //Logo
    #$this->Image("images/msh.png",2,0.1,0.9);
$this->Image("condemo_sheet_web.jpg",0,0,3,5);
    //Arial bold 15
    $this->SetFont('Arial','B',15);
}

//Page footer
function Footer()
{
    //Position at 1.5 cm from bottom
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

include 'constants.php';


//Instanciation of inherited class
$pdf=new PDF('L','in', array(5,3) );
$pdf->AliasNbPages();
$pdf->AddPage();

#$pdf->Output( $_REQUEST['name'].".pdf" );
$pdf->Output( );


?>
