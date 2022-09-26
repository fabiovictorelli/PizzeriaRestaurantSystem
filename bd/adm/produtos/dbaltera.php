<?PHP 
   require ( "../../lib/victorelli.lib.php");
   MostraCabec("Alteração de Produtos ");
   MostraMenuAdmProdutos();

   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 

   $numero=$_POST['numero'];
   $nome=$_POST['nome'];
   $cod_tiposprodutos=$_POST['cod_tiposprodutos'];
   $descricao=$_POST['descricao'];

   Debuga("variaaveis= numero=[$numero] nome=[$nome] cod_tiposprodutos=[$cod_tiposprodutos]<BR>");

   echo "<FORM ACTION=\"dbaltera2.php\" METHOD=\"POST\">";
   echo "<P>Numero: $numero <BR>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"numero\" VALUE=\"$numero\" SIZE=\"10\"></INPUT>";
   echo "Nome:";
   echo "<INPUT TYPE=\"text\" NAME=\"nome\" VALUE=\"$nome\" SIZE=\"70\"></INPUT> <BR>";
   echo "<P>Descricao:";
   echo "<INPUT TYPE=\"text\" NAME=\"descricao\" VALUE=\"$descricao\" SIZE=\"87\"></INPUT> <BR><BR>";
   pg_Close($conn);

// Selecionando o cod_tiposprodutos
   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 
   $result = pg_Exec($conn, "Select * from tiposprodutos ORDER BY cod_tiposprodutos;");
   $num = pg_NumRows($result);

   if($num == 0) {
      MostraErro("Não existem tipos de produtos cadastradas!\n
                  <BR>Você deve cadastrar um tipo de produto primeiro !\n");
   }
   echo "<font size=\"+1\">Tipo:</font>";
   echo "<select name=\"cod_tiposprodutos\">";
   for($i = 0; $i < $num; $i++) {
      echo "<tr align=\"left\"> <td>";
      $nomeaux= pg_Result($result, $i, "nome");
      $auxtipo= pg_Result($result, $i, "cod_tiposprodutos");
      if ( $auxtipo == $cod_tiposprodutos ) {
         echo "<option value=$auxtipo selected>$nomeaux";
      }
      else {
         echo "<option value=$auxtipo>$nomeaux";
      }
   }
   echo "</select> ";
   pg_FreeResult($result);
   pg_Close($conn);

?>

<INPUT TYPE="submit" VALUE="Alterar"></INPUT>
<INPUT TYPE="reset" VALUE="Limpar"></INPUT>
</CENTER>
</FORM>
<?PHP MostraRodape(); ?>
