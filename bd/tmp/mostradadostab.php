<?php
/*
$type=$_POST['type'];
$qtext = $_POST['qtext'];

$db = mysql_connect($hostn, $userid,$passid);
mysql_select_db($dbname,$db);
*/
?>

<html>
<head>
</head>

<body onLoad="document.forms[0].dbname.focus()">
<center><font face="verdana">
<form name="form15" method="post" action="mostradadostab.php">
  <table width="100%" border="0" bordercolor="#000000" bgcolor="#FFE1D2">
    <td bgcolor="#FFC2A6" align="left" colspan="6">Mostra Dados de Uma Tabela
    <tr>
      <td width="1">Base:</td>
      <td width="20"><input tabindex="2" type="text" name="dbname"  value="<?php echo($dbname);?>"></td>
      <td width="1">&nbsp;</td>
      <td>Preencha os Dados ao Lado e Clique em Executa: </td>
    </tr>
    <tr>
      <td>User:</td>
      <td width="20"><input  tabindex="3" type="text" name="userid"  value="<?php echo($userid);?>"></td>
      <td width="1">&nbsp;</td>
      <td rowspan="4">
        <input tabindex="8" type="Submit" name="submit" value="Executa"></td>
    </tr>
    <tr>
      <td width="1">Pass:&nbsp;</td>
      <td><input tabindex="4" type="password" name="passid" value="<?php echo($passid);?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="1">Tabela:</td>
      <td width="20"><input tabindex="5" type="text" name="tabela"  value="<?php echo($tabela);?>"></td>
      <td><input type="hidden" name="type" value="query" ></td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp; </td>
      <td>&nbsp;</td>
    </tr>
  </table>
</form>
</center>
<?php
if($type =="query"){
    mysql_connect("$hostn", "$userid", "$passid");
    mysql_select_db("$dbname");
    $result = mysql_query("SELECT * FROM $tabela");
    $fields = mysql_num_fields($result);
    $rows   = mysql_num_rows($result);
    $table = mysql_field_table($result, 0);
    echo "A tabela: '".$table."' possui ".$fields." colunas e ".$rows." linha(s)\n<br>";
    echo "Dados da tabela:\n<br>";
    for ($i=0; $i < $fields; $i++) {
        $type  = mysql_field_type($result, $i);
        $name  = mysql_field_name($result, $i);
        $len   = mysql_field_len($result, $i);
        $flags = mysql_field_flags($result, $i);
        echo "<br>Nome:".$name."<br>Tipo:".$type."<br>Tamanho:".$len."<br>Flags:".$flags."\n<br>";
    }
    mysql_free_result($result);
    mysql_close();
}
?>
</body>
</html>
