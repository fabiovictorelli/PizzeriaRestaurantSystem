<?PHP 
   require ( "../lib/victorelli.lib.php");
   MostraCabec("Pesquisa de Clientes ");
   MostraMenuPedidos();
?>

<?PHP
   $PIZZASTRADICIONAIS=1;
   $PIZZASESPECIAIS=2;
   $PIZZASPREMIUM=3;
   $PIZZASSUPREMAS=4;
   $CALZONE=5;
   $CALZONEESPECIAL=6;
   $LASANHAS=7;

   $cod_cliente=$_POST['cod_cliente'];
   $numeropedido=$_POST['numeropedido'];
   $telefone=$_POST['telefone'];
   $nome=$_POST['nome'];
   $endereco=$_POST['endereco'];
   $local=$_POST['local'];
   $nummesa=$_POST['nummesa'];
   $numpizza=$_POST['numpizza'];
   $continuapedido=$_POST['continuapedido'];
   $valorbebidas=$_POST['valorbebidas'];
   $taxaentrega=$_POST['taxaentrega'];
   $troco=$_POST['troco'];
   $observacao=$_POST['observacao'];
   $valoralimentos=$_POST['valoralimentos'];

   $valortotal=0;

   $indice=($numpizza - 1 ) * 12;
   $arraypedido=$_POST['arraypedido'];                          // ufa consegui receber array

//      print_r($arraypedido);

// Primeiro item:

   $tamanhopizza=$arraypedido[$indice];
   $sabor1=$arraypedido[$indice+1];
   $sabor2=$arraypedido[$indice+2];
   $sabor3=$arraypedido[$indice+3];
   $borda=$arraypedido[$indice+4];
   $valorpizza=$arraypedido[$indice+5];
   $tamanhocalzone=$arraypedido[$indice+6];
   $calzone=$arraypedido[$indice+7];
   $valorcalzone=$arraypedido[$indice+8];
   $tamanholasanha=$arraypedido[$indice+9];
   $lasanha=$arraypedido[$indice+10];
   $valorlasanha=$arraypedido[$indice+11];



//   $arraypedido[] = $nome;           //apendando no array conteudo variavel $nome
//   $arraypedido[] = 'grande';        //apendando no array palavra "grande"


//   echo"<BR>mostra numpizza=$numpizza<BR>";


//   Debuga(" _POST= ");
//   print_r($_POST);
//   Debuga("<BR>");

//   Debuga("telefone=[$telefone] nome=[$nome] endereco=[$endereco]<BR>");
//   Debuga("local=[$local] tamanhopizza=[$tamanhopizza] numpizza=[$numpizza]<BR>");
//   Debuga("sabor1=[$sabor1] sabor2=[$sabor2] sabor3=[$sabor3]<BR>");
//   Debuga("borda=[$borda] calzone=[$calzone] lasanha=[$lasanha]<BR>");

// Verificando se o usuario preencheu os campos obrigatorio
   if (empty($telefone)) {
      MostraErro( "<BR><BR> O campo Telefone deve ser preenchido!<BR>");
   }
   if (empty($local)) {
      MostraErro( "<BR><BR> O campo local deve ser preenchido!<BR>");
   }
   if (empty($tamanhopizza) and empty($tamanhocalzone) and empty($tamanholasanha)) {
      MostraErro( "<BR><BR> O campo tamanho deve ser preenchido!<BR>");
   }
   if (empty($sabor1) and empty($calzone) and empty($lasanha)) {
      MostraErro( "<BR><BR> Voce deve escolher pelo menos 1 sabor !<BR>");
   }
   if ( $local == "mesa" and empty($nummesa) ) {
      MostraErro( "<BR><BR> Voce deve escolher um numero de mesa!<BR>");
   }
  
   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 


// Tratando os campos com valores, e substituindo ',' por '.'
//
// OBS: na minha base de dados o delimitador para o array é o caracter pipe '|', por isto
//      ele nao pode ser usado nos campos.


   if ( ! empty($valoralimentos ) ) {                           
      $valoralimentos= ereg_replace(",", ".", $valoralimentos);       //transformanto string para float
   }
   if ( ! empty($valorbebidas ) ) {
      if ( strstr($valorbebidas, "|" ) ) {
         MostraErro( "<BR><BR> Voce não pode usar caracter \"|\" no campo bebidas !<BR>");
      }
      $valorbebidas= ereg_replace(",", ".", $valorbebidas);
   }

   if ( ! empty($taxaentrega ) ) {
      if ( strstr($taxaentrega, "|" ) ) {
         MostraErro( "<BR><BR> Voce não pode usar caracter \"|\" no campo taxa entrega !<BR>");
      }
      $taxaentrega= ereg_replace(",", ".", $taxaentrega);
   }

   if ( ! empty($troco ) ) {
      if ( strstr($troco, "|" ) ) {
         MostraErro( "<BR><BR> Voce não pode usar caracter \"|\" no campo troco !<BR>");
      }
      $troco= ereg_replace(",", ".", $troco);
   }

   if ( strstr($observacao, "|" ) ) {
      MostraErro( "<BR><BR> Voce não pode usar caracter \"|\" no campo observacao !<BR>");
   }



   $numelementosarray= count($arraypedido);
//   echo "numelementosarray= $numelementosarray <BR>";

   echo "<HR>";
   $pedidoformatado = sprintf("%04d",$numeropedido);




