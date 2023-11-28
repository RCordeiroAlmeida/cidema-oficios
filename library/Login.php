<?php
class Login{	
	var $table;
	
	function validateUser($params, $session){
		if(!isset($_SESSION)){
			session_start();
    	}
		$db = new MySql();
		
		$i = 0;
		foreach($params as $key => $valor){
			if($i == 0){
				$conditions = $key." = '".$valor."'";
				$i++;
			}else{
				$conditions .= " AND ".$key." = '".$valor."'";
			}  
		}
		$sql = "SELECT * FROM ".$this->table." WHERE usu_situacao = 1 AND ".$conditions;
		$result = $db->executeQuery($sql,false);

		if ($db->countLines($result) > 0){
			for ($i=0;$i<$db->countLines($result);$i++){
				$_SESSION['cidema_userId'] 			= $db->result($result, $i,'usu_cod');
				$_SESSION['cidema_userName'] 		= $db->result($result, $i,'usu_nome');	
				$_SESSION['cidema_userEmail'] 		= $db->result($result, $i,'usu_email');									
				$_SESSION['cidema_userPermissao'] 	= $db->result($result, $i,'upe_cod');
				$_SESSION['cidema_userCliente'] 		= $db->result($result, $i,'cli_cod');
				$_SESSION['cidema_userFuncionario']  = $db->result($result, $i,'fun_cod');
				$_SESSION['cidema_userSetor']  		= $db->result($result, $i,'set_cod');
				$_SESSION['cidema_userSession'] 		= $session;

				$retorno['login'] 	 = 'Logado';
				$retorno['nome'] 	 = $db->result($result, $i,'usu_nome');
				$retorno['mensagem'] = "Logado com Sucesso";

				
				// Cria um cookie com o usu�rio
				$tempo_cookie = strtotime("+2 day", time());
				setcookie('cidema_userId', $_SESSION['cidema_userId'], $tempo_cookie, "/");			
				setcookie('cidema_userName', $_SESSION['cidema_userName'], $tempo_cookie, "/");			
				setcookie('cidema_userEmail', $_SESSION['cidema_userEmail'], $tempo_cookie, "/");
				setcookie('cidema_userPermissao', $_SESSION['cidema_userPermissao'], $tempo_cookie, "/");
				setcookie('cidema_userCliente', $_SESSION['cidema_userCliente'], $tempo_cookie, "/");
				setcookie('cidema_userFuncionario', $_SESSION['cidema_userFuncionario'], $tempo_cookie, "/");
				setcookie('cidema_userSetor', $_SESSION['cidema_userSetor'], $tempo_cookie, "/");
				setcookie('cidema_userSession', $_SESSION['cidema_userSession'], $tempo_cookie, "/");				
				setcookie('cidema_idSession', $_SESSION['cidema_idSession'], $tempo_cookie, "/");	
			}
		}else{
			$retorno['login'] 	 = "falha";
			$retorno['mensagem'] = "Senha e/ou login invalido";				
		}
		return $retorno;			
	}

	function logout(){
		unset($_SESSION);
		session_destroy();

	}
	
	function getLogin(){
		if ((isset($_SESSION['cidema_idSession']))&&($_SESSION['cidema_idSession'] == $_SESSION['cidema_userSession'])){
			$retorno['logged'] = "yes";
		}else{
			$retorno['logged'] = "no";
		}
		return $retorno;			
	}	
}

?>