<?php
switch ($_GET['acao']) {

  case 'grava_entidade':
    $aux['ent_nome']        = addslashes(mb_strtoupper($_POST['ent_nome'], 'UTF-8'));
    $aux['ent_cnpj']        = $_POST['ent_cnpj'];
    $aux['ent_mail']        = $_POST['ent_mail'];
    $aux['ent_endereco']    = addslashes(mb_strtoupper($_POST['ent_endereco'], 'UTF-8'));
    $aux['cid_cod']         = $_POST['cid_cod'];
    //gravando dados do cliente
    $data->tabela = 'entidade';
    $data->add($aux);

    echo '<script>window.location = "?module=cadastro&acao=lista_entidade&ms=1";</script>';
    break;

  case 'update_entidade':
    
    $aux['ent_cod']         = $_POST['ent_cod'];
    $aux['ent_nome']        = addslashes(mb_strtoupper($_POST['ent_nome'], 'UTF-8'));
    $aux['ent_cnpj']        = $_POST['ent_cnpj'];
    $aux['ent_mail']        = $_POST['ent_mail'];
    $aux['ent_endereco']    = addslashes(mb_strtoupper($_POST['ent_endereco'], 'UTF-8'));
    $aux['cid_cod']         = $_POST['cid_cod'];

    $data->tabela = 'entidade';
    $data->update($aux);

    echo '<script>window.location = "?module=cadastro&acao=lista_entidade&ms=2";</script>';
    break;

  case 'inativar_entidade':
    $sql = 'UPDATE entidade SET ent_situacao = 0 WHERE ent_cod = ' . $_POST['param_0'];
    $data->executaSQL($sql);

    echo '<script>window.location = "?module=cadastro&acao=lista_entidade&ms=4";</script>';
    break;


  case 'ativar_entidade':
    $sql = 'UPDATE entidade SET ent_situacao = 1 WHERE ent_cod = ' . $_POST['param_0'];
    $data->executaSQL($sql);

    echo '<script>window.location = "?module=cadastro&acao=lista_entidade&ms=4";</script>';
    break;
}
