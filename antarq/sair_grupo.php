<?php include "includes/cabeca.dll"; ?>
<title>Sair Grupo? - <?php echo "$namesite"; ?></title>

<?php
session_start();
$de=$_POST["id"];
$denome=$_POST["nome"];

if(isset($_POST["cadastrar"])) { // Verifico se o bot�o cadastrar foi acionado
	
	if(!empty($_POST["us1"]) && !empty($_POST["us1name"])) { // Verifico se os campos foram preenchidos
		
		$us1 = $class->antisql($_POST["us1"]); // Filtro os dados de login name originados do formul�rio
		$us2 = $class->antisql($_POST["us2"]); // Filtro a senha originada do formul�rio
		$us1name = $class->antisql($_POST["us1name"]); // Filtro o e-mail originado do formul�rio
		$senha = $class->antisql($_POST["senha"]); // Filtro o e-mail originado do formul�rio
		
		$senha_sha1 = sha1($senha); // Codifico a senha inserida para consulta SQL
		
		$repeat_user = mysql_query("SELECT * FROM us_grupo WHERE us='$id_gen';") or die($mensagem_erro = "<b>Houve um erro:</b><br />".mysql_error()); // Fa�o a consulta ao SQL para verificar se n�o h� usu�rios com o mesmo login name
		$repeat_user1 = mysql_query("SELECT * FROM users1 WHERE id='$id_gen' AND senha='$senha';") or die($mensagem_erro = "<b>Houve um erro:</b><br />".mysql_error()); // Fa�o a consulta ao SQL para verificar se n�o h� usu�rios com o mesmo login name
		
		if(mysql_num_rows($repeat_user1) > 0) { // Verifico se a consulta retorna algum resultado. Nesse caso, se retornar, define uma mensagem de erro.
			
			$mensagem_erro = "<b>senha incorreta</b>";
		
		if(mysql_num_rows($repeat_user) < 0) { // Verifico se a consulta retorna algum resultado. Nesse caso, se retornar, define uma mensagem de erro.
			
			$mensagem_erro = "<b>voce nao esta em nenhum grupo</b>";
		}
		else {
			
			$insert = mysql_query("delete from us_grupo where us='$id_gen';") or die(mysql_error()); // Insiro os dados no BD
			
			if($insert) { // Verifico se a query foi executada com sucesso. Se sim, define mensagem de sucesso.
				
				$mensagem_erro = "<b>voce saiu com sucesso!</b>";
			}}
		}
		
	}
	else { // Se houver algum campo em branco, define mensagem de erro
	
		$mensagem_erro = "<b>Por favor, preencha os campos corretamente!</b>";
		
	}		
}
?>
<html>
<head>
<title>Enviar Mensagem</title>
<style>
body {
	
	font-family: Arial;
	font-size: 12px;
}
b {
	font-size: 11px;
}
table {
	font-size:  13px;
}
p{
	font-size: 11px;
}
</style>
</head>
<body><br>
<?php include("includes/cb.dll"); ?>
<form method="post" action="<?php $PHP_SELF; ?>">
<table width="600" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td><?php echo $mensagem_erro; ?></td>
  </tr>
  <tr>
    <td><table width="550" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="53"></td>
        <td width="477"><label>
          <input type="hidden" name="us1" value="<?php echo $row["id"]; ?>">
        </label></td>
      </tr>
      <tr>
        <td>Deseja sair do grupo?</td>
        <td><label>
          <input type="hidden" name="us2" value="<?php echo "$de"; ?>">
        </label></td>
      </tr>
      <tr>
        <td></td>
        <td><label>
          <input type="hidden" name="us1name" value="<?php echo $row["nome"]; ?>">
        </label></td>
      </tr>
      <tr>
        <td>Senha:</td>
        <td><label>
          <input type="password" name="senha" value="">
        </label></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><label>
          <input type="submit" name="cadastrar" value="sair" />
        </label></td>
      </tr>
    </table></td>
  </tr>
</table>
</form><div align="left">
<a href="cadastrados.php">Voltar</a>
</div>
</body>
<?php include("includes/fb.dll"); ?>
</html>
