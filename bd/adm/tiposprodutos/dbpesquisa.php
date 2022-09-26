<?PHP 
   require ( "../../lib/victorelli.lib.php");
   MostraCabec("Pesquisa Tipos de Produtos");
   MostraMenuAdmTiposProdutos();

?>

<?PHP
   $cod_tiposprodutos=$_POST['cod_tiposprodutos'];
   Debuga("cod_tiposprodutos=[$cod_tiposprodutos]<BR>");

// Verificando se o usuario preencheu os campos obrigatorio

   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 

// Verificando se o doc_tiposprodutos esta realmente gravado
   $aux = pg_Exec($conn, "select * from tiposprodutos WHERE cod_tiposprodutos = $cod_tiposprodutos;");
   $num = pg_NumRows($aux);
   Debuga("num=$num");
   if ( $num ) {
      $nome= pg_Result( $aux, $i, "nome" );
      $valorbroto= pg_Result( $aux, $i, "valorbroto" );
      $valormedio= pg_Result( $aux, $i, "valormedio" );
      $valorgrande= pg_Result( $aux, $i, "valorgrande" );
      $valormaster= pg_Result( $aux, $i, "valormaster" );
      $valorbig= pg_Result( $aux, $i, "valorbig" );

      Debuga("<BR>nome=$nome  num=$num"); 
      echo "<table>";
      echo "<TR><TD>";
      echo"<BR>nome <b>$nome</b> já está cadastrado: ";
      echo"<BR><b>valor broto:$valorbroto -medio:$valormedio - grande: $valorgrande - master: $valormaster - big:$valorbig </b>";
      echo "</TD></TR><TR><TD>";
      echo "<FORM ACTION=\"dbaltera.php\" METHOD=\"POST\">";
      echo "<INPUT TYPE=\"hidden\" NAME=\"cod_tiposprodutos\" VALUE=\"$cod_tiposprodutos\" </INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"nome\" VALUE=\"$nome\" </INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"valorbroto\" VALUE=\"$valorbroto\" </INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"valormedio\" VALUE=\"$valormedio\" </INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"valorgrande\" VALUE=\"$valorgrande\" </INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"valormaster\" VALUE=\"$valormaster\" </INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"valorbig\" VALUE=\"$valorbig\" </INPUT>";
      echo "<INPUT TYPE=\"submit\" VALUE=\"Alterar\"></INPUT>";
      echo "</FORM>";
      echo "</TD></TR><TR>";
      
      echo "<TD>";
      echo "<FORM ACTION=\"dbexclui.php\" METHOD=\"POST\">";
      echo "<INPUT TYPE=\"hidden\" NAME=\"cod_tiposprodutos\" VALUE=\"$cod_tiposprodutos\" </INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"nome\" VALUE=\"$nome\" </INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"valorbroto\" VALUE=\"$valorbroto\" </INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"valormedio\" VALUE=\"$valormedio\" </INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"valorgrande\" VALUE=\"$valorgrande\" </INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"valormaster\" VALUE=\"$valormaster\" </INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"valorbig\" VALUE=\"$valorbig\" </INPUT>";
      echo "<INPUT TYPE=\"submit\" VALUE=\"Excluir\"></INPUT>";
      echo "</FORM>";
      
      echo "</TD></TR>";
      echo "</table>";
   }
   pg_Close($conn);
   MostraRodape();

?>
