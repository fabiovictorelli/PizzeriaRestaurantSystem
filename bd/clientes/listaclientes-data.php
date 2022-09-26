<?PHP 
   require ( "../lib/victorelli.lib.php");
   MostraCabec("Listagem de Clientes por Data");
   MostraMenuClientes();

   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 
   $result = pg_Exec($conn, "Select * from clientes ORDER BY data_cadastro;");
   $num = pg_NumRows($result);

   if($num == 0) {
      MostraErro("Não existem clientes cadastradas!\n<BR>Você deve cadastrar um cliente primeiro !\n");
   }

   echo "<table  border=\"1\"  cellpadding=\"1\" cellspacing=\"1\">";
   echo "<tr align=\"center\"> <td>DATA</td><td>NOME</td><td>TELEFONE</td><td>ENDEREÇO</td></tr>";
   for($i = 0; $i < $num; $i++) {
      echo "<tr align=\"left\"> <td>";
      $dataformatolong = pg_Result($result, $i, "data_cadastro");
      //$aux = strftime("%d/%m/%Y %H:%M:%S",$dataformatolong); 
      $aux = strftime("%d/%m/%y_%H:%M",$dataformatolong); 
      echo "$aux";
      $nome= pg_Result($result, $i, "nome");
      $telefone= pg_Result($result, $i, "telefone");
      $endereco= pg_Result($result, $i, "endereco");

      echo "</td><td>$nome</td><td>";

      echo "<FORM ACTION=\"dbpesquisa.php\" METHOD=\"POST\">";
      echo "<INPUT TYPE=\"hidden\" NAME=\"telefone\" VALUE=\"$telefone\" ></INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"nome\" VALUE=\"$nome\" ></INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"endereco\" VALUE=\"$endereco\" ></INPUT>";
      echo "<INPUT TYPE=\"submit\" VALUE=\"";
      echo "$telefone\"></INPUT>";
      echo "</FORM>";
      echo "</td><td>$endereco</td></tr>";
   }
   echo "</table>";
   
   pg_FreeResult($result);
   pg_Close($conn);
?>                              
<BR>
</CENTER>
</FORM>
<?PHP MostraRodape(); ?>
