<?php
switch ($_GET['acao']) {

	case 'grava_documento':

		//quem gravou
		$aux['usu_cod']				= $_SESSION['cidema_userId']
		$aux['doc_assunto']         = mb_strtoupper($_POST['doc_assunto']);
		$aux['doc_data']            = $_POST['doc_data'];
		$doc_ano                    = explode('-', $_POST['doc_data']);
		$ano_atual                  = date('Y');

		$aux['doc_destinatario']    = $_POST['doc_destinatario'];
		$aux['destinatario_outro']  = $_POST['destinatario_outro'];
		$aux['doc_destinatario']    = $_POST['doc_destinatario'];

		$data->tabela = 'documento';
		$data->add($aux);

		// Obter o último número de documento inserido
		$doc_atual = $data->MaxValue("doc_numero", "documento");
		$doc_cod = $data->MaxValue("doc_cod", "documento");

		// Calcular o próximo número do documento
		$doc_prox  = ($doc_atual ? $doc_atual + 1 : 1);

		// Atualizar o documento com o número calculado
		$sql = 'UPDATE documento SET doc_numero = '.$doc_prox.' WHERE doc_cod ='.$doc_cod;
		$data->executaSQL($sql);

		// Redirecionar para a página desejada
		echo '<script>window.location= "?module=lancamento&acao=lista_documento";</script>';
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
		$sql = 'UPDATE documento SET cid_situacao = 0 WHERE cid_cod = ' . $_POST['param_0'];
		$data->executaSQL($sql);

		echo '<script>window.location = "?module=lancamento&acao=lista_documento&ms=5"</script>';
		break;

	case 'ativar_documento':
		$sql = 'UPDATE documento SET cid_situacao = 1 WHERE cid_cod = ' . $_POST['param_0'];
		$data->executaSQL($sql);

		echo '<script>window.location = "?module=lancamento&acao=lista_documento&ms=5"</script>';
		break;
}
