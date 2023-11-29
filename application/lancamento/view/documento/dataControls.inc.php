<?php
switch ($_GET['acao']) {

	case 'grava_documento':

		
		$aux['usu_cod']				= $_SESSION['cidema_userId'];			//quem gravou
		$aux['doc_data']            = $_POST['doc_data'];
		$aux['doc_destinatario']    = $_POST['doc_destinatario'];
		if($_POST['destinatario_outro']){
			$aux['destinatario_outro']  = $_POST['destinatario_outro'];
		}
		$aux['doc_assunto']         = mb_strtoupper($_POST['doc_assunto']);
		$aux['dtp_cod']				= $_POST['dtp_cod']; 					//tipo de documento

		$sql = "SELECT MAX(doc_numero) AS doc_numero, YEAR(doc_data) AS doc_data FROM documento WHERE dtp_cod = ".$_POST['dtp_cod'];
		$result = $data->find('dynamic', $sql);

		if($result[0]['doc_data'] < date('Y', strtotime($_POST['doc_data']))){
			$aux['doc_numero'] = 1;
		}else{
			$aux['doc_numero'] = $result[0]['doc_numero'] + 1;
		}

		$arquivo = $_FILES['doc_anexo'];

		if (isset($arquivo)) { // Verifica se o índice existe em $_FILES
			$local_arquivo = "arquivos/anexos/".$_POST['doc_assunto'].'_'.date('Ymdhis').$arquivo['name'];
			$moved = move_uploaded_file($arquivo['tmp_name'], $local_arquivo);

			$aux['doc_anexo'] = '';
			if ($moved) {
				$aux['doc_anexo'] = $local_arquivo;
			}
		}

		
		$data->tabela = 'documento';
		$data->add($aux);

		$cod = $data->maxValue('doc_cod', 'documento');
		// Redirecionar para a página desejada
		echo '<script>nextPage("?module=lancamento&acao=lista_documento&ms=6", '. $cod .')</script>';
		break;

	case 'update_documento':
		$aux['cid_cod']		= $_POST['cid_cod'];
		$aux['cid_nome']    = addslashes(mb_strtoupper($_POST['cid_nome'], 'UTF-8'));
		$aux['est_uf']   = addslashes(mb_strtoupper($_POST['est_uf'], 'UTF-8'));

		$data->tabela = 'documento';
		$data->update($aux);

		echo '<script>window.location = "?module=lancamento&acao=lista_documento&ms=2";</script>';
		break;

	case 'inativar_documento':
		$sql = 'UPDATE documento SET doc_situacao = 0 WHERE doc_cod = ' . $_POST['param_0'];
		$data->executaSQL($sql);

		echo '<script>window.location = "?module=lancamento&acao=lista_documento&ms=5"</script>';
		break;

	case 'ativar_documento':
		$sql = 'UPDATE documento SET doc_situacao = 1 WHERE doc_cod = ' . $_POST['param_0'];
		$data->executaSQL($sql);

		echo '<script>window.location = "?module=lancamento&acao=lista_documento&ms=5"</script>';
		break;
}
