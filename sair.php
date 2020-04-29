<?php
session_start();
include "conexao.php"; 

if(isset($_COOKIE["nome"]) && isset($_COOKIE["senha"]) && isset($_COOKIE["id"])) { // Verfico se existem os cookies
	
	// Gravo os cookies como nulos, o que far� o user 'deslogar' 
	setcookie("nome", "", 0);
	setcookie("senha", "", 0);
	setcookie("id", "", 0);
}

// Redireciono o usu�rio para a p�gina de login
header("Location: logar.php");
exit();
?>