<?PHP 
   require ( "../../lib/victorelli.lib.php");
   MostraCabec("Pesquisa de Produtos ");
   MostraMenuAdmProdutos();
?>

<?PHP
   $numero=$_POST['numero'];
   
   Debuga("variaveis= numero=[$numero] <BR>");

// Verificando se o usuario preencheu os campos obrigatorio
   if (empty($numero)) {
      MostraErro( "<BR><BR> O campo Numero deve ser preenchido!<BR>");
   }

   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 

// Verificando se o numero ja esta gravado
   $testanumero = pg_Exec($conn, "select * from produtos WHERE numero = '$numero';");
   $num = pg_NumRows($testanumero);
   $i=0;
   for($i = 0; $i < $num; $i++) {
      // trim() tira os espacos em brancos  do comeco ate o fim da base de dados 
      $auxnumero= trim(pg_Result( $testanumero, $i, "numero" ));
      $auxnome= trim(pg_Result( $testanumero, $i, "nome" ));
      $auxtipo= trim(pg_Result( $testanumero, $i, "cod_tiposprodutos" ));
      $auxdescricao= trim(pg_Result( $testanumero, $i, "descricao" ));
      $ret=strcmp ( $auxnumero, $numero );
      if ( $ret == 0 ) {
         //echo "<BR>auxnumero=$auxnumero numero=$numero i=$i num=$num"; 
         pg_Close($conn);
         echo "<table>";
         echo "<TR><TD>";
         echo"<BR>numero <b>$numero</b> cadastrado para: <b><BR>$auxnome <BR>Tipo:$auxtipo <BR>Descricao:$auxdescricao<BR></b>";
         echo "</TD></TR><TR><TD>";
         echo "<FORM ACTION=\"dbaltera.php\" METHOD=\"POST\">";
         echo "<INPUT TYPE=\"hidden\" NAME=\"numero\" VALUE=\"$auxnumero\" SIZE=\"10\"></INPUT>";
         echo "<INPUT TYPE=\"hidden\" NAME=\"nome\" VALUE=\"$auxnome\" SIZE=\"30\"></INPUT> ";
         echo "<INPUT TYPE=\"hidden\" NAME=\"cod_tiposprodutos\" VALUE=\"$auxtipo\" SIZE=\"30\"></INPUT>";
         echo "<INPUT TYPE=\"hidden\" NAME=\"descricao\" VALUE=\"$auxdescricao\" SIZE=\"87\"></INPUT>";
         echo "<INPUT TYPE=\"submit\" VALUE=\"Alterar\"></INPUT>";
         echo "</FORM>";
         echo "</TD></TR><TR>";

         echo "<TD>";
         echo "<FORM ACTION=\"dbexclui.php\" METHOD=\"POST\">";
         echo "<INPUT TYPE=\"hidden\" NAME=\"numero\" VALUE=\"$auxnumero\" SIZE=\"10\"></INPUT>";
         echo "<INPUT TYPE=\"hidden\" NAME=\"nome\" VALUE=\"$auxnome\" SIZE=\"70\"></INPUT> ";
         echo "<INPUT TYPE=\"hidden\" NAME=\"cod_tiposprodutos\" VALUE=\"$auxtipo\" SIZE=\"87\"></INPUT>";
         echo "<INPUT TYPE=\"hidden\" NAME=\"descricao\" VALUE=\"$auxdescricao\" SIZE=\"87\"></INPUT>";
         echo "<INPUT TYPE=\"submit\" VALUE=\"Excluir\"></INPUT>";
         echo "</FORM>";

         echo "</TD></TR>";
         echo "</table>";
         MostraRodape();
         exit;
      }
   }
   pg_Close($conn);

   echo "Numero ainda nao cadastrado, vamos cadastrar:";
   echo "<P>Numero:";
   echo "<INPUT TYPE=\"text\" NAME=\"numero\" SIZE=\"10\" VALUE=\"$numero\"></INPUT>";
   echo "<P>Nome:";
   echo "<INPUT TYPE=\"text\" NAME=\"nome\" SIZE=\"30\"></INPUT> <BR>";
   echo "<P>Descricao:";
   echo "<INPUT TYPE=\"text\" NAME=\"descricao\" SIZE=\"87\"></INPUT> <BR><BR>";

   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 
   $result = pg_Exec($conn, "Select * from tiposprodutos ORDER BY nome;");
   $num = pg_NumRows($result);

   if($num == 0) {
      MostraErro("Não existem tipos de produtos cadastradas!\n
                  <BR>Você deve cadastrar um tipo de produto primeiro !\n");
   }
   echo "<font size=\"+1\">Tipo:</font>";
   echo "<select name=\"cod_tiposprodutos\">";
   for($i = 0; $i < $num; $i++) {
      echo "<tr align=\"left\"> <td>";
      $nome= pg_Result($result, $i, "nome");
      $cod_tiposprodutos= pg_Result($result, $i, "cod_tiposprodutos");
      echo "<option value=$cod_tiposprodutos>$nome";
   }
   echo "</select> ";
   pg_FreeResult($result);
   pg_Close($conn);

?>

<INPUT TYPE="submit" VALUE="Cadastrar"></INPUT>
<INPUT TYPE="reset" VALUE="Limpar"></INPUT>
</CENTER>
</FORM>
<?PHP MostraRodape(); ?>
