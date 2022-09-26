<?PHP 
   require ( "../lib/victorelli.lib.php");
   MostraCabec("Listagem de Clientes por Nome");
   MostraMenuClientes();

   $letra=$_POST['letra'];

   Debuga("<BR> recebi letra=$letra<BR>");
   if ( empty($letra)) {
      MostraErro("Você deve passar uma letra inicial do nome do cliente !\n");
   }

   $letraminuscula=strtolower($letra);

   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 
   $result = pg_Exec($conn, "Select * from clientes WHERE nome LIKE '$letra%' OR nome LIKE '$letraminuscula%' ORDER BY nome;");
   $num = pg_NumRows($result);

   if($num == 0) {
      MostraErro("Não existem clientes cadastrados com a letra inicial=[$letra] <BR>");
   }

   echo "<table  border=\"1\"  cellpadding=\"1\" cellspacing=\"1\">";
   echo "<tr align=\"center\"> <td>NOME</td><td>TELEFONE</td><td>ENDEREÇO</td><td>DATA</td></tr>";
   for($i = 0; $i < $num; $i++) {

      $nome=pg_Result($result, $i, "nome");
      $endereco=pg_Result($result, $i, "endereco");
      echo "<tr align=\"left\"> <td>$nome</td><td>";

      $telefone= pg_Result($result, $i, "telefone");
      echo "<FORM ACTION=\"dbpesquisa.php\" METHOD=\"POST\">";
      echo "<INPUT TYPE=\"hidden\" NAME=\"telefone\" VALUE=\"$telefone\" ></INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"nome\" VALUE=\"$nome\" ></INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"endereco\" VALUE=\"$endereco\"></INPUT>";
      echo "<INPUT TYPE=\"submit\" VALUE=\"";
      echo "$telefone\"></INPUT>";
      echo "</FORM>";

      echo "</td><td>$endereco</td><td>";
      $dataformatolong = pg_Result($result, $i, "data_cadastro");
      //$aux = strftime("%d/%m/%Y - %H:%M:%S",$dataformatolong); 
      $aux = strftime("%d/%m/%y - %H:%M",$dataformatolong); 
      echo "$aux";
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
