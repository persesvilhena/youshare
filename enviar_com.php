<?php
include "protege.php";
?>
<?php
session_start();
include "conexao.php";

if(isset($_POST["cadastrar"])) { // Verifico se o bot�o cadastrar foi acionado
	
	if(!empty($_POST["msg"]) && !empty($_POST["uid"])) { // Verifico se os campos foram preenchidos
		
		$msg = $class->antisql($_POST["msg"]); // Filtro os dados de login name originados do formul�rio
		$uid = $class->antisql($_POST["uid"]); // Filtro os dados de login name originados do formul�rio
		
		$senha_sha1 = sha1($senha); // Codifico a senha inserida para consulta SQL
		
		$repeat_user = mysql_query("SELECT * FROM del WHERE us1='$msg'") or die($mensagem_erro = "<b>Houve um erro:</b><br />".mysql_error()); // Fa�o a consulta ao SQL para verificar se n�o h� usu�rios com o mesmo login name
		
		if(mysql_num_rows($repeat_user) > 0) { // Verifico se a consulta retorna algum resultado. Nesse caso, se retornar, define uma mensagem de erro.
			
			$mensagem_erro = "<b>J� existe um usu�rio com este login name!</b>";
		}
		else {
			
			$insert = mysql_query("INSERT INTO com_news VALUES(null, '$id_gen', '$login', '$msg', '$uid')") or die(mysql_error()); // Insiro os dados no BD
			
			if($insert) { // Verifico se a query foi executada com sucesso. Se sim, define mensagem de sucesso.
				
				$mensagem_erro = "<b>Usu�rio cadastrado com sucesso!</b>";
			}
		}
		
	}
	else { // Se houver algum campo em branco, define mensagem de erro
	
		$mensagem_erro = "<b>Nenhum caractere encontrado</b>";
		
	}		
}
?>