<?PHP 
   require ( "../lib/victorelli.lib.php");
   MostraCabec("Listagem de Pedidos de hoje ");
   MostraMenuPedidos();

   $localaux=$_POST['localaux'];
   $listagem=$_POST['listagem'];

   $cod_clienteaux=$_POST['cod_cliente'];

//   Debuga(" _POST= ");
//   print_r($_POST);
//   Debuga("<BR>");


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
 
   switch ($listagem) {
      case ( $listagem == "Ultimas12Horas" ): 
          echo "<BR><BR><font size=\"+1\">Listagem das Ultimas 12 horas :</font>";
          $horassolicitadas = $ultimas12hs ;  break;
      case ( $listagem == "Ultimas24Horas" ):
          echo "<BR><BR><font size=\"+1\">Listagem das Ultimas 24 horas :</font>";
          $horassolicitadas = $ultimas24hs;  break;
      case ( $listagem == "Ultimos3Dias"):
          echo "<BR><BR><font size=\"+1\">Listagem dos Ultimos 3 dias :</font>";
          $horassolicitadas = $ultimos3dias;  break;
      case ( $listagem == "Ultimos7Dias"):
          echo "<BR><BR><font size=\"+1\">Listagem das Ultimos 7 dias :</font>";
          $horassolicitadas = $ultimos7dias;  break;
      case ( $listagem == "Ultimos30Dias"):
          if ( ! empty($cod_clienteaux ) ){
             echo "<BR><BR><font size=\"+1\">Listagem das Ultimos 30 dias cod_cliente=$cod_clienteaux:</font>";
          }
          else {
             echo "<BR><BR><font size=\"+1\">Listagem das Ultimos 30 dias :</font>";
          }
          $horassolicitadas = $ultimos30dias;  break;
      case ( $listagem == "Ultimos60Dias"):
          if ( ! empty($cod_clienteaux ) ){
             echo "<BR><BR><font size=\"+1\">Listagem das Ultimos 60 dias cod_cliente=$cod_clienteaux:</font>";
          }
          else {
             echo "<BR><BR><font size=\"+1\">Listagem das Ultimos 60 dias :</font>";
          }
          $horassolicitadas = $ultimos60dias;  break;
      case ( $listagem == "Ultimos90Dias"):
          if ( ! empty($cod_clienteaux ) ){
             echo "<BR><BR><font size=\"+1\">Listagem das Ultimos 90 dias cod_cliente=$cod_clienteaux:</font>";
          }
          else {
             echo "<BR><BR><font size=\"+1\">Listagem das Ultimos 90 dias :</font>";
          }
          $horassolicitadas = $ultimos90dias;  break;
      case ( $listagem == "UmAno"):
          echo "<BR><BR><font size=\"+1\">Listagem do ultimos ano :</font>";
          $horassolicitadas = $umano;  break;
   }


//   Debuga ("localaux=$localaux listagem=$listagem - horassolicitadas=$horassolicitadas - <BR> data_agora=$data_agora - aux=$aux - ultimas12hs=$ultimas12hs - ultimas24hs=$ultimas24hs - aux1=$aux1 segundos=$segundos");

   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 
   if ( ! empty($cod_clienteaux) ) {
      $result = pg_Exec($conn, "Select * from pedidos WHERE cod_cliente ='$cod_clienteaux';");
      $num = pg_NumRows($result);
      if($num == 0) {
         $cliente=MostraCliente($conn,$cod_clienteaux, "nome");
         MostraErro("<BR><BR>Não existem pedidos cadastradas para cliente $cliente - cod_cliente=[$cod_clienteaux] !");
      }
   }
   else{
      if ( $localaux == "todos" ) {
         $result = pg_Exec($conn, "Select * from pedidos WHERE data_pedido >='$horassolicitadas';");
      }
      if ( $localaux == "mesa" ) {
         $result = pg_Exec($conn, "Select * from pedidos WHERE data_pedido >='$horassolicitadas' AND local='mesa';");
      }
      if ( $localaux == "balcao" ) {
         $result = pg_Exec($conn, "Select * from pedidos WHERE data_pedido >='$horassolicitadas' AND local='balcao';");
      }
      if ( $localaux == "entrega" ) {
         $result = pg_Exec($conn, "Select * from pedidos WHERE data_pedido >='$horassolicitadas' AND local='entrega';");
      }

      $num = pg_NumRows($result);
      if($num == 0) {
         MostraErro("<BR>Não existem pedidos cadastradas!<BR>Você deve cadastrar um pedido primeiro !");
      }
   }

//   Debuga ("num=$num");

   echo "<table  border=\"1\"  cellpadding=\"1\" cellspacing=\"1\">";

   echo "<tr align=\"center\"><td>DATA</td><td>CLIENTE</td><td>LOCAL</td><td>$ Bebidas</td><td>TX entrega</td><td>VALOR Alimentos</td><td>Total</td><td>troco</td><td>observacao</td><td>Nr.</td></tr>";

   $totalbebidas=0;
   $totaltxentrega=0;
   $totalalimentos=0;
   $totalgeral=0;
   $totalitens=0;

for($i = 0; $i < $num; $i++) {
      echo "<tr align=\"left\"> ";
      $dataformatolong = pg_Result($result, $i, "data_pedido");
      $dataaux = strftime("%d/%m %H:%M",$dataformatolong); 
      $dataaux2 = strftime("%d/%m/%y - %H:%M",$dataformatolong); 
//      echo "$dataaux";
      $numeropedido= pg_Result($result, $i, "numero");
      $cod_cliente= pg_Result($result, $i, "cod_cliente");
      $local= pg_Result($result, $i, "local");
      $nummesa= pg_Result($result, $i, "nummesa");
      $numpizza= pg_Result($result, $i, "numpizza");
      $valoralimentos= pg_Result($result, $i, "valoralimentos");
      $valorbebidas= pg_Result($result, $i, "valorbebidas");
      $taxaentrega= pg_Result($result, $i, "taxaentrega");
      $valortotal= pg_Result($result, $i, "valortotal");
      $troco= pg_Result($result, $i, "troco");
      $trocado= pg_Result($result, $i, "trocado");
      $observacao= pg_Result($result, $i, "observacao");
      $pedido= pg_Result($result, $i, "arraypedidos");
      $arraypedido= explode("|", $pedido);
      $numelementosarray= count($arraypedido);


      $totalalimentos+=$valoralimentos;
      $totaltxentrega+=$taxaentrega;
      $totalbebidas+=$valorbebidas;
      $totalgeral+= $valortotal;
      $totalitens+=$numpizza;


   $imprimir="";
   $imprimir = MontaBufferImpressao ( $conn, $imprimir , $arraypedido );



// Agora mostrando a listagem encontrada no BD

      echo "<td>$dataaux</td>";
      $cliente=MostraCliente($conn,$cod_cliente, "nome");
      if ( $cliente == "erro" ) { $cliente = "cliente removido"; }
      $telefone=MostraCliente($conn,$cod_cliente, "telefone");
      if ( $telefone == "erro" ) { $telefone = "telefone removido"; }
      $endereco=MostraCliente($conn,$cod_cliente, "endereco");
      if ( $endereco == "erro" ) { $endereco = "endereco removido"; }

      echo "<td>$cliente</td>";
      if ( $local == "mesa" ) {
         echo "<td>$local $nummesa</td>";
      }else{ 
         echo "<td>$local</td>";
      }

// Tratando os valores , imprimindo com R$ ,00 e se for vazio imprimo '-'

      if ( ! empty ($valorbebidas ) ){ 
         $valorbebidas= ereg_replace(",", ".", $valorbebidas);
         $imprimir = $imprimir . "<BR>Bebidas     =" .sprintf("R$ %01.2f",$valorbebidas); //R$bebdas
         $valorbebidas= sprintf("R$ %01.2f",$valorbebidas);
         echo "<td>$valorbebidas</td>";}
      else { echo "<td>-</td>";}

      if ( ! empty ($taxaentrega ) ){ 
         $taxaentrega= ereg_replace(",", ".", $taxaentrega);
         $imprimir = $imprimir . "<BR>TX entrega  =" .sprintf("R$ %01.2f",$taxaentrega); //txent
         $taxaentrega= sprintf("R$ %01.2f",$taxaentrega);
         echo "<td>$taxaentrega</td>";}
      else { echo "<td>-</td>";}

      if ( ! empty ($valoralimentos ) ){ 
         if ( $valoralimentos != $valortotal ) {
            $valoralimentos= ereg_replace(",", ".", $valoralimentos);
            $imprimir = $imprimir . "<BR>Alimentos   =" .sprintf("R$ %01.2f",$valoralimentos); //alim.
         }
         $valoralimentos= ereg_replace(",", ".", $valoralimentos);
         $valoralimentos= sprintf("R$ %01.2f",$valoralimentos);
         echo "<td>$valoralimentos</td>"; }
      else { echo "<td>-</td>";}

      if ( ! empty ($valortotal ) ){ 
         $valortotal= ereg_replace(",", ".", $valortotal);
         $imprimir = $imprimir . "<BR>                            ___________________";
         $imprimir = $imprimir . "<BR>Valor Total =" .sprintf("R$ %01.2f",$valortotal). "<BR>"; //Total
         $valortotal= sprintf("R$ %01.2f",$valortotal);
         echo "<td>$valortotal</td>";}
      else { echo "<td>-</td>";}

      if ( ! empty ($troco ) ){ 
         $troco= ereg_replace(",", ".", $troco);
         $imprimir = $imprimir . "Troco para :" .sprintf("R$ %01.2f",$troco)."<BR>";
         $troco= sprintf("R$ %01.2f",$troco);
         echo "<td>$troco</td>";

         if ( $local == "entrega" ) {
            $imprimir = $imprimir . "<BR>***Motoqueiro levar :" .sprintf("R$ %01.2f",$trocado)." de troco.<BR>";
         }else {
            $imprimir = $imprimir . "<BR>***Troco do cliente :" .sprintf("R$ %01.2f",$trocado)." de troco.<BR>";
         }
      }
      else { echo "<td>-</td>";}

      if ( ! empty ($observacao ) ){ 
         echo "<td>$observacao</td>";
         $imprimir = $imprimir . "OBS.:" .$observacao."<BR>";
      }
      else { echo "<td>-</td>";}
//      echo "<td>$numelementosarray</td>";


   $imprimircabec= "Victorelli Restaurante Pizzaria 3016-0009<BR>";
   $pedidoformatado = sprintf("%04d",$numeropedido);
   $imprimircabec = $imprimircabec . "Pedido: " .$pedidoformatado. "             ".$dataaux2."<BR>";
   if ( $telefone != "1" and $telefone != "2" ) { 
      $imprimircabec = $imprimircabec . "Cliente          :" .$cliente."<BR>";
      $imprimircabec = $imprimircabec . "Telefone         :" .$telefone."<BR>";
      $imprimircabec = $imprimircabec . "Endereco         :" .$endereco."<BR>";
   }

   $auxlocal = strtoupper($local);

   if ( $auxlocal == "MESA" ){
      $imprimircabec = $imprimircabec . "Localidade       :" .$auxlocal." nr.".$nummesa."<BR>";
   }else {
      $imprimircabec = $imprimircabec . "Localidade       :" .$auxlocal."<BR>";
   }
   $imprimircabec = $imprimircabec . "________________________________________________" ."<BR>";

// Aqui abro uma janela pequena do browser com os dados do pedido
// Chamo o JavaScript makeget na minha lib que Recebe (formulario,largura,altura,top,left)
    echo "<td>";
    echo "<form name=\"form1\" method=\"post\" action=\"listasoum.php\">";
    echo "<INPUT TYPE=\"hidden\" NAME=\"imprimircabec\" VALUE=\"$imprimircabec\" ></INPUT>";
    echo "<INPUT TYPE=\"hidden\" NAME=\"imprimir\" VALUE=\"$imprimir\" ></INPUT>";
    echo "<p><input type=\"button\" value=\"$numeropedido\" onClick=\"makeget(this.form,480,570,200,300)\"p>";
    echo "</FORM>";
    echo "</td>";


   echo "</tr>";
} // fim do for dos valores que vem do BD

   $totalbebidas= sprintf("R$ %01.2f",$totalbebidas);
   $totaltxentrega= sprintf("R$ %01.2f",$totaltxentrega);
   $totalalimentos= sprintf("R$ %01.2f",$totalalimentos);
   $totalgeral= sprintf("R$ %01.2f",$totalgeral);

   echo "<tr align=\"left\"><td>TOTAIS</td><td>-</td><td>-</td><td>$totalbebidas</td><td>$totaltxentrega</td><td>$totalalimentos</td><td>$totalgeral</td><td>-</td><td>-</td><td>$totalitens</td></tr>";
   
   echo "</table>";
   
   pg_FreeResult($result);
   pg_Close($conn);
?>                              
<BR>
</CENTER>
</FORM>
<?PHP MostraRodape(); ?>
