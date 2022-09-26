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
<form name="form15" method="post" action="select.php">
  <table width="100%" border="0" bordercolor="#000000" bgcolor="#FFE1D2">
    <td bgcolor="#FFC2A6" align="left" colspan="6">Execução de Comandos
    <tr>
      <td width="1">Base:</td>
      <td width="20"><input style="text-transform: lowercase;" tabindex="2" type="text" name="dbname"  value="<?php echo($dbname);?>"></td>
      <td width="1">&nbsp;</td>
      <td>Digite a Query Desejada: </td>
    </tr>
    <tr>
      <td>User:</td>
      <td width="20"><input  tabindex="3" type="text" name="userid"  value="<?php echo($userid);?>"></td>
      <td width="1">&nbsp;</td>
      <td rowspan="3"> <p>
          <textarea tabindex="6" name="qtext" rows=5 cols=70 wrap="off"><?php $qtext2 = str_replace("\\", "", $qtext); echo($qtext2);?></textarea>
        </p>
        <p>
          <input tabindex="8" type="Submit" name="submit" value="Executa">
        </p></td>
    </tr>
    <tr>
      <td width="1">Pass:</td>
      <td><input tabindex="4" type="password" name="passid" value="<?php echo($passid);?>"></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td width="1" valign="top">&nbsp;</td>
      <td width="20" valign="top">&nbsp;</td>
      <td><input type="hidden" name="type" value="query" ></td>
    </tr>
  </table>
</form>
</center>
<?php
if($type =="query"){
       $db = mysql_connect($hostn,$userid,$passid);
       mysql_select_db($dbname,$db);

        if (!$qtext) {
        print "<center>Preencha o campo necessário.\n</center><br>";
        exit;
        }
        else {
        $qtext2 = str_replace("\\", "", $qtext);
        $result = mysql_query("$qtext2",$db);
        if (!$result) {
        print "<center>Erro de Sintaxe SQL\n<br>";
        print 'Erro do MySQL: ' . mysql_error().'</center>';
        exit;
          }
        else {
        echo "<table  width=\"100%\" border=\"0\" bgcolor=\"#FFE1D2\">\n";
                 $verificaSelect = substr("$qtext", 0, 6);
              if($verificaSelect!=='select' && $verificaSelect!=='SELECT'){
                      echo"Comando Executado Com Sucesso!<br>";
                      echo"Comando: $qtext2<br>";
                exit;
                }
             else {
             $i = 0;
              while($i < mysql_num_fields($result)){
                    $meta = mysql_fetch_field($result,$i);
                    echo "<td bgcolor=\"#FFC2A6\" align=\"left\" colspan=\"$i\" valign=\"top\">$meta->name</tr>";

                 $i++; }

        while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

            echo"<tr>";
             foreach ($line as $col_value) {

               echo "<td bgcolor=\"#FFE1D2\" align=\"left\" valign=\"top\">$col_value</td>";

                  }

           echo "</tr>";
        }
                 /* Libera o resultado */
        mysql_free_result($result);
        }

        }
        echo "</table>\n";
       $qtext2 = str_replace("\\", "", $qtext);
        /* Fecha a conexão */
       mysql_close($db);

}
}
?>
</body>
</html>
