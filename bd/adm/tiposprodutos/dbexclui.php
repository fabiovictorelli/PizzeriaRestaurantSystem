<?PHP 
   require ( "../../lib/victorelli.lib.php");
   MostraCabec("Exclusão Tipos de Produtos");
   MostraMenuAdmTiposProdutos();


   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 

   $cod_tiposprodutos=$_POST['cod_tiposprodutos'];
   $nome=$_POST['nome'];
   $valorbroto=$_POST['valorbroto'];
   $valormedio=$_POST['valormedio'];
   $valorgrande=$_POST['valorgrande'];
   $valormaster=$_POST['valormaster'];
   $valorbig=$_POST['valorbig'];

   Debuga("cod_tiposprodutos=[$cod_tiposprodutos] nome=$nome<BR>");

   echo "<TABLE BORDER=1 ><TR><TD>";
   echo "<FORM ACTION=\"dbexclui2.php\" METHOD=\"POST\">";
   echo "Nome: $nome </TD></TR><TR><TD>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"cod_tiposprodutos\" VALUE=\"$cod_tiposprodutos\"</INPUT>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"nome\" VALUE=\"$nome\"</INPUT>";
   echo "Valor Broto: $valorbroto</TD></TR><TR><TD>";
   echo "Valor Medio: $valormedio</TD></TR><TR><TD>";
   echo "Valor Grande: $valorgrande</TD></TR><TR><TD>";
   echo "Valor Master: $valormaster</TD></TR><TR><TD>";
   echo "Valor Big: $valorbig</TD></TR><TR><TD>";
   echo "</TABLE>";
   echo "<H4> Voce tem certeza que quer excluir o cliente acima ? </H4>";

   pg_Close($conn);
?>

<INPUT TYPE="submit" VALUE="Excluir mesmo!"></INPUT>
</CENTER>
</FORM>
<?PHP MostraRodape(); ?>
