<?php
// ob_start(); 
require_once './vendor/autoload.php';
// require ('../../../../library/MySql.php'); // Conecta ao BD
// require ('../../../../library/DataManipulation.php'); 
//
use Mpdf\Mpdf;

$mpdf = new Mpdf();
$data = new DataManipulation();
//
setlocale(LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese');

/*$logoPath = file_get_contents('../../../images/logo-cidema.png');
$logoData = base64_encode($logoPath);
$logoTag = '<img src="data:image/png;base64,' . $logoData . '" width="200"/>';

$sql = 'SELECT
            doc.*,
            dtp.dtp_descricao,
            u.usu_nome
        FROM
            documento AS doc
            INNER JOIN documento_tipo AS dtp ON doc.dtp_cod = dtp.dtp_cod
            INNER JOIN usuario as u ON u.usu_cod = doc.usu_cod
        WHERE
            doc.doc_situacao = 1' . $where;

$result = $data->find('dynamic', $sql);

$html = '
<html>
    <head>
        <title>Relatório de Solicitações</title>
    </head>
    <body style="font-family: Arial; font-size: 0.8em">
        <table style="margin-left: auto; margin-right: auto">
            <thead>
                <tr style="text-align: center">
                    <th colspan="2" style="text-align: center;">
                        ' . $logoTag . '<br/><br/>
                        Estado de Santa Catarina<br/>
                        CIDEMA
                    </th>
                </tr>
                <tr style="text-align: center">
                    <th colspan="2" style="text-align: center; font-size: 1.2em; padding-top: 10px">
                        Relatório de Atividades
                    </th>
                </tr>
            </thead>
        </table>
        <table style="border-collapse: collapse; width: 100%; margin-top: 20px; margin-bottom: 20px;">
            <thead>
                <tr style="border: 1px solid black; padding: 8px; text-align: left;">
                    <th>Número</th>
                    <th>Tipo</th>
                    <th>Assunto</th>
                    <th>Criado por</th>
                </tr>
            </thead>
            <tbody>';

foreach ($result as $row) {
    $html .= '
        <tr>
            <td style="border: 1px solid black; padding: 8px;">' . str_pad($row['doc_numero'], 4, '0', STR_PAD_LEFT) . '/' . date('Y', strtotime($row['doc_data'])) . '</td>
            <td style="border: 1px solid black; padding: 8px;">' . $row['ati_data'] . '</td>
            <td style="border: 1px solid black; padding: 8px;">' . $row['dtp_descricao'] . '</td>
            <td style="border: 1px solid black; padding: 8px;">' . $row['doc_assunto'] . '</td>
            <td style="border: 1px solid black; padding: 8px;">' . $row['usu_nome'] . '</td>
        </tr>';
}

$html .= '
            </tbody>
        </table>
    </body>
</html>';
*/
$html = "teste";
$mpdf->ignore_invalid_utf8 = true;
	ob_clean();//Limpa o buffer de saída
	$mpdf->WriteHTML($html);	
	// Rodapé	
	$mpdf->SetFooter(array(
		'L' => array('content' => 'Página {PAGENO}',),
		'C' => array('content' => 'Azambuja',),
		'R' => array('content' => date("d/m/Y"),),
		'Line' => 1
	), 'O');
	$mpdf->Output();
	exit;

?>