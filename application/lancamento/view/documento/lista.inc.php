<?php
    if(!isset($_SESSION) || $_SESSION['cidema_userPermissao'] != 1){
        echo'<script>window.location="?module=index&acao=logout"</script>';
    }
    $sql = "SELECT doc.*, dtp.dtp_descricao FROM documento AS doc INNER JOIN documento_tipo as dtp ON doc.dtp_cod = dtp.dtp_cod WHERE doc_situacao = 1 ORDER BY doc_data";
    $ati = $data->find('dynamic', $sql);

    $sql = "SELECT doc.*, dtp.dtp_descricao FROM documento AS doc INNER JOIN documento_tipo as dtp ON doc.dtp_cod = dtp.dtp_cod WHERE doc_situacao = 0 ORDER BY doc_data";
    $ina = $data->find('dynamic', $sql);
    
    if ($_POST['param_0']) { 
        $sql = "SELECT doc.*, dtp.dtp_descricao FROM documento as doc INNER JOIN documento_tipo as dtp ON doc.dtp_cod = dtp.dtp_cod WHERE doc.doc_cod=" . $_POST['param_0'];
        $response = $data->find('dynamic', $sql);

        echo'
            <div class="row wrapper border-bottom white-bg page-heading" style="padding-top: 3%; background-color: #39a9dd; color: #ffffff">
                <h3>Novo Documento adicionado</h3>
                <h4>Tipo: '.$response[0]['dtp_descricao'].' | Número: '.str_pad($response[0]['doc_numero'], 4, '0', STR_PAD_LEFT) . '/'.date('Y', strtotime($response[0]['doc_data'])).'</h4>
            </div>
        
        ';
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
        <a href="#" onclick="imprimir(<?php echo $_SESSION['cidema_userId']?>)" class="btn btn-warning" style="height: 34px;">
            <i class="fa fa-print" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Imprimir</span>
        </a>
        <a href="?module=lancamento&acao=novo_documento" class="btn btn-primary" style="height: 34px;">
            <span class="glyphicon glyphicon-plus-sign"></span> <span class="hidden-xs hidden-sm">Novo</span>
        </a>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1"><i class="fa fa-thumbs-o-up"></i>Ativos (<?php echo count($ati); ?>)</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2"><i class="fa fa-thumbs-o-down"></i>Inativos (<?php echo count($ina); ?>)</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <div class="table-responsive" style="overflow-x: initial;">
                                <br class="hidden-md hidden-lg" />
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                        <tr>
                                            <th style="width:10px;">Número</th>
                                            <th style="width:80px;">Tipo de Documento</th>
                                            <th style="width:80px;">Assunto</th>
                                            <th style="width:10px;">...</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($i = 0; $i < count($ati); $i++) {
                                            echo '
                                                <tr>
                                                    <td>' . str_pad($ati[$i]['doc_numero'], 4, '0', STR_PAD_LEFT) . '/'.date('Y', strtotime($ati[$i]['doc_data'])).'</td>
                                                    <td>' . $ati[$i]['dtp_descricao'] . '</td>
                                                    <td>' . $ati[$i]['doc_assunto'] . '</td>
                                                    <td>';
                                                        if($ati[$i]['doc_anexo']){
                                                            echo '
                                                                <a href="'.$ati[$i]['doc_anexo'].'" target="_blank">
                                                                    <span class="fa-stack">
                                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                                        <i class="fa fa-eye fa-stack-1x fa-inverse"></i>
                                                                    </span>
                                                                </a>
                                                            ';
                                                        }echo'
                                                    
                                                        <a href="#" onclick="nextPage(\'?module=lancamento&acao=edita_doc\', ' . $ati[$i]['doc_cod'] . ')">
                                                            <span class="fa-stack">
                                                                <i class="fa fa-square fa-stack-2x"></i>
                                                                <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                            </span>
                                                        </a>
                                                        <a href="#" onClick=\'inativar("' . $ati[$i]['doc_cod'] . '", "' . str_pad($ati[$i]['doc_numero'], 4, '0', STR_PAD_LEFT) . '/'.date('Y', strtotime($ati[$i]['doc_data'])) . '");\' title="Inativar Documento" style="text-decoration:none;">
                                                            <span class="fa-stack">
                                                                <i class="fa fa-square fa-stack-2x"></i>
                                                                <i class="fa fa-thumbs-o-down fa-stack-1x fa-inverse"></i>
                                                            </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            ';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <div class="table-responsive" style="overflow-x: initial;">
                                <br class="hidden-md hidden-lg" />
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                        <tr>
                                            <th style="width:10px;">Número</th>
                                            <th style="width:80px;">Tipo de Documento</th>
                                            <th style="width:80px;">Assunto</th>
                                            <th style="width:10px;">...</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($i = 0; $i < count($ina); $i++) {
                                            echo '
                                                <tr>
                                                    <td>' . str_pad($ina[$i]['doc_numero'], 4, '0', STR_PAD_LEFT) . '/'.date('Y', strtotime($ina[$i]['doc_data'])).'</td>
                                                    <td>' . $ina[$i]['dtp_descricao'] . '</td>
                                                    <td>' . $ina[$i]['doc_assunto'] . '</td>
                                                    <td>
                                                        <a href="#" onClick=\'ativar("' . $ina[$i]['doc_cod'] . '", "' . $ina[$i]['doc_numero'] . '");\' title="Reativar Documento" style="text-decoration:none;">
                                                            <span class="fa-stack">
                                                                <i class="fa fa-square fa-stack-2x"></i>
                                                                <i class="fa fa-thumbs-o-up fa-stack-1x fa-inverse"></i>
                                                            </span>
                                                        </a>
                                                    </td>
                                                </tr>
                                            ';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br />

    <script>
        $(document).ready(function() {
            $('.dataTables-example').DataTable({
                "lengthMenu": [
                    [50, 150, 200, -1],
                    [50, 150, 200, "Todos"]
                ],
                "order": [
                    [0, "asc"]
                ]
            });
        });

        function inativar(id, nome) {
            var url = "?module=lancamento&acao=inativar_documento";

            swal({
                title: "Você tem certeza?	",
                text: "Deseja realmente inativar esse Documento?<br /><b>" + nome + "</b>",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Sim",
                cancelButtonText: "Não",
                closeOnConfirm: false,
                closeOnCancel: false
            }).then(function() { //CONFIRM      
                nextPage(url, id);
            }, function(dismiss) {
                // dismiss can be 'cancel', 'overlay', 'close', 'timer'
                if (dismiss === 'cancel') {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: "slideDown",
                        timeOut: 5000
                    };
                    toastr.info("Nenhum dado foi afetado!", "Cancelado");
                }
            })
        }

        function ativar(id, nome) {
            var url = "?module=lancamento&acao=ativar_documento";

            swal({
                title: "Você tem certeza?",
                text: "Deseja realmente reativar esta Cidade?<br /><b>" + nome + "</b>",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#18A689",
                confirmButtonText: "Sim",
                cancelButtonText: "Não",
                closeOnConfirm: false,
                closeOnCancel: false
            }).then(function() { //CONFIRM      
                nextPage(url, id);
            }, function(dismiss) {
                //dismiss can be 'cancel', 'overlay', 'close', 'timer'
                if (dismiss === 'cancel') {
                    toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: "slideDown",
                        timeOut: 5000
                    };
                    toastr.info("Nenhum dado foi afetado!", "Cancelado");
                }
            })
        }

        function imprimir(usu_cod){
            nextPage('?module=relatorio&acao=lista_atividade', usu_cod);
        }
    </script>