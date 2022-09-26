<?
#Script Java Escrito por Jerome Caron (jerome.caron@globetrotter.net)
#Script Auto Drop Down Escrito por Carlos dos Santos (carlosmaster@jedi.com.br)
#Revisão e Atualização Por Neander Araújo (neander@eumesmo.com.br)
?>
<html>
<head>
<title>Auto Drop Down com PhP e MySQL</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#FFFFFF" text="#000000">

<?
#Conexão ao banco de dados
$conecta=mysql_connect("localhost", "root", "root");
$seleciona_db=mysql_select_db("x", $conecta);
?>
<SCRIPT LANGUAGE="JavaScript">
team = new Array(
<?
# Seleciona todos os grupos cadastrados
$sql="select * from grupo order by cod";
$sql_result=mysql_query($sql, $conecta);
$num=mysql_numrows($sql_result);
while ($row=mysql_fetch_array($sql_result)){
$conta=$conta+1;
	$cod_categoria=$row["cod"];
		echo "new Array(\n";
		$sub_sql="select * from subgrupo where cod='$cod_categoria'";
		$sub_result=mysql_query($sub_sql, $conecta);
		$num_sub=mysql_numrows($sub_result);
		if ($num_sub>=1){
# Se ele achar algum subgrupo para o grupo ele marca a palavra Todas
        	echo "new Array(\"Todas\", 0),\n";
			while ($rowx=mysql_fetch_array($sub_result)){
				$codigo_sub=$rowx["cod"];
				$sub_nome=$rowx["descr"];
			$conta_sub=$conta_sub+1;
				if ($conta_sub==$num_sub){
					echo "new Array(\"$sub_nome\", $codigo_sub)\n";
					$conta_sub="";
				}else{
					echo "new Array(\"$sub_nome\", $codigo_sub),\n";
				}
			}
		}else{
#Se ele nao achar subgrupo para o grupo selecionado...
			echo "new Array(\"Qualquer\", 0)\n";
		}
	if ($num>$conta){
		echo "),\n";
	}
}
echo ")\n";
echo ");\n";
?>
//Inicio da função JS
function fillSelectFromArray(selectCtrl, itemArray, goodPrompt, badPrompt, defaultItem) {
var i, j;
var prompt;
// empty existing items
for (i = selectCtrl.options.length; i >= 0; i--) {
selectCtrl.options[i] = null;
}
prompt = (itemArray != null) ? goodPrompt : badPrompt;
if (prompt == null) {
j = 0;
}
else {
selectCtrl.options[0] = new Option(prompt);
j = 1;
}
if (itemArray != null) {
// add new items
for (i = 0; i < itemArray.length; i++) {
selectCtrl.options[j] = new Option(itemArray[i][0]);
if (itemArray[i][1] != null) {
selectCtrl.options[j].value = itemArray[i][1];
}
j++;
}
// select first item (prompt) for sub list
selectCtrl.options[0].selected = true;
   }
}
//  End -->
</script>
<center>
<form name="form1" method="post" action="">
    <p>Aqui tamb&eacute;m temos itens a ser observados, verifique no codigo fonte</p>
    <p><b><font face="Verdana, Arial, Helvetica, sans-serif" size="1">

      <select name="grupo" onChange="fillSelectFromArray(this.form.subgrupo, ((this.selectedIndex == -1) ? null : team[this.selectedIndex-1]));">
        <option>Escolha uma Categoria</option>
        <?
#Seleciona todos os grupos para setar os valores no combo
		  $sql="select * from grupo order by cod";
		  $sql_result=mysql_query($sql, $conecta);
		  while ($row=mysql_fetch_array($sql_result)){
		  $cod_categoria=$row["cod"];
		  $desc_categoria=$row["descr"];
		  ?>
        <option value="<?echo $cod_categoria;?>">
        <?echo $desc_categoria;?>
        </option>
        <?
		  }
#Popula o segundo combo de acordo com a escolha no primeiro
		  ?>
      </select>
      <select name="subgrupo">
        <option>---------------</option>
      </select>
      </font></b> </p>
  </form></center>
</body>
</html>
