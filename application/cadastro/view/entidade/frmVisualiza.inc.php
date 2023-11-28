<?php
    if(!isset($_SESSION) || $_SESSION['cidema_userPermissao'] != 1){
        echo'<script>window.location="?module=index&acao=logout"</script>';
    }

    $sql = "SELECT * FROM entidade WHERE ent_cod = " . $_POST['param_0'];
    $result = $data->find('dynamic', $sql);

    $sql = "SELECT * FROM cidade WHERE cid_situacao = 1";
    $cidade = $data->find('dynamic', $sql);
  
?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-9 col-xs-8">
        <h2>Entidade</h2>
        <ol class="breadcrumb">
            <li>
                <a href="?module=cadastro&acao=lista_entidade">Entidade</a>
            </li>
            <li class="active">
                <strong>Visualizar</strong>
            </li>
        </ol>
    </div>

    <div class="col-lg-3 col-xs-4" style="text-align:right;">
        <br /><br />
        <button class="btn btn-primary" onclick="voltar();" type="button"><i class="fa fa-arrow-left"></i><span class="hidden-xs hidden-sm"> Voltar</span></button>
    </div>
</div>
<div id="result_var"></div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>
        </div>

        <div class="ibox-content">

            <form role="form" action="?module=cadastro&acao=visualiza_entidade" id="MyForm" method="post" enctype="multipart/form-data" name="MyForm">
                <input name="ent_cod" type="hidden" class="form-control blockenter" id="ent_cod" value="<?php echo $result[0]['ent_cod']; ?>" />

                <div class="row form-group">

                    <div class="col-sm-6">
                        <label class="control-label" for="ent_nome">Entidade:</label>
                        <input name="ent_nome" type="text" class="form-control blockenter" id="ent_nome" value="<?php echo $result[0]['ent_nome']; ?>" style="text-transform:uppercase;" disabled />
                    </div>
                    
                    <div class="col-sm-6">
                        <label class="control-label" for="ent_mail">E-mail:</label>
                        <input name="ent_mail" type="text" class="form-control blockenter" id="ent_mail" value="<?php echo $result[0]['ent_mail']; ?>" disabled />
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-sm-2">
                        <label class="control-label" for="ent_cnpj">CNPJ:</label>
                        <input name="ent_cnpj" type="text" class="form-control blockenter" id="ent_cnpj" value="<?php echo $result[0]['ent_cnpj']; ?>" disabled />
                    </div>
                    <div class="col-sm-4">
                        <label class="control-label" for="cid_cod">Cidade:</label>
                        <select class="form-control selectpicker" data-live-search="true" data-size="6" id="cid_cod" onchange="busca_cidade(this.value, 'cid_cod');" name="cid_cod" disabled>
                            <option value="">-- Selecione --</option>
                            <?php
                                for ($i = 0; $i < count($cidade); $i++) {
                                    if ($cidade[$i]['cid_cod'] == $result[0]['cid_cod']) {
                                        echo '<option value="' . $cidade[$i]['cid_cod'] . '" selected>' . $cidade[$i]['cid_nome'] . '</option>';
                                    } else {
                                        echo '<option value="' . $cidade[$i]['cid_cod'] . '">' . $cidade[$i]['cid_nome'] . '</option>';
                                    }
                                }
                            ?>

                        </select>
                    </div>
                        <div class="col-sm-6">
                            <label class="control-label" for="ent_endereco">CNPJ:</label>
                            <input name="ent_endereco" type="text" class="form-control blockenter" id="ent_endereco" value="<?php echo $result[0]['ent_endereco']; ?>" disabled />
                        </div>
                    </div>

               
                    
                    
                </div>
            </form>

        </div>
    </div>
</div>

<script>

    function enviar() {
        document.forms['MyForm'].submit();
    }

    function voltar() {
        window.location.href = '?module=cadastro&acao=lista_entidade';
    }

    $(document).ready(function() {
        $("#ent_cnpj").mask("99.999.999/9999-99");
        $("#ent_tel").mask("(99) 9999-9999?9");
        $("#ent_cep").mask("99999-999");


        $("#MyForm").submit(function(event) {
            document.forms['MyForm'].submit();
        });
    });
</script>