<?php
	session_start();

	function meu_autoloader($nomeClasse) {
		
		// Caso não esteja atualizado um cookie, todos são atualizados com o valor atual da variável de sessão
		if(($_SESSION['cidema_userSession'] != $_COOKIE['cidema_userSession']) 	  ||
		($_SESSION['cidema_userId'] != $_COOKIE['cidema_userId'])	  ||
		($_SESSION['cidema_userName'] != $_COOKIE['cidema_userName']) ||
		($_SESSION['cidema_idSession'] != $_COOKIE['cidema_idSession']) || 
		($_SESSION['cidema_userPermissao'] != $_COOKIE['cidema_userPermissao']) || 
		($_SESSION['cidema_userEmail'] != $_COOKIE['cidema_userEmail'])){
			setcookie('cidema_userSession', $_SESSION['cidema_userSession'], $tempo_cookie);	
			setcookie('cidema_userId', $_SESSION['cidema_userId'], $tempo_cookie);	
			setcookie('cidema_userName', $_SESSION['cidema_userName'], $tempo_cookie);	
			setcookie('cidema_session', $_SESSION['cidema_session'], $tempo_cookie);	
			setcookie('cidema_idSession', $_SESSION['cidema_idSession'], $tempo_cookie);	
			setcookie('cidema_userPermissao', $_SESSION['cidema_userPermissao'], $tempo_cookie);	
			setcookie('cidema_userEmail', $_SESSION['cidema_userEmail'], $tempo_cookie);
			setcookie('cidema_userFuncionario', $_SESSION['cidema_userFuncionario'], $tempo_cookie);
		}

		if(!$_SESSION['cidema_userSession']){
		    // Para não perder sessão
		    $_SESSION['cidema_userId']         	= $_COOKIE['cidema_userId'];
			$_SESSION['cidema_userName']       	= $_COOKIE['cidema_userName'];
			$_SESSION['cidema_userSession']   	= $_COOKIE['cidema_userSession'];
			$_SESSION['cidema_userPermissao']  	= $_COOKIE['cidema_userPermissao'];
			$_SESSION['cidema_userEmail']  	   	= $_COOKIE['cidema_userEmail'];
			$_SESSION['cidema_idSession']      	= $_COOKIE['cidema_idSession'];
			$_SESSION['cidema_userFuncionario'] 	= $_COOKIE['cidema_userFuncionario'];
		}
		require_once 'library/'.implode('/',explode('_',$nomeClasse)).'.php';
	}

	spl_autoload_register('meu_autoloader');

	try {
	    $factory = new Command_Factory();
	    $factory->createCommand()->execute();
	} catch (Exception_Pagenotfound $ep) {
	    echo '<h1>ERRO 404 - Página não encontrada</h1>';
	} catch (Exception $e) {
	    echo '<h1>ERRO 500 - Erro na execução</h1>';
	}
?>