<?PHP 
   require ( "../lib/victorelli.lib.php");
   MostraCabec("Pesquisa de Clientes ");
   MostraMenuClientes();
?>

<?PHP
   $telefone=$_POST['telefone'];
   $nome=$_POST['nome'];
   $endereco=$_POST['endereco'];
   
//   Debuga("variaaveis= telefone=[$telefone] nome=[$nome] endereco=[$endereco]<BR>");

// Verificando se o usuario preencheu os campos obrigatorio
   if (empty($telefone)) { MostraErro( "<BR><BR> O campo Telefone deve ser preenchido!<BR>"); }

   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 

// Verificando se o telefone ja esta gravado
   $testafone = pg_Exec($conn, "select cod_cliente,telefone,nome,endereco from clientes WHERE telefone = '$telefone';");
      // trim() tira os espacos em brancos  do comeco ate o fim da base de dados 
   $num = pg_NumRows($testafone);

   if ( $num > 0 ) {
      $cod_cliente= trim(pg_Result( $testafone, $i, "cod_cliente" ));
      $auxfone= trim(pg_Result( $testafone, $i, "telefone" ));
      $auxnome= trim(pg_Result( $testafone, $i, "nome" ));
      $auxendereco= trim(pg_Result( $testafone, $i, "endereco" ));
      //echo "<BR>auxfone=$auxfone telefone=$telefone i=$i num=$num"; 
      pg_Close($conn);
      echo "<table>";
      echo "<TR><TD>";
      echo"<BR>telefone <b>$telefone</b> já está cadastrado para: <b><BR>$auxnome <BR>Endereco:$auxendereco  -  cod_cliente=$cod_cliente</b>";
      echo "</TD></TR><TR><TD>";
      echo "<FORM ACTION=\"$HOME/bd/clientes/dbaltera.php\" METHOD=\"POST\">";
      echo "<INPUT TYPE=\"hidden\" NAME=\"cod_cliente\" VALUE=\"$cod_cliente\" ></INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"telefone\" VALUE=\"$auxfone\" ></INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"nome\" VALUE=\"$auxnome\" ></INPUT> ";
      echo "<INPUT TYPE=\"hidden\" NAME=\"endereco\" VALUE=\"$auxendereco\" ></INPUT>";
      echo "<INPUT TYPE=\"submit\" VALUE=\"Alterar\"></INPUT>";
      echo "</FORM>";
      echo "</TD>";

      echo "<TD>";
      echo "<FORM ACTION=\"$HOME/bd/clientes/dbexclui.php\" METHOD=\"POST\">";
      echo "<INPUT TYPE=\"hidden\" NAME=\"cod_cliente\" VALUE=\"$cod_cliente\" ></INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"telefone\" VALUE=\"$auxfone\" ></INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"nome\" VALUE=\"$auxnome\" ></INPUT> ";
      echo "<INPUT TYPE=\"hidden\" NAME=\"endereco\" VALUE=\"$auxendereco\" ></INPUT>";
      echo "<INPUT TYPE=\"submit\" VALUE=\"Excluir\"></INPUT>";
      echo "</FORM>";
      echo "</TD></TR>";

      echo "<TR><TD>";
      echo "<FORM ACTION=\"$HOME/bd/pedidos/dbpedepizza.php\" METHOD=\"POST\">";
      echo "<INPUT TYPE=\"hidden\" NAME=\"cod_cliente\" VALUE=\"$cod_cliente\" ></INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"telefone\" VALUE=\"$auxfone\" ></INPUT>";
      echo "<INPUT TYPE=\"hidden\" NAME=\"nome\" VALUE=\"$auxnome\" ></INPUT> ";
      echo "<INPUT TYPE=\"hidden\" NAME=\"endereco\" VALUE=\"$auxendereco\" ></INPUT>";
      echo "<INPUT TYPE=\"submit\" VALUE=\"PedirPizzas\"></INPUT>";
      echo "</FORM>";
      echo "</TD></TR>";

      echo "</table>";
      MostraRodape();
      exit;
   }

   echo "<BR><BR>Telefone ainda não cadastrado, vamos cadastrar:";
   echo "<FORM ACTION=\"$HOME/bd/clientes/dbinclusao.php\" METHOD=\"POST\">";
   echo "<P>Telefone:";
   echo "<INPUT TYPE=\"text\" NAME=\"telefone\" VALUE=\"$telefone\" SIZE=\"10\"></INPUT>";
   echo "Nome:";
   echo "<INPUT TYPE=\"text\" NAME=\"nome\" SIZE=\"50\"></INPUT> <BR>";
   echo "<P>Endereço:";
   echo "<INPUT TYPE=\"text\" NAME=\"endereco\" SIZE=\"67\"></INPUT> <BR><BR>";

   pg_Close($conn);
?>

<INPUT TYPE="submit" VALUE="Cadastrar"></INPUT>
<INPUT TYPE="reset" VALUE="Limpar"></INPUT>
</CENTER>
</FORM>
<?PHP MostraRodape(); ?>
