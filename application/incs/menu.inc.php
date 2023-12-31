<?php
    $sql = "SELECT upe_descricao FROM usuario_permissao WHERE upe_cod = ".$_SESSION['cidema_userPermissao'];
    $permissao = $data->find('dynamic', $sql);

	
    $img_perfil = 'application/images/sem_img_profile.svg';
    

    $tam_image = getimagesize($img_perfil);

    //Compara se altura é largura é maior que altura
    if($tam_image[0]>$tam_image[1]){
        $bs = 'background-size:100% auto;';
    }else
        if($tam_image[0]<$tam_image[1]){
            $bs = 'background-size:auto 100%;';
        }else{
            $bs = 'background-size:100%;';
        }

?>

<style>
    .avatar{ 
        background-image:url('<?php echo $img_perfil; ?>');
        <?php echo $bs; ?>
        background-position:center center; 
        /*border-radius:50%;*/
        border: none;
        background-repeat: no-repeat;
        background-color: #FFF; 
    }
    .reduzido.avatar{
        margin-right: auto;
        margin-left: auto;
        width:32px; 
        height:32px; 
    }
    
</style>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header" style="padding: 27px 25px;">
                <div class="dropdown profile-element"> 
                    <a title="Visualizar usuário" href="#" onClick="nextPage('?module=cadastro&acao=edita_usuario', <?php echo $_SESSION['cidema_userId'];?>);" style="text-decoration:none;">
                	<span>
                        <div class="avatar" style="width:60px; height:60px;">
                            <br />
                        </div>
                    </span>
                    </a>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> 
                        	<span class="block m-t-xs"> <strong class="font-bold"><?php echo $_SESSION['cidema_userName']; ?></strong></span> 
                        	<span class="text-muted text-xs block"><?php echo $permissao[0]['upe_descricao']; ?> <b class="caret"></b></span> 
                        </span> 
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a title="Visualizar usuário" href="#" onClick="nextPage('?module=cadastro&acao=edita_usuario', <?php echo $_SESSION['cidema_userId'];?>);" style="text-decoration:none;">Meus Dados</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#" style="background: transparent;">
                    	<div class="reduzido avatar">
                            <br />
                        </div>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs" style="color:#000;">
                        <li><a href="#" onClick="nextPage('?module=cadastro&acao=edita_usuario', <?php echo $_SESSION['cidema_userId'];?>);">Meus Dados</a></li>
                        <li class="divider"></li>
                        <li><a href="?module=index&acao=logout">Sair do Sistema</a></li>
                    </ul>
                </div>
            </li>
            
            <?php 
            	if($_GET['module']=='cadastro'){
            		echo '<li class="active">';
                    //Valida qual variavel vai receber active
                    unset($item_sel);
                    $acao = explode('_',$_GET['acao']);
                    switch ($acao[1]) {
                        case 'usuario':
                            $item_sel[0] = 'class="active"';
                            break;
                        case 'entidade':
                            $item_sel[1] = 'class="active"';
                            break;
                        case 'cidade':
                            $item_sel[2] = 'class="active"';
                            break;
                        case 'tipo':
                            $item_sel[3] = 'class="active"';
                            break;
                        
                }
            	}else{
            		echo '<li>';
            	}

            	switch($_SESSION['cidema_userPermissao']) {
            		case '1': //ADMINISTRADOR
            			echo '
                        <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Cadastros</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">    
                            <li '.$item_sel[0].' ><a href="?module=cadastro&acao=lista_usuario"><i class="fa fa-user" aria-hidden="true"></i>Usuários</a></li>
                			<li '.$item_sel[1].' ><a href="?module=cadastro&acao=lista_entidade"><i class="fa fa-users" aria-hidden="true"></i>
                            Entidades</a></li>
    	                    <li '.$item_sel[2].' ><a href="?module=cadastro&acao=lista_cidade"><i class="fa fa-building" aria-hidden="true"></i>Cidades</a></li>
                            <li '.$item_sel[3].' ><a href="?module=cadastro&acao=lista_tipo"><i class="fa fa-file-text-o" aria-hidden="true"></i>
                            Tipo de Documento</a></li>
                        </ul>';
            			break;
                    case '2': //FUNCIONÁRIO
                        echo '
                        <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Registros</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">    
                            <li '.$item_sel[0].' ><a href="?module=cadastro&acao=lista_usuario">Usuários</a></li>
                        </ul>';
                        break;
            	}
            ?>	
    </li>
            <?php 
            	if($_GET['module']=='lancamento'){
            		echo '<li class="active">';
                    //Valida qual variavel vai receber active
                    unset($item_sel);
                    $acao = explode('_',$_GET['acao']);
                    switch ($acao[1]) {
                        case 'documento':
                            $item_sel[0] = 'class="active"';
                            break;
                        case 'entidade':
                            $item_sel[1] = 'class="active"';
                            break;
                        case 'cidade':
                            $item_sel[2] = 'class="active"';
                            break;
                        case 'tipo':
                            $item_sel[3] = 'class="active"';
                            break;                         
                }
            	}else{
            		echo '<li>';
            	}

            	switch($_SESSION['cidema_userPermissao']) {
            		case '1': //ADMINISTRADOR
            			echo '
                        <a href="#"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>
                        Lançamentos</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">    
                            <li '.$item_sel[0].' ><a href="?module=lancamento&acao=lista_documento"><i class="fa fa-file-text" aria-hidden="true"></i>
                            Documentos</a></li>
                        </ul>';
            			break;
                    case '2': //FUNCIONÁRIO
                        echo '
                        <a href="#"><i class="fa fa-edit"></i> <span class="nav-label">Registros</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">    
                            <li '.$item_sel[0].' ><a href="?module=lancamento&acao=lista_documento">Usuários</a></li>
                        </ul>';
                        break;
            	}
            ?>	

            </li>
        </ul>
    </div>
</nav>