<?PHP 
   require ( "../../lib/victorelli.lib.php");
   MostraCabec("Listagem Tipos de Produtos por Nome");
   MostraMenuAdmTiposProdutos();

   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 

   // $result = pg_Exec($conn, "Select * from tiposprodutos;");

   $result = pg_Exec($conn, "Select * from tiposprodutos ORDER BY cod_tiposprodutos;");
   $num = pg_NumRows($result);

   if($num == 0) {
      MostraErro("Não existem tipos de produtos cadastradas!\n<BR>Você deve cadastrar um tipo de produto primeiro !\n");
   }

   echo "<table  border=\"1\"  cellpadding=\"1\" cellspacing=\"1\">";
   echo "<tr align=\"center\"> <td>Numero</td> <td>NOME</td><td>VALOR BROTO</td><td>VALOR MEDIO</td><td>VALOR GRANDE</td><td>VALOR MASTER</td><td>VALOR BIG</td></tr>";
   for($i = 0; $i < $num; $i++) {

      echo "<tr align=\"left\"> <td>";
      $cod_tiposprodutos= pg_Result($result, $i, "cod_tiposprodutos");
      echo "$cod_tiposprodutos</td><td>";
      $nome= pg_Result($result, $i, "nome");
      echo "<FORM ACTION=\"dbpesquisa.php\" METHOD=\"POST\">";
      echo "<INPUT TYPE=\"hidden\" NAME=\"cod_tiposprodutos\" VALUE=\"$cod_tiposprodutos\" </INPUT>";
      echo "<INPUT TYPE=\"submit\" VALUE=\"";
      echo "$nome\"></INPUT>";
      echo "</FORM>";

      echo "</td><td>";
      $aux=pg_Result($result, $i, "valorbroto");
      $valorretorno=number_format($aux, 2, ',', '.');   
      echo $valorretorno;
      echo "</td><td>";

      $aux=pg_Result($result, $i, "valormedio");
      $valorretorno=number_format($aux, 2, ',', '.');   
      echo $valorretorno;
      echo "</td><td>";

      $aux=pg_Result($result, $i, "valorgrande");
      $valorretorno=number_format($aux, 2, ',', '.');   
      echo $valorretorno;
      echo "</td><td>";

      $aux=pg_Result($result, $i, "valormaster");
      $valorretorno=number_format($aux, 2, ',', '.');   
      echo $valorretorno;
      echo "</td><td>";

      $aux=pg_Result($result, $i, "valorbig");
      $valorretorno=number_format($aux, 2, ',', '.');   
      echo $valorretorno;
      echo "</td>";
      
//      Debuga("<td>cod_tiposprodutos=$cod_tiposprodutos</td>");

      echo "</tr>";

   }
   echo "</table>";
   
   pg_FreeResult($result);
   pg_Close($conn);
?>                              
<BR>
</CENTER>
</FORM>
<?PHP MostraRodape(); ?>
