<?php	
	require_once('../../../../library/MySql.php'); // Conecta ao BD
	require_once('../../../../library/DataManipulation.php'); 
	require_once("../../../../library/mpdf/mpdf.php"); 
	require_once("../../../../library/Utils.php"); 	
	
	$data = new DataManipulation();
	$util = new Utils();	

	setlocale(LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese');
	$data_extenso = strftime('%d de %B de %Y', strtotime(date('Y-m-d')));

	$html = "teste";
	
	$footer = array(
					'L' => array(
							'content' => 'Página {PAGENO}', 
					),
					
					'C' => array(
							'content' => 'ESCOLAWEB - Sistema de Gestão Escolar WEB',
					),
					'R' => array(
							'content' => date("d/m/Y"),
					),
					'Line' => 1
				);


	$mpdf = new mPDF('c','A4-L',10,2,3,3,3,8,0,2);
	// Rodapé	
	$mpdf->ignore_invalid_utf8 = true;
	$mpdf->SetFooter($footer, 'O');
	$mpdf->SetFooter($footer, 'E');
	$mpdf->WriteHTML($html);	
	$mpdf->Output();
	exit;

?>