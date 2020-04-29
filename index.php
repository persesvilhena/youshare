<?php
$pag = $_GET['pag'];
$info1 = $_GET['info1'];
?>
<?php include "includes/cabeca.dll"; ?>
<frameset cols="210,*,200" frameborder="0">
<frame src="painel/painel.php"></frame>
<frame src="redirect.php?<?php echo "$pag"; ?>&info1=<?php echo "$info1"; ?>"></frame>
<frame src="publicidade/index.php"></frame>
</frameset>