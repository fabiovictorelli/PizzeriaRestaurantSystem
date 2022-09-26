<?PHP 
   require ( "../lib/victorelli.lib.php");
   MostraCabec("Pedido de Pizza ");
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

   $numpizza=1;   
   $continuapedido=0;   

   $cod_cliente=$_POST['cod_cliente'];
   $telefone=$_POST['telefone'];
   $nome=$_POST['nome'];
   $endereco=$_POST['endereco'];

   //Debuga("variaaveis= telefone=[$telefone] nome=[$nome] endereco=[$endereco]<BR>");

// Verificando se o usuario preencheu os campos obrigatorio
   if (empty($telefone)) {
      MostraErro( "<BR><BR> O campo Telefone deve ser preenchido!<BR>");
   }

   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível abrir BD");

// detectando o numero do pedido
   $result = pg_Exec($conn, "Select * from pedidos_seq;");
   $zero=0; 
   $ultimopedido=  pg_Result($result, $zero, "last_value");
   $numeropedido=$ultimopedido+1;
//   Debuga ("num=$num,ultimopedido=$ultimopedido, numeropedido=$numeropedido<BR>");
   pg_FreeResult($result);


// Preenchendo o pedido de pizzas

   echo "<HR>";

   echo "<FORM ACTION=\"dbpedepizza2.php\" METHOD=\"POST\">";

   echo "<INPUT TYPE=\"hidden\" NAME=\"cod_cliente\" VALUE=\"$cod_cliente\"></INPUT>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"numeropedido\" VALUE=\"$numeropedido\"></INPUT>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"telefone\" VALUE=\"$telefone\"></INPUT>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"nome\" VALUE=\"$nome\"></INPUT>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"endereco\" VALUE=\"$endereco\"></INPUT>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"numpizza\" VALUE=\"$numpizza\"></INPUT>";


// Colocando Cabecalho  no pedido para Balcao, Mesa ou para Entrega
   if ( $telefone == "1" ) { 
      echo "<b>Pedido=$numeropedido - Balcão </b><BR>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"local\" VALUE=\"balcao\"></INPUT>";
   } elseif ( $telefone == "2" ) {
      echo "<b>Pedido=$numeropedido - Mesa </b><BR>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"local\" VALUE=\"mesa\"></INPUT>";
   } else { 
       echo "<b>Pedido=$numeropedido - Telefone:$telefone - $nome - <BR>$endereco   -  cod_cliente=$cod_cliente</b><BR>";
   }



// Se o pedido for diferente de Balcao ou Mesa, vou selecionar, pois o cliente esta pedindo por telefone 

   if ( $telefone != "1" and $telefone != "2" ) { 
      echo "<select name=\"local\">";
      echo "  <option value=''>Local";
      echo "  <option value=balcao> Balcao";
      echo "  <option selected value=entrega> Entrega";
      echo "  <option value=mesa> Mesa";
      echo "</select> ";
   }


// Se pedido for diferente de Balcao, vou pedir qual é a mesa
   if ( $telefone != "1" ) {  
      $numerodemesas=ProcuraConfig("numerodemesas");
      //   echo "numerodemesas=$numerodemesas";
      echo "<select name=\"nummesa\">";
      echo "     <option value=''>Mesa Nr.";
      for($i = 1; $i <= $numerodemesas; $i++) {
         echo "  <option value=$i> $i";
      }
      echo "</select> ";
   }

   echo "<HR>";
   echo "<font size=\"+1\">Pizza $numpizza:</font>";

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
//      $tipo=      pg_Result($result, $i, "cod_tiposprodutos");
//      $nometipo=  MostraNomeTipo($conn,$tipo);
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
//      $tipo=      pg_Result($result, $i, "cod_tiposprodutos");
//      $nometipo=  MostraNomeTipo($conn,$tipo);
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
//      $tipo=      pg_Result($result, $i, "cod_tiposprodutos");
//      $nometipo=  MostraNomeTipo($conn,$tipo);
      $numero=    pg_Result($result, $i, "numero");
      $nomepizza= pg_Result($result, $i, "nome");
      echo "  <option value=$numero> $numero $nomepizza";
   }
   echo "</select>";
   pg_FreeResult($result);


// Selecionando Borda
   echo "<BR><font size=\"+1\">Borda:</font>";
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
//      $tipo=      pg_Result($result, $i, "cod_tiposprodutos");
//      $nometipo=  MostraNomeTipo($conn,$tipo);
      $numero=    pg_Result($result, $i, "numero");
      $nomepizza= pg_Result($result, $i, "nome");
      echo "  <option value=$numero> $numero $nomepizza";
   }
   echo "</select>";
   pg_FreeResult($result);


// colocando espaco em branco no valor do calzone para calcular na proxima vez
   echo "<INPUT TYPE=\"hidden\" NAME=\"arraypedido[]\" VALUE=\"\"></INPUT>";


// Selecionando LASANHAS

   echo "<BR><font size=\"+1\">LASANHAS:</font>";

   echo "<select name=\"arraypedido[]\">";
   echo "  <option value=''> Tamanho";
   echo "  <option value=medio> Média";
   echo "  <option value=grande> Grande";
   echo "</select>";

   $result = pg_Exec($conn, "Select * from produtos WHERE cod_tiposprodutos = $LASANHAS;");
   $num = pg_NumRows($result);
   if($num == 0) { MostraErro("Não existem produtos cadastradas, cadastre um produto primeiro !\n"); }
   echo "<select name=\"arraypedido[]\">";
   echo "  <option value=''>Selecione abaixo";
   for($i = 0; $i < $num; $i++) {
//      $tipo=      pg_Result($result, $i, "cod_tiposprodutos");
//      $nometipo=  MostraNomeTipo($conn,$tipo);
      $numero=    pg_Result($result, $i, "numero");
      $nomepizza= pg_Result($result, $i, "nome");
      echo "  <option value=$numero> $numero $nomepizza";
   }
   echo "</select>";
   pg_FreeResult($result);


   pg_Close($conn);

// colocando espaco em branco no valor da lasanha para calcular na proxima vez
   echo "<INPUT TYPE=\"hidden\" NAME=\"arraypedido[]\" VALUE=\"\"></INPUT>";

?>

<BR><INPUT TYPE="submit" NAME= "continuapedido" VALUE="Continua Pedido"></INPUT>
<INPUT TYPE="submit" NAME= "continuapedido" VALUE="Finaliza Pedido"></INPUT>
<INPUT TYPE="reset" VALUE="Limpar campos"></INPUT>
</CENTER>
</FORM>
<?PHP MostraRodape(); ?>