// Colocando Cabecalho  no pedido para Balcao, Mesa ou para Entrega
   if ( $telefone == "1" ) {
      echo "<b>Pedido=$pedidoformatado - Balcão </b><BR>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"local\" VALUE=\"balcao\"></INPUT>";
   } elseif ( $telefone == "2" ) {
      echo "<b>Pedido=$pedidoformatado - Mesa </b><BR>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"local\" VALUE=\"mesa\"></INPUT>";
   } else {
       echo "<b>Pedido=$pedidoformatado - Telefone:$telefone - $nome - <BR>$endereco   -  cod_cliente=$cod_cliente</b><BR>";
   }


//   echo "Pedido para:$local";

   $imprimir= "Victorelli Restaurante Pizzaria 3016-0009\n";
   $imprimir = $imprimir . "Pedido: " .$pedidoformatado. "             ".date("d/m/y - H:i")."\n\n";


   if ( $telefone != "1" and $telefone != "2" ) { 
      $imprimir = $imprimir . "Cliente          :" .$nome."\n";
      $imprimir = $imprimir . "Telefone         :" .$telefone."\n";
      $imprimir = $imprimir . "Endereco         :" .$endereco."\n\n";
   }

   $auxlocal = strtoupper($local);

   if ( $auxlocal == "MESA" ) {
      $imprimir = $imprimir . "Localidade       :" .$auxlocal." nr.".$nummesa."\n";
   }else{
      $imprimir = $imprimir . "Localidade       :" .$auxlocal."\n";
   }
   $imprimir = $imprimir . "________________________________________________";




   $imprimir = MontaBufferImpressao ( $conn, $imprimir , $arraypedido );

   $valortotal+=$valoralimentos;

   $troco= ereg_replace(",", ".", $troco);
   $trocado= ereg_replace(",", ".", $trocado);
   $valortotal= ereg_replace(",", ".", $valortotal);

//   Debuga ("valoralimentos=$valoralimentos   - valortotal=$valortotal");


   if ( ! empty($valorbebidas) ) {
      $imprimir = $imprimir . "\nBebidas         =" .sprintf("R$ %01.2f",$valorbebidas); //R$bebdas
      $valortotal+=$valorbebidas;
   }

   if ( ! empty($taxaentrega) ) {
      $imprimir = $imprimir . "\nTX entrega      =" .sprintf("R$ %01.2f",$taxaentrega); //txentrega
      $valortotal+=$taxaentrega;
   }

   if ( $valoralimentos != $valortotal ) {
      $imprimir = $imprimir . "\nAlimentos       =" .sprintf("R$ %01.2f",$valoralimentos); //aliments
   }

   $imprimir = $imprimir . "\n                              __________________";
   $imprimir = $imprimir . "\n                              TOTAL  =  " .sprintf("R$ %01.2f",$valortotal). "\n";  //Total

   if ( ! empty ($troco ) ) {
      $imprimir = $imprimir . "\nTroco para      :" .sprintf("R$ %01.2f",$troco);
      $trocado = $troco - $valortotal;
      $trocado= ereg_replace(",", ".", $trocado);

      if ( $local == "entrega" ) {
         $imprimir = $imprimir . "\n\n***Motoqueiro levar :" .sprintf("R$ %01.2f",$trocado)." de troco.\n";
      }else {
         $imprimir = $imprimir . "\n\n***Troco do cliente :" .sprintf("R$ %01.2f",$trocado)." de troco.\n";
      }
   }
   if ( ! empty ($observacao ) ) {
      $imprimir = $imprimir . "\nOBS.:" .$observacao;
   }


// Avancando o papel
      $imprimir = $imprimir ."\n\n\n\n\n\n\n\n\n\n";

// Gravando arquivo temporario para impressao

   $Arqtemp="/tmp/temp";
//   echo "Gravando arquivo para impressão...$Arqtemp<BR>";
   $id = fopen($Arqtemp, "w") or die ("Falha abrindo arquivo: $Arqtemp");
   fwrite($id,$imprimir,4096)or die ("Falha escrevendo arquivo: $Arqtemp");
   fclose($id);

// Imprimindo arquivo temporario

   $auxdebug= ereg_replace("\n", "<BR>", $imprimir);
//   echo "imprimir==$imprimir<BR>";
//     Debuga ("<BR>auxdebug=$auxdebug");
//   echo "Agora vou imprimir arquivo $Arqtemp";


   $pid=exec("/usr/bin/lp $Arqtemp > /dev/null & echo \$!");
//   echo "imprimi pedido - descomentar linha acima, pois senao gasto muito papel hehehe";


//  Gravando na base de dados o pedido  

   $data_agora = mktime(date('G,i,s,m,d,Y')); //guarda o valor em segundos decorridos desde 01/01/1970 - 0h0min0s até o segundo atual

//   echo "data_agora = $data_agora";

// OBS: para gravar no banco de dados preciso colocar numa string com delimitador | 
   $arrayparabanco = implode("|", $arraypedido);
//   Debuga("arrayparabanco = $arrayparabanco");


   $result = pg_Exec($conn,
                        "INSERT INTO pedidos VALUES ('$data_agora','$cod_cliente','$local', '$nummesa','$numpizza','$valoralimentos', '$valorbebidas', '$taxaentrega', '$valortotal','$troco', '$trocado', '$observacao','$arrayparabanco');");
   if (!$result) {
      echo "Ocorreu um erro durante a inclusao na base de dados.\n";
      pg_Close($conn);
      exit;
   }

   echo "<BR><BR><b>Pedido gravado com sucesso!</b>";

   pg_FreeResult($result);
   pg_Close($conn);

   echo "<hr size=1 align=center>";
   echo "<A HREF=$HOME/bd/pedidos/index.php>Outro Pedido</A>";

   echo "</BODY>";
   echo "</HTML>";

?>
