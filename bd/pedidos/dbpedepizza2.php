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
   $valoralimentos=$_POST['valoralimentos'];

   $indice=($numpizza - 1 ) * 12;
   $arraypedido=$_POST['arraypedido'];                          // ufa consegui receber array
   $numelementosarray= count($arraypedido);

//      print_r($arraypedido);

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

//   Debuga("numelementosarray=[$numelementosarray]");
//   Debuga("telefone=[$telefone] nome=[$nome] endereco=[$endereco]");
//   Debuga("local=[$local] nummesa=[$nummesa] numpizza=[$numpizza] tamanhopizza=[$tamanhopizza] ");
//   Debuga("sabor1=[$sabor1] sabor2=[$sabor2] sabor3=[$sabor3] borda=[$borda] valorpizza=[$valorpizza]"); 
//   Debuga("tamanhocalzone=[$tamanhocalzone] calzone=[$calzone] valorcalzone=[$valorcalzone]");
//   Debuga("tamanholasanha=[$tamanholasanha] lasanha=[$lasanha] valorlasanha=[$valorlasanha]");

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
   if (empty($tamanhopizza) and ! empty($sabor1) and ! empty($sabor2) and ! empty($sabor3)) {
      MostraErro( "<BR><BR> Voce esqueceu de escolher o tamanho da pizza !<BR>");
   }
   if (empty($sabor1) and empty($calzone) and empty($lasanha)) {
      MostraErro( "<BR><BR> Voce deve escolher pelo menos 1 sabor !<BR>");
   }
   if ( $local == "mesa" and empty($nummesa) ) {
      MostraErro( "<BR><BR> Voce deve escolher um numero de mesa!<BR>");
   }


   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível abrir BD");


//   echo "numelementosarray= $numelementosarray <BR>";

   echo "<HR>";
   echo "<b>Pedido:$numeropedido - Cliente:$telefone - $nome <BR>Endereço:$endereco  -  cod_cliente=$cod_cliente </b><BR>";
   echo "Pedido para:$local";
   if ( $local == "mesa" ) {
      echo " nr. $nummesa ";
   }

   if ( $continuapedido == "Finaliza Pedido" ) {
      echo "<FORM ACTION=\"dbpedepizzafim.php\" METHOD=\"POST\">";
   }
   if ( $continuapedido == "Continua Pedido" ) {
      echo "<FORM ACTION=\"dbpedepizza2.php\" METHOD=\"POST\">";
   }

   echo "<BR>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"cod_cliente\" VALUE=\"$cod_cliente\"></INPUT>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"numeropedido\" VALUE=\"$numeropedido\"></INPUT>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"telefone\" VALUE=\"$telefone\"></INPUT>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"nome\" VALUE=\"$nome\"></INPUT>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"endereco\" VALUE=\"$endereco\"></INPUT>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"local\" VALUE=\"$local\"></INPUT>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"nummesa\" VALUE=\"$nummesa\"></INPUT>";

// varrendo o arraypedido para confirmar o pedido

   $i=0;
   $contaitem=0;
   $numpizzaaux=0;
   $valorsabor1=0;
   $valorsabor2=0;
   $valorsabor3=0;
   $valorborda=0;
   $valorcalzone=0;
   $valorlasanha=0;
   //Debuga ("i=$i = numelementosarray=$numelementosarray<BR>");
   for ($posicao = 0; $posicao < $numelementosarray; $posicao++)  {
      $aux=$arraypedido[$posicao];
      //echo "aux=$aux - ";
      // [0]=tamanhopizza    [1]=sabor1          [2]=sabor2       [3]=sabor3  [4]=borda 
      // [5]=valorpizza      [6]=tamanhocalzone  [7]=calzone      [8]=valor do calzone  
      // [9]=tamanholasanha  [10]=lasanha        [11]=valorlasanha

      switch ($i) {
         case 0:
            if ( ! empty($aux)) {                                   // Tamanho da pizza 
               $contaitem++;
               echo "<table border=1>";
               echo "<tr>";
               echo "<td>$contaitem </td>";
               if ( $aux == "broto"  ) { echo "<td>PIZZA  <b>B</b></td>";  }
               if ( $aux == "grande" ) { echo "<td>PIZZA  <b>G</b></td>";  }
               if ( $aux == "master" ) { echo "<td>PIZZA  <b>M</b></td>";  }
               $tamanhopizza=$aux;
            }
            break;
         case 1:
            if ( ! empty($aux)) {                                      // Sabor 1
               $auxnome=MostraNomeProduto($conn,$aux);
               echo "<td> $aux-$auxnome</td>";  
               $valorsabor1=RetornaValorProduto($conn,$tamanhopizza,$aux);
               //Debuga ("peguei o valor do sabor1=$valorsabor1 tamanho=$tamanhopizza");
            }
            break;
         case 2:
            if ( ! empty($aux)) {                                      // Sabor 2
               $auxnome=MostraNomeProduto($conn,$aux);
               echo "<td>$aux-$auxnome</td>"; 
               //Debuga ("vou chamar o RetornaValorProduto tamanho=[$tamanhopizza] sabor2=[$sabor2] ");
               $valorsabor2=RetornaValorProduto($conn,$tamanhopizza,$aux);
               //Debuga ("peguei o valor do sabor2=$valorsabor2 tamanho=$tamanhopizza");
            }
            break;
         case 3:
            if ( ! empty($aux)) {                                      // Sabor 3
               $auxnome=MostraNomeProduto($conn,$aux);
               echo "<td>$aux-$auxnome</td>"; 
               $valorsabor3=RetornaValorProduto($conn,$tamanhopizza,$aux);
               //Debuga ("peguei o valor do sabor3=$valorsabor3 tamanho=$tamanhopizza");
            }
            break;
         case 4:
            if ( $aux == 1 ) {                                              // Borda 
//               echo "<BR>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <b>Borda de Catupiry</b> ";
               echo "<td>Borda de Catupiry</td>";
               if ( $tamanhopizza == "broto" )  { $valorborda=2.0; }
               if ( $tamanhopizza == "grande" ) { $valorborda=2.5; }
               if ( $tamanhopizza == "master" ) { $valorborda=3.0; }
            }
            if ( $aux == 2 ) {                                               // Borda 
//               echo "<BR>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <b>Borda de Cheddar</b> ";
               echo "<td>Borda de Cheddar</td>";
               if ( $tamanhopizza == "broto" )  { $valorborda=2.0; }
               if ( $tamanhopizza == "grande" ) { $valorborda=2.5; }
               if ( $tamanhopizza == "master" ) { $valorborda=3.0; }
            }
            break;
         case 5:                                                        //Valor da pizza 
               // Calculando o valor da pizza, caso sabores.
               $valormaior = ($valorsabor1>=$valorsabor2) ? $valorsabor1 : $valorsabor2;
               $valormaior = ($valormaior>=$valorsabor3) ? $valormaior : $valorsabor3;
              
               if ( $valorborda != 0 ) { $valormaior += $valorborda; } 

               if ( $valormaior != 0 ) {
//                  echo "<b> &nbsp; &nbsp; &nbsp; &nbsp; Valor pizza: ";  
                  echo "<td>";
                  printf("R$ %01.2f </b>",$valormaior);
                  echo "</td></tr></table>";
               }

               $aux=$valormaior;
//               Debuga ("somei a valoralimentos=$valoralimentos o valormaior=$valormaior");
               $valoralimentos+=$valormaior;
            break;
         case 6:
            if ( ! empty($aux)) {                                      //Tamanho do Calzone
               $contaitem++;
               echo "<table border=1><tr><td>$contaitem </td>";
               if ( $aux == "medio" )  { echo "<td>CALZONE     <b>M</b></td>";  }
               if ( $aux == "grande" ) { echo "<td>CALZONE     <b>G</b></td>";  }
               $tamanhocalzone=$aux;
            }
            break;
         case 7:
            if ( ! empty($aux)) {
               $auxnome=MostraNomeProduto($conn,$aux);                  //numero e nome do Calzone
               echo "<td>$aux - $auxnome</td>"; 
               $valorcalzone=RetornaValorProduto($conn,$tamanhocalzone,$aux);
            }
            break;
         case 8:
               if ( $valorcalzone != 0 ) {
//                  echo "<b>&nbsp; &nbsp; &nbsp; &nbsp; Valor Calzone:";    //Valor do Calzone
                  echo "<td>";
                  printf("R$ %01.2f </b>",$valorcalzone);
                  echo "</td></tr></table>";
               }
               $aux=$valorcalzone;
               $valoralimentos+=$valorcalzone;
            break;
         case 9:
            if ( ! empty($aux)) {                                         // Tamanho da Lasanha
               $contaitem++;
               echo "<table border=1><tr><td>$contaitem </td>";
               if ( $aux == "medio" )  { echo "<td>LASANHA     <b>M</b></td>";  }
               if ( $aux == "grande" ) { echo "<td>LASANHA     <b>G</b></td>";  }
               $tamanholasanha=$aux;
            }
            break;
         case 10:   
            if ( ! empty($aux)) {                                         //numero e nome da Lasanha
               $auxnome=MostraNomeProduto($conn,$aux);
               echo "<td>$aux - $auxnome</td>"; 
               $valorlasanha=RetornaValorProduto($conn,$tamanholasanha,$aux);
            }
            break;
         case 11:
               if ( $valorlasanha != 0 ) {
//                  echo "<b>&nbsp; &nbsp; &nbsp; &nbsp; Valor Lasanha:";     // Valor da Lasanha 
                  echo "<td>";
                  printf("R$ %01.2f </b>",$valorlasanha);
                  echo "</td></tr></table>";
               }
               $aux=$valorlasanha;
               $valoralimentos+=$valorlasanha;
            break;
      }

      echo "<INPUT TYPE=\"hidden\" NAME=\"arraypedido[]\" VALUE=\"$aux\" ></INPUT>";
      $i++;
      if ( $i == 12 ) {    //passei em cada variavel do item do array 
//           echo "<HR>";
           $i=0;
           $valorsabor1=0;
           $valorsabor2=0;
           $valorsabor3=0;
           $valorborda=0;
           $valorcalzone=0;
           $valorlasanha=0;
      } 
   }

