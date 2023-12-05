<?php
    if(!isset($_SESSION) || $_SESSION['cidema_userPermissao'] != 1){
        echo'<script>window.location="?module=index&acao=logout"</script>';
    }
    $sql = "SELECT doc.*, dtp.dtp_descricao FROM documento AS doc INNER JOIN documento_tipo as dtp ON doc.dtp_cod = dtp.dtp_cod WHERE doc_situacao = 1 ORDER BY doc_data";
    $ati = $data->find('dynamic', $sql);

    $sql = 'SELECT ent_cod, ent_nome FROM entidade WHERE ent_situacao = 1';
    $destinatario = $data->find('dynamic', $sql);

    $sql = 'SELECT dtp_cod, dtp_descricao FROM documento_tipo WHERE dtp_situacao = 1';
    $tipo = $data->find('dynamic', $sql);

    
    if ($_POST['param_0']) { 
        $sql = "SELECT doc.*, dtp.dtp_descricao FROM documento as doc INNER JOIN documento_tipo as dtp ON doc.dtp_cod = dtp.dtp_cod WHERE doc.doc_cod=" . $_POST['param_0'];
        $response = $data->find('dynamic', $sql);

        echo'

            <script type="text/javascript">
                swal({
                    title: "Novo Documento adicionado!",
                    text: "Tipo: '.$response[0]['dtp_descricao'].'<br/>Número: '.str_pad($response[0]['doc_numero'], 4, '0', STR_PAD_LEFT) . '/'.date('Y', strtotime($response[0]['doc_data'])).'",
                    icon: "success"
                });
            </script>';
    }  

    

?>

<script>
    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: "slideDown",
        timeOut: 5000
    };
    <?php
        switch ($_GET[ms]) {
            case 1:
                echo 'toastr.success("Documento cadastrado com sucesso!", "Incluido!");';
                break;

            case 2:
                echo 'toastr.success("Documento atualizado com sucesso", "Atualizado!");';
                break;

            case 3:
                echo 'toastr.success("Documento excluido com sucesso", "Exluido!");';
                break;

            case 4:
                echo 'toastr.info("Documento foi inativado", "Inativado!");';
                break;

            case 5:
                echo 'toastr.success("Documento foi reativado", "Reativado!");';
                break;
        }
    ?>
</script>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-6 col-xs-6">
        <h2>Lançamentos</h2>
        <ol class="breadcrumb">
            <li class="active">
                <strong>Documentos</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-6 col-xs-6" style="text-align:right;">
        <br /><br />
        <a href="application/relatorio/view/atividade/relatorio.php" target="_blank" class="btn btn-warning" style="height: 34px;">
            <i class="fa fa-print" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Imprimir</span>
        </a>
        <a href="?module=lancamento&acao=lista_documento" class="btn btn-default" style="height: 34px;">
            <i class="fa fa-arrow-left" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Voltar</span>
        </a>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Formulário de Cadastro</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
        </div>

        <div class="ibox-content">

            <form role="form" action="?module=lancamento&acao=grava_documento" id="MyForm" method="post" enctype="multipart/form-data" name="MyForm">

                

                <div class="row form-group">
                <div class="col-sm-2">
                    <label class="control-label" for="doc_data">Ano:</label>
                    <select name="doc_ano" class="form-control blockenter" id="doc_ano" required>
                        <option selected disabled>--SELECIONE--</option>
                        <?php
                            
                            $startYear = date('Y');
                            $endYear = $startYear + 10;

                            for ($year = $startYear; $year <= $endYear; $year++) {
                                echo '<option value="' . $year . '">' . $year . '</option>';
                            }
                        ?>
                    </select>
                </div>
                    
                    <div class="col-sm-3">
                        <label class="control-label" for="doc_destinatario">Destinatário:</label>
                        <select class="form-control selectpicker" data-live-search="true" data-size="6" id="doc_destinatario" name="doc_destinatario">
                            <option value="">-- Selecione --</option>
                            <?php
                            for ($i = 0; $i < count($destinatario); $i++) {
                                echo '<option value="' . $destinatario[$i]['ent_cod'] . '">' . $destinatario[$i]['ent_nome'] . '</option>';
                            }
                            ?>

                        </select>
                    </div>                    

                    <div class="col-sm-2">
                        <label class="control-label" for="dtp_cod">Tipo de Documento:</label>
                        <a href="?module=cadastro&acao=novo_tipo" class="pull-right"></a>
                        <select class="form-control selectpicker" data-live-search="true" data-size="6" id="dtp_cod" name="dtp_cod" required>
                            <option value="">-- Selecione --</option>
                            <?php
                            for ($i = 0; $i < count($tipo); $i++) {
                                echo '<option value="' . $tipo[$i]['dtp_cod'] . '">' . $tipo[$i]['dtp_descricao'] . '</option>';
                            }
                            ?>

                        </select>
                    </div>
               
                    <div class="col-sm-5">
                        <label class="control-label" for="dtp_cod">Tipo de Documento:</label>
                        <a href="?module=cadastro&acao=novo_tipo" class="pull-right"></a>
                        <select class="form-control selectpicker" data-live-search="true" data-size="6" id="dtp_cod" name="dtp_cod" required>
                            <option value="">-- Selecione --</option>
                            <?php
                            for ($i = 0; $i < count($tipo); $i++) {
                                echo '<option value="' . $tipo[$i]['dtp_cod'] . '">' . $tipo[$i]['dtp_descricao'] . '</option>';
                            }
                            ?>

                        </select>
                    </div>
                </div>

            </form>

        </div>
    </div>