<html>
<head>
</head>

<body onLoad="document.forms[0].dbname.focus()">
<center><font face="verdana">
<form name="form15" method="post" action="mostratab.php">
  <table width="100%" border="0" bordercolor="#000000" bgcolor="#FFE1D2">
    <td bgcolor="#FFC2A6" align="left" colspan="7">Mostra Tabelas de Uma Base de Dados
    <tr>
      <td width="1">Base:</td>
      <td width="20"><input tabindex="2" type="text" name="dbname"  value="<?php echo($dbname);?>"></td>
      <td width="1">&nbsp;</td>
      <td colspan="2">Preencha os Dados ao Lado e Clique em Executa :</td>
    </tr>
    <tr>
      <td>User:</td>
      <td width="20"><input  tabindex="3" type="text" name="userid"  value="<?php echo($userid);?>"></td>
      <td width="1">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td width="1">Pass:</td>
      <td><input tabindex="4" type="password" name="passid" value="<?php echo($passid);?>"></td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td width="1">&nbsp;</td>
      <td width="20">&nbsp;</td>
      <td><input type="hidden" name="type" value="query" ></td>
      <td colspan="2"><input tabindex="8" type="Submit" name="submit" value="Executa"></td>
    </tr>

  </table>
</form></center>
<?php
if($type =="query"){
    if (!$dbname){
            echo"<center>Coloque o nome da base de dados e clique em Executar";
            exit;
     }
    else {
    mysql_connect("$hostn", "$userid", "$passid");
    mysql_select_db("$dbname");
    $result = mysql_list_tables($dbname);
     if (!$result) {
        print "DB Error, não pude listar as tabelas\n";
        print 'Erro do MySQL: ' . mysql_error();
        exit;
    }

    while ($row = mysql_fetch_row($result)) {
        print "Table: $row[0]\n<br>";
    }

    mysql_free_result($result);
    }
     mysql_close();
}
?>
</body>
</html>
