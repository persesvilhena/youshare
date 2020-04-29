<link rel="stylesheet" href="css/style.css" type="text/css">
<?php include("includes/cabecaf.dll"); ?>
<title>Entrar - <?php echo "$namesite"; ?></title>
<?php
session_start();
$mensagem_erro = "<b>Cadastre-se gratuitamente!</b>";

if(!empty($_COOKIE["nome"]) && !empty($_COOKIE["senha"]) && !empty($_COOKIE["id"])) { // Verifico se já existem os cookies de login. Caso existam, redirecionam o user para a página restrita

	header("Location: index.php?index");
	exit();
	
	
}
if(isset($_POST["logar"])) { // Verifico se o botão de login foi acionado
	
	if(!empty($_POST["login"]) && !empty($_POST["senha"])) { // Verifico se os campos foram preenchidos
		
		$login = $class->antisql($_POST["login"]); // Filtro os dados de login name originados do formulário
		$senha = $class->antisql($_POST["senha"]); // Filtro a senha originada do formulário
		
		$senha_sha1 = sha1($senha); // Codifico a senha inserida para consulta ao SQL
		
		$valida_user = mysql_query("SELECT * FROM $tabela WHERE nome='$login' AND senha='$senha'") or die(mysql_error()); // Faço a consulta ao SQL para buscar o usuário com os dados informados pelo form
		
		if(mysql_num_rows($valida_user) > 0) { // Verifico se a consulta retorna alguma linha
			
			$lembrar = $_POST["lembrar"]; // Pego o valor do checkbox 'Lembrar' do formulário
			$info = mysql_fetch_array($valida_user); // Defino a var responsável por trazer as informações do BD
			
			$nome = $info["nome"]; // Recupero o campo nome do BD
			$pass = $info["senha"]; // Recupero o campo senha do BD
			$id_generico = $info["id"]; // Recupero o campo id do BD
			
			$id = base64_encode($id_generico); // Codifico o id para obter mais segurança
			
			if($lembrar == "1") { // Se o checkbox foi marcado, gravo cookies de 1 ano
				
				// Gravo os cookies responsáveis pelo login
				setcookie("nome", $nome, time()+31536000); // setcookie(nome_cookie, valor_cookie, tempo_expiracao)
				setcookie("senha", $pass, time()+31536000); // Nesses casos, usei o tempo como anual
				setcookie("id", $id, time()+31536000); // Assim: time()[agora]+[mais]3153600[60*60*24*365]{segs.*min.= 1 hora em segs => 1 hr em segs * 24 hrs = 1 dia => 1 dia * 365 dias = 1 ano}
				
			}
			else { // Caso contrário, gravo cookies que expirarão assim q o browser fechar
				
				// Gravo os cookies responsáveis pelo login
				setcookie("nome", $nome, 0); // Aqui os cookies expiram assim q o browser fechar
				setcookie("senha", $pass, 0);
				setcookie("id", $id, 0);
			}
			
			// Redireciono para a página restrita
			header("Location: index.php?pag=index");
			exit();
		}
		else { // Se não retornar, define mensagem de erro
			
			$mensagem_erro = "<b>Dados Incorretos!</b>";
		}
	}
	else { // Caso tenha algum campo em branco, define mensagem de erro
		
		$mensagem_erro = "<b>Por favor, preencha os campos corretamente!</b>";
	}
}
?>


<body>
<?php include("includes/ct.dll"); ?><span class="titulo"><div align="center">Bem-Vindo ao You Share</div></span><?php include("includes/ft.dll"); ?>
<?php include("includes/cb.dll"); ?><span class="texto"><div align="center">
</div>
<?php include("includes/fb.dll"); ?><br>
<?php include("includes/ct.dll"); ?><span class="titulo">Entrar:</span><?php include("includes/ft.dll"); ?>

<?php include("includes/cb.dll"); ?><span class="texto">
<form method="post" action="<?php $PHP_SELF; ?>">
<table width="600" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td></td>
  </tr>
  <tr>
    <td><table width="550" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="53">Login:</td>
        <td width="477"><label>
          <input id="cordoinput" type="text" name="login" />
        </label></td>
      </tr>
      <tr>
        <td>Senha:</td>
        <td><label>
          <input id="cordoinput" type="password" name="senha" />
        </label></td>
      </tr>
      <tr>
        <td></td>
        <td><label>
          <input id="cordoinput" type="checkbox" name="lembrar" />Manter-me conectado</label></td>
      </tr>
      <tr>
        <td></td>
        <td><label>
          <button type="submit" name="logar" value="Logar">Logar</button>
        </label></td>
      </tr>
    </table></td>
  </tr>
</table>
</form>
<?php include("includes/fb.dll"); ?>
<br>
<?php include("include/cadastrar.dll"); ?>
<?php include("includes/fimcabeca.dll"); ?>
