<?PHP 
   require ( "../../lib/victorelli.lib.php");
   MostraCabec("Listagem de Produtos por Nome");
   MostraMenuAdmProdutos();

   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 
   $result = pg_Exec($conn, "Select * from produtos ORDER BY nome;");
   $num = pg_NumRows($result);

   if($num == 0) { MostraErro("Não existem produtos cadastradas!\n<BR>Você deve cadastrar um produto primeiro !\n"); }

   echo "<table  border=\"1\"  cellpadding=\"1\" cellspacing=\"1\">";
   echo "<tr align=\"center\"> <td>NOME</td><td>NUMERO</td><td>TIPO</td><td>DESCRICAO</td></tr>";
   for($i = 0; $i < $num; $i++) {

      echo "<tr align=\"left\"> <td>";
      echo pg_Result($result, $i, "nome");
      echo "</td><td>";

      $numero= pg_Result($result, $i, "numero");
      echo "<FORM ACTION=\"dbpesquisa.php\" METHOD=\"POST\">";
      echo "<INPUT TYPE=\"hidden\" NAME=\"numero\" VALUE=\"$numero\" SIZE=\"10\"></INPUT>";
      echo "<INPUT TYPE=\"submit\" VALUE=\"";
      echo "$numero\"></INPUT>";
      echo "</FORM>";

      echo "</td><td>";

      $tipo=pg_Result($result, $i, "cod_tiposprodutos");
      $nometipo= MostraNomeTipo($conn,$tipo);
      echo "$tipo - $nometipo";
      echo "</td><td>";
      echo pg_Result($result, $i, "descricao");
      echo "</td></tr>";
   }
   echo "</table>";
   
   pg_FreeResult($result);
   pg_Close($conn);
?>                              
<BR>
</CENTER>
</FORM>
<?PHP MostraRodape(); ?>
