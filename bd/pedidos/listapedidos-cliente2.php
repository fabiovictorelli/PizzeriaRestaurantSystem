<?PHP 
   require ( "../lib/victorelli.lib.php");
   MostraCabec("Listagem de Clientes por Nome");
   MostraMenuPedidos();

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


//   echo "<BR>Clique no Nr. do cliente para listar os pedidos dos:";
//   echo "<select name=\"listagem\">";
//   echo "  <option select value=Ultimos30Dias> Ultimos 30 dias";
//   echo "  <option value=Ultimas12Horas> Ultimas 12 horas";
//   echo "  <option value=Ultimas24Horas> Ultimas 24 horas";
//   echo "  <option value=Ultimos3Dias> Ultimos 3 dias";
//   echo "  <option value=Ultimos7Dias> Ultimos 7 dias";
//   echo "  <option value=todos> Todos pedidos";
//   echo "</select> ";




   echo "<BR>Clique no Nr. do cliente para listar os pedidos do cliente:";
   echo "<table  border=\"1\"  cellpadding=\"1\" cellspacing=\"1\">";
   echo "<tr align=\"center\"><td>Nr. Cliente</td> <td>NOME</td><td>TELEFONE</td><td>ENDEREÇO</td></tr>";
   for($i = 0; $i < $num; $i++) {

      $nome=pg_Result($result, $i, "nome");
      $cod_cliente=pg_Result($result, $i, "cod_cliente");
      $endereco=pg_Result($result, $i, "endereco");
      $telefone= pg_Result($result, $i, "telefone");

      echo "<tr align=\"left\">" ;

      echo "<td>"; 
      echo "<FORM ACTION=\"listapedidos2.php\" METHOD=\"POST\">";
      echo "<INPUT TYPE=\"hidden\" NAME=\"cod_cliente\" VALUE=\"$cod_cliente\" ></INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"listagem\" VALUE=\"Ultimos30Dias\" ></INPUT>";
      echo "<INPUT TYPE=\"submit\" VALUE=\"$cod_cliente\"></INPUT>";
      echo "</FORM>";
      echo "<td>$nome</td>";
      echo "<td>$telefone</td>";
      echo "</td><td>$endereco</td>";

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
