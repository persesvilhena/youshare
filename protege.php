<?php

if(!empty($_COOKIE["nome"]) && !empty($_COOKIE["senha"]) && !empty($_COOKIE["id"])){ // Verifico se existe cookies de login

	// Transformo os cookies em vari�veis
	$login = $_COOKIE["nome"];
	$senha = $_COOKIE["senha"];
	$id_gen = base64_decode($_COOKIE["id"]); // Decodifico o id do cookie
	
	// Consulto o BD para ver se os cookies s�o compat�veis com os dados SQL
	$auth_user = "SELECT * FROM $tabela WHERE id='$id_gen' AND nome='$login' AND senha='$senha'";
	$autentica = mysql_query($auth_user); // Executo a busca
	$rs = mysql_fetch_array($autentica); // Defino o array dos resultados para a var $rs
	
	$id = $rs["id"]; // Retorno o id do BD
	
	$rConfirm = mysql_num_rows($autentica); // Var respons�vel por retornar o n�mero de linhas da consulta
	
} 
if (isset($rConfirm) && $rConfirm > '0') { // Verifico se foram retornadas linhas referentes a consulta

	$mysqlq = mysql_query("SELECT * FROM $tabela WHERE id='$id'"); // Fa�o uma consulta para pegar os dados do user
	$row = mysql_fetch_array($mysqlq); // Var respons�vel pelo array de resultados da consulta em $mysqlq	

} 
else { // Se n�o retornar nenhuma linha, redireciona o usu�rio para a p�gina de login
	header ("Location: logar.php");
	exit();
}

?>