//           Debuga ("Valor Total dos alimentos=R$ $valoralimentos");
   echo "<BR><b>Valor Total dos alimentos=";
   printf("R$ %01.2f </b><BR>",$valoralimentos);


   if ( $continuapedido == "Finaliza Pedido" ) {
      echo "<INPUT TYPE=\"hidden\" NAME=\"numpizza\" VALUE=\"$numpizza\"></INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"valoralimentos\" VALUE=\"$valoralimentos\"></INPUT>";
      echo "<BR><b>Finalizando Pedido nr. $numeropedido</b><BR>";
      echo "Valor de bebidas ou outros : <INPUT TYPE=\"text\" NAME=\"valorbebidas\" SIZE=\"6\"></INPUT>";
      echo "Taxa de entrega : <INPUT TYPE=\"text\" NAME=\"taxaentrega\" SIZE=\"6\"></INPUT><BR>";
      echo "Troco para: <INPUT TYPE=\"text\" NAME=\"troco\" SIZE=\"6\"></INPUT><BR>";
      echo "Alguma observação:<INPUT TYPE=\"text\" NAME=\"observacao\" SIZE=\"80\"></INPUT><BR><BR>";
      echo "confira e confirme o pedido acima de $numpizza item(ns) ? <BR>";
      echo "<INPUT TYPE=\"submit\" VALUE=\"Confirmar Pedido\"></INPUT>";
      echo "</FORM>";
   } 


   if ( $continuapedido == "Continua Pedido" ) {
      $numpizza++;
      echo "<INPUT TYPE=\"hidden\" NAME=\"numpizza\" VALUE=\"$numpizza\"></INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"valoralimentos\" VALUE=\"\"></INPUT>";
      $contaitem++;
      echo "<BR><b>continuando pedido item $contaitem:</b><BR>";
      echo "<font size=\"+1\">Pizza:</font>";
      echo "<select name=\"arraypedido[]\">";
      echo "  <option value=''> Tamanho";
      echo "  <option value=broto> Broto";
      echo "  <option value=grande> Grande";
      echo "  <option value=master> Master";
      echo "</select><BR>";

// Escolhendo o SABOR 1
   $result = pg_Exec($conn, "Select * from produtos WHERE cod_tiposprodutos = $PIZZASTRADICIONAIS OR cod_tiposprodutos = $PIZZASESPECIAIS OR cod_tiposprodutos = $PIZZASPREMIUM OR cod_tiposprodutos = $PIZZASSUPREMAS ORDER BY cod_tiposprodutos,numero;");
   $num = pg_NumRows($result);
   if($num == 0) { MostraErro("Não existem produtos cadastradas, cadastre um produto primeiro !\n"); }
   echo "<select name=\"arraypedido[]\">";
   echo "  <option value=''>Primeiro Sabor";
   for($i = 0; $i < $num; $i++) {
      $numero=    pg_Result($result, $i, "numero");
      $nomepizza= pg_Result($result, $i, "nome");
      echo "  <option value=$numero> $numero $nomepizza";
   }
   echo "</select>";
   pg_FreeResult($result);

// Escolhendo o SABOR 2
   $result = pg_Exec($conn, "Select * from produtos WHERE cod_tiposprodutos = $PIZZASTRADICIONAIS OR cod_tiposprodutos = $PIZZASESPECIAIS OR cod_tiposprodutos = $PIZZASPREMIUM OR cod_tiposprodutos = $PIZZASSUPREMAS ORDER BY cod_tiposprodutos,numero;");
   $num = pg_NumRows($result);
   if($num == 0) { MostraErro("Não existem produtos cadastradas, cadastre um produto primeiro !\n"); }
   echo "<select name=\"arraypedido[]\">";
   echo "  <option value=''>Segundo Sabor";
   for($i = 0; $i < $num; $i++) {
      $numero=    pg_Result($result, $i, "numero");
      $nomepizza= pg_Result($result, $i, "nome");
      echo "  <option value=$numero> $numero $nomepizza";
   }
   echo "</select>";
   pg_FreeResult($result);


// Escolhendo o SABOR 3
   $result = pg_Exec($conn, "Select * from produtos WHERE cod_tiposprodutos = $PIZZASTRADICIONAIS OR cod_tiposprodutos = $PIZZASESPECIAIS OR cod_tiposprodutos = $PIZZASPREMIUM OR cod_tiposprodutos = $PIZZASSUPREMAS ORDER BY cod_tiposprodutos,numero;");
   $num = pg_NumRows($result);
   if($num == 0) { MostraErro("Não existem produtos cadastradas, cadastre um produto primeiro !\n"); }
   echo "<select name=\"arraypedido[]\">";
   echo "  <option value=''>Terceiro Sabor";
   for($i = 0; $i < $num; $i++) {
      $numero=    pg_Result($result, $i, "numero");
      $nomepizza= pg_Result($result, $i, "nome");
      echo "  <option value=$numero> $numero $nomepizza";
   }
   echo "</select><BR>";
   pg_FreeResult($result);


// Selecionando Borda
   echo "<font size=\"+1\">Borda:</font>";
   echo "<select name=\"arraypedido[]\">";
   echo "  <option value=0>Sem borda";
   echo "  <option value=1>Borda Catupiry";
   echo "  <option value=2>Borda Cheddar";
   echo "</select><BR>";

// colocando espaco em branco no valor da pizza para calcular na proxima vez
   echo "<INPUT TYPE=\"hidden\" NAME=\"arraypedido[]\" VALUE=\"\"></INPUT>";


// Selecionando tamanho do Calzone
   echo "<font size=\"+1\">CALZONES:</font>";
   echo "<select name=\"arraypedido[]\">";
   echo "  <option value=''> Tamanho";
   echo "  <option value=medio> Médio";
   echo "  <option value=grande> Grande";
   echo "</select>";

// Selecionando sabor do Calzone
   $result = pg_Exec($conn, "Select * from produtos WHERE cod_tiposprodutos = $CALZONE OR cod_tiposprodutos = $CALZONEESPECIAL;");
   $num = pg_NumRows($result);
   if($num == 0) { MostraErro("Não existem produtos cadastradas, cadastre um produto primeiro !\n"); }
   echo "<select name=\"arraypedido[]\">";
   echo "  <option value=''>Selecione abaixo";
   for($i = 0; $i < $num; $i++) {
      $numero=    pg_Result($result, $i, "numero");
      $nomepizza= pg_Result($result, $i, "nome");
      echo "  <option value=$numero> $numero $nomepizza";
   }
   echo "</select>";
   pg_FreeResult($result);


// colocando espaco em branco no valor do calzone para calcular na proxima vez
   echo "<INPUT TYPE=\"hidden\" NAME=\"arraypedido[]\" VALUE=\"\"></INPUT>";


// Selecionando LASANHAS

// Selecionando tamanho da LASANHA
   echo "<BR><font size=\"+1\">LASANHAS:</font>";
      echo "<select name=\"arraypedido[]\">";
      echo "  <option value=''> Tamanho";
      echo "  <option value=medio> Média";
      echo "  <option value=grande> Grande";
      echo "</select>";


// Selecionando o sabor da LASANHA

   $result = pg_Exec($conn, "Select * from produtos WHERE cod_tiposprodutos = $LASANHAS;");
   $num = pg_NumRows($result);
   if($num == 0) { MostraErro("Não existem produtos cadastradas, cadastre um produto primeiro !\n"); }
   echo "<select name=\"arraypedido[]\">";
   echo "  <option value=''>Selecione abaixo";
   for($i = 0; $i < $num; $i++) {
      $numero=    pg_Result($result, $i, "numero");
      $nomepizza= pg_Result($result, $i, "nome");
      echo "  <option value=$numero> $numero $nomepizza";
   }
   echo "</select>";
   pg_FreeResult($result);


   pg_Close($conn);

// colocando espaco em branco no valor da lasanha para calcular na proxima vez
   echo "<INPUT TYPE=\"hidden\" NAME=\"arraypedido[]\" VALUE=\"\"></INPUT>";

   echo "<BR><INPUT TYPE=\"submit\" NAME= \"continuapedido\" VALUE=\"Continua Pedido\"></INPUT>";
   echo "<INPUT TYPE=\"submit\" NAME= \"continuapedido\" VALUE=\"Finaliza Pedido\"></INPUT>";
   echo "<INPUT TYPE=\"reset\" VALUE=\"Limpar campos\"></INPUT>";
   echo "</CENTER>";
   echo "</FORM>";

   } // fim do $continuapedido == Continua Pedido
?>

<?PHP MostraRodape(); ?>
