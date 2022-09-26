<?PHP
   require ( "../lib/victorelli.lib.php");
   MostraCabec("Pedidos de Clientes:");
   MostraMenuPedidos();


   echo "<FORM ACTION=\"$HOME/bd/clientes/dbpesquisa.php\" METHOD=\"POST\">";
   echo "<P>Telefone:";
   echo "<INPUT TYPE=\"text\" NAME=\"telefone\" SIZE=\"10\"></INPUT>";
   echo "<INPUT TYPE=\"submit\" VALUE=\"Pesquisar\"></INPUT>";
   echo "<INPUT TYPE=\"reset\" VALUE=\"Limpar\"></INPUT>";
   echo "</FORM>";

// pedido para Balcao   , telefone = 1

   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao BD");

   $result = pg_Exec($conn, "select cod_cliente,telefone,nome,endereco from clientes WHERE telefone = '1';");
   $num = pg_NumRows($result);
   if ( $num > 0 ) {
      $cod_cliente= trim(pg_Result( $result, $i, "cod_cliente" ));
      $auxfone= trim(pg_Result( $result, $i, "telefone" ));
      $auxnome= trim(pg_Result( $result, $i, "nome" ));
      $auxendereco= trim(pg_Result( $result, $i, "endereco" ));
      //echo "<BR>auxfone=$auxfone telefone=$telefone i=$i num=$num"; 

      echo "<FORM ACTION=\"$HOME/bd/pedidos/dbpedepizza.php\" METHOD=\"POST\">";
      echo "<INPUT TYPE=\"hidden\" NAME=\"cod_cliente\" VALUE=\"$cod_cliente\" ></INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"telefone\" VALUE=\"$auxfone\" ></INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"nome\" VALUE=\"$auxnome\" ></INPUT> ";
      echo "<INPUT TYPE=\"hidden\" NAME=\"endereco\" VALUE=\"$auxendereco\" ></INPUT>";
      echo "<INPUT TYPE=\"submit\" VALUE=\"Pedir Pizza Balcao\"></INPUT>";
      echo "</FORM>";
  }
  else { 
      MostraErro("Nao existe telefone 1 cadastrado para Balcao ainda, configurar o sistema! ");
      exit;
  }
 
  pg_FreeResult($result);


// pedido para Mesa   , telefone = 2


   $result = pg_Exec($conn, "select cod_cliente,telefone,nome,endereco from clientes WHERE telefone = '2';");
   $num = pg_NumRows($result);
   if ( $num > 0 ) {
      $cod_cliente= trim(pg_Result( $result, $i, "cod_cliente" ));
      $auxfone= trim(pg_Result( $result, $i, "telefone" ));
      $auxnome= trim(pg_Result( $result, $i, "nome" ));
      $auxendereco= trim(pg_Result( $result, $i, "endereco" ));
      //echo "<BR>auxfone=$auxfone telefone=$telefone i=$i num=$num"; 

      echo "<FORM ACTION=\"$HOME/bd/pedidos/dbpedepizza.php\" METHOD=\"POST\">";
      echo "<INPUT TYPE=\"hidden\" NAME=\"cod_cliente\" VALUE=\"$cod_cliente\" ></INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"telefone\" VALUE=\"$auxfone\" ></INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"nome\" VALUE=\"$auxnome\" ></INPUT> ";
      echo "<INPUT TYPE=\"hidden\" NAME=\"endereco\" VALUE=\"$auxendereco\" ></INPUT>";
      echo "<INPUT TYPE=\"submit\" VALUE=\"Pedir Pizza Mesa\"></INPUT>";
      echo "</FORM>";
  }
  else { 
      MostraErro("Nao existe telefone 2 cadastrado para Mesa ainda, configurar o sistema !");
      exit;
  }


   pg_Close($conn);
   MostraRodape();

?>

