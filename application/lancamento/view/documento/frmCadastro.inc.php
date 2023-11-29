<?php
    if(!isset($_SESSION) || $_SESSION['cidema_userPermissao'] != 1){
        echo'<script>window.location="?module=index&acao=logout"</script>';
    }

    $sql = 'SELECT ent_cod, ent_nome FROM entidade WHERE ent_situacao = 1';
    $destinatario = $data->find('dynamic', $sql);

    $sql = 'SELECT dtp_cod, dtp_descricao FROM documento_tipo WHERE dtp_situacao = 1';
    $tipo = $data->find('dynamic', $sql);

?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-xs-8">
        <h2>Lançametos</h2>
        <ol class="breadcrumb">
            <li>
                <a href="?module=lancamento&acao=lista_documento">Documentos</a>
            </li>
            <li class="active">
                <strong>Novo</strong>
            </li>
        </ol>
    </div>

    <div class="col-lg-3 col-xs-4" style="text-align:right;">
        <br /><br />
        <button class="btn btn-primary" onclick="$('#MyForm').valid() ? enviar():'';" type="submit"><i class="fa fa-check"></i><span class="hidden-xs hidden-sm"> Salvar</span></button>
        <button class="btn btn-default" onclick="voltar();" type="button"><i class="fa fa-times"></i><span class="hidden-xs hidden-sm"> Cancelar</span></button>
    </div>
</div>
<div id="result_var"></div>

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
                        <label class="control-label" for="doc_data">Data:</label>
                        <input name="doc_data" type="date" class="form-control blockenter" id="est_uf" style="text-transform:uppercase;" value="<?php echo date('Y-m-d')?>" min="<?php echo date('Y-m-d'); ?>" required />
                    </div>
                    
                    <div class="col-sm-3">
                        <label class="control-label" for="doc_destinatario">Destinatário:</label>
                        <select class="form-control selectpicker" data-live-search="true" data-size="6" id="doc_destinatario" name="doc_destinatario" required>
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
                        <a href="?module=cadastro&acao=novo_tipo" class="pull-right"><i class="fa fa-plus"></i></a>
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
                        <label class="control-label" for="doc_assunto">Assunto:</label>
                        <input name="doc_assunto" type="text" class="form-control blockenter" id="doc_assunto" style="text-transform:uppercase;" required />
                    </div>                    
                </div>
                <div class="row form-group">
                    <div class="col-sm-12">
                        <label for="doc_anexo">Anexo: (opcional)</label>
                        <input type="file" name="doc_anexo" class="filestyle" id="doc_anexo">
                    </div>
                </div>

            </form>

        </div>
    </div>


<script>
    function enviar() {
        document.forms['MyForm'].submit();
    }

    function voltar() {
        window.location.href = '?module=lancamento&acao=lista_documento';
    }

    $(document).ready(function() {
        $("#MyForm").validate({
            rules: {
                cli_nome: {
                    required: true,
                    minlength: 3
                },
                cid_codigo: {
                    required: true
                }
            }
        });
        $("#MyForm").submit(function(event) {
            document.forms['MyForm'].submit();
        });
    });
</script>