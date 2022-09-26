<html>
<head>
<title>TbTxt1.0</title>
</head>
<body background="bkgtbtxt.gif">
<img src="tbtxt.GIF"  border="0" alt="">
<?php

    $id = fopen("texto.txt", "a"); 
	if($modelo && $cor && $ano != ""){
	   //o primeiro separador(*)servirá para separar 
	   //cada sequencia de registros. O segundo(-)servirá 
	   //para individualizar cada campo de sequencia de registros   
	   fwrite($id,"*".$modelo."-".$cor."-".$ano,4096); 
	}elseif(isset($sb1)){
	   echo "<h4 style=\"color:red;font-weight:bold\">Por Favor Preencha Todos os Campos</h4>";	
	}  
?>

<form action="<?=$PHP_SELF?>" name="form1">
Marca:
<input type="text" name="modelo"><br>
Cor:&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="cor"><br>
Ano:&nbsp;&nbsp;&nbsp;
<input type="text" name="ano">
<input type="submit" name="sb1" value="ok">
</form>
<br>
<a href="le_txt.php">Veja</a>
<p align="center"><i><font face="Georgia, Times New Roman, Times, serif" 
color="#99ccff" size="2">Copyright © 2002 <br></i></font>
<i><font face="Georgia, Times New Roman, Times, serif" 
size="2">
<a href="mailto:dermevald@hotmail.com" style="color:#99ccff;" >Dermeval Dias Pereira Junior</a></font></i></p>
</body>
</html>