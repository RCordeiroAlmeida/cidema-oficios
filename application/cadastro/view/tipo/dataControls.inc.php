<?php
switch ($_GET['acao']) {

  case 'grava_tipo':
    $aux['dtp_descricao'] = mb_strtoupper($_POST['dtp_descricao'], 'UTF-8');

    $data->tabela = 'documento_tipo';
    $data->add($aux);

    echo '<script>window.location = "?module=cadastro&acao=lista_tipo&ms=1";</script>';
    break;

  case 'update_tipo':
    
    $aux['dtp_cod'] = $_POST['dtp_cod'];
    $aux['dtp_descricao'] = mb_strtoupper($_POST['dtp_descricao']);
    
    $data->tabela = 'documento_tipo';
    $data->update($aux);

    echo '<script>window.location = "?module=cadastro&acao=lista_tipo&ms=2";</script>';
    break;

  case 'inativar_tipo':
    $sql = 'UPDATE documento_tipo SET dtp_situacao = 0 WHERE dtp_cod = ' . $_POST['param_0'];
    $data->executaSQL($sql);

    echo '<script>window.location = "?module=cadastro&acao=lista_tipo&ms=4";</script>';
    break;

  case 'ativar_tipo':
    $sql = 'UPDATE documento_tipo SET dtp_situacao = 1 WHERE dtp_cod = ' . $_POST['param_0'];
    $data->executaSQL($sql);

    echo '<script>window.location = "?module=cadastro&acao=lista_tipo&ms=4";</script>';
    break;
}
