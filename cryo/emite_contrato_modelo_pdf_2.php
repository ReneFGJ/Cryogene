<?
require($include.'fphp-153/fpdf.php');
require($include.'sisdoc_data.php');

$versao_pdf = '0.0.34a';

class PDF extends FPDF
{
//Page header
function Header()
{
	//Logo
	//$this->Image('../img/logo_re2ol.jpg',10,8,16);
	//Arial bold 15
	$this->SetFont('Times','B',12);
	//Move to the right
	$this->Cell(80);
	//Title
	$this->Cell(110,6,'Contrato Cryogene',1,0,'R');
	//Line break
	$this->SetFont('Times','',6);		
//	for ($ll=0;$ll < 62;$ll++)
//		{
//		$this->SetXY(7,$ll*4+16);
//		$this->Cell(0,10,$ll*1+1,0,0,'L');
//		}
	$this->SetXY(0,20);
	$this->Ln(0);
}

//Page footer
function Footer()
{
	global $dd,$data_submit,$versao_pdf,$nr_submit;
	//Position at 1.5 cm from bottom
	$this->SetY(-15);
	//Arial italic 8
	$this->SetFont('Arial','I',8);
	//Page number
	$this->Cell(0,10,'Minuta n. '.$nr_submit.' em '.$data_submit,0,0,'L');
	$this->Cell(0,10,'Página '.$this->PageNo().'/{nb}',0,0,'R');
	$this->Ln(3);
	$this->SetFont('Arial','I',4);
	$this->Cell(0,10,'RE2ol v.'.$versao_pdf,0,0,'L');
}
}

//Instanciation of inherited class
//$sql = "select * from submit_documento ";
//$sql .= "where doc_protocolo = '".$dd[0]."' ";
//$rlt = db_query($sql);
//if ($line = db_read($rlt))
//	{
//	$titulo = trim($line['doc_1_titulo']);
//	$subt   = trim($line['doc_1_subtitulo']);
//	$titulo = trim($line['doc_1_subtitulo']);
//	$data_submit = stodbr($line['doc_dt_atualizado']);
//	$subt   = '';
//	if (strlen($subt) > 0) { $titulo .= ': '.$subt; }
//	}

$sql = "select * from submit_documento_valor ";
$sql .= " inner join submit_manuscrito_ceua_field on sub_codigo = spc_codigo ";
$sql .= " where spc_projeto = '".$dd[0]."'";
$sql .= " order by sub_pos, sub_ordem ";

$sql = "select * from contrato_field ";
$sql .= " order by sub_pos, sub_ordem ";

$rlt = db_query($sql);

$pdf=new PDF();
$ln = 0;
$pdf->AliasNbPages();
$pdf->SetFont('Times','',16);
$pdf->AddPage();

/////////////////////////////// Titulo
$pdf->Ln($ln);
$pdf->MultiCell(0,8,$titulo,0,'C');
$pdf->Ln($ln);
$pdf->MultiCell(0,8,chr(13).' '.chr(13).' '.chr(13).' '.chr(13),0,'C');
$pdf->Ln($ln);	
////////////////////////////// Autores

/////////////////////////////// Corpo do texto
$pdf->SetFont('Times','',12);
while ($line = db_read($rlt))
	{
	$align = trim($line['sub_pdf_align']);
	if (strlen($align)==0) { $align = "J"; }

	$space = trim($line['sub_pdf_space']);	
	if (strlen($space)==0) { $space = "6"; }
	
	$caption = trim($line['sub_pdf_title']);
	$texto = trim($line['sub_caption']);
	$mostrar = $line['sub_pdf_mostra'];
	$content = $line['spc_content'];
	$ft_size = $line['sub_pdf_font_size'];
	$ft_field = trim($line['sub_field']);

/////////////////////////////// Orçamento
	if ($ft_field = '$M')
		{
		$content .= $texto;
		$content = troca($content,"$pai",$pai);
		$content = troca($content,"$cpfp",$cpfp);
		$content = troca($content,"$rgp",$rgp);
		$content = troca($content,"$profp",$profp);
		$content = troca($content,"$esta",$esta);
		$content = troca($content,"$cpfp",$cpfp);
		$content = troca($content,"$cpfp",$cpfp);
		$content = troca($content,"$cpfp",$cpfp);

		}
	if ($mostrar == 1)
		{
		$pdf->MultiCell(0,0,' ',1,$align);
		$pdf->Ln($ln);
		$pdf->SetFont('Times','B',12);
		$pdf->MultiCell(0,8,$caption,0,$align);
		$pdf->Ln($ln);
		$pdf->SetFont('Times','',$ft_size);
		$pdf->MultiCell(0,$space,$content,0,$align);
		$pdf->Ln($ln);
		$pdf->MultiCell(0,8,' ',0,$align);
		$pdf->Ln($ln);
		}
	}
	
//Set font

	
$pdf->Output();
?>