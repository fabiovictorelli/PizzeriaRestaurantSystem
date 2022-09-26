<?PHP 
   require ( "../lib/victorelli.lib.php");
   MostraCabec("Listagem de Clientes por Data");
   MostraMenuClientes();

   $data_agora = mktime(date('G,i,s,m,d,Y')); //guarda o valor em seg. desde 01/01/70 -até o segundo atual
   $aux = strftime("%d/%m/%Y %H:%M:%S",$data_agora);

   $meiodia=43200;                // numero de segundos de meio dia, 12 horas
   $umdia=86400;                  // numero de segundos de um dia, 24 horas
   $tresdias= $umdia * 3;
   $setedias= $umdia * 7;
   $trintadias= $umdia * 30;
   $sessentadias= $umdia * 60;
   $noventadias= $umdia * 90;
   $umano= $trintadias * 12;
   $dezanos= $umano * 10;
   $trintaanos= $umano * 30;
   $cemanos= $umano * 100;

   $ultimas12hs = $data_agora - $meiodia;
   $ultimas24hs = $data_agora - $umdia;
   $ultimos3dias = $data_agora - $tresdias;
   $ultimos7dias = $data_agora - $setedias;
   $ultimos30dias = $data_agora - $trintadias;
   $ultimos60dias = $data_agora - $sessentadias;
   $ultimos90dias = $data_agora - $noventadias;
   $ultimoano = $data_agora - $umano;


   $aux1 = strftime("%d/%m/%Y %H:%M:%S",$ultimas24hs);
   $segundos=$data_agora -$ultimas24hs;

   $horassolicitadas = $ultimos90dias;



   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 

   $result = pg_Exec($conn, "Select * from clientes WHERE data_cadastro >='$horassolicitadas' ORDER BY endereco ;");


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
