<?PHP 
   require ( "../../lib/victorelli.lib.php");
   MostraCabec("Alteração Tipos de Produtos");
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

   echo "<FORM ACTION=\"dbaltera2.php\" METHOD=\"POST\">";
   echo "<INPUT TYPE=\"hidden\" NAME=\"cod_tiposprodutos\" VALUE=\"$cod_tiposprodutos\" </INPUT>";
   echo "Nome:";
   echo "<INPUT TYPE=\"text\" NAME=\"nome\" VALUE=\"$nome\" SIZE=\"30\"></INPUT> ";
   echo "<P>Valor broto:";
   echo "<INPUT TYPE=\"text\" NAME=\"valorbroto\" VALUE=\"$valorbroto\" SIZE=\"10\"></INPUT> ";
   echo "<P>Valor medio:";
   echo "<INPUT TYPE=\"text\" NAME=\"valormedio\" VALUE=\"$valormedio\" SIZE=\"10\"></INPUT> ";
   echo "<P>Valor grande:";
   echo "<INPUT TYPE=\"text\" NAME=\"valorgrande\" VALUE=\"$valorgrande\" SIZE=\"10\"></INPUT> ";
   echo "<P>Valor master:";
   echo "<INPUT TYPE=\"text\" NAME=\"valormaster\" VALUE=\"$valormaster\" SIZE=\"10\"></INPUT> <BR><BR>";
   echo "<P>Valor big:";
   echo "<INPUT TYPE=\"text\" NAME=\"valorbig\" VALUE=\"$valorbig\" SIZE=\"10\"></INPUT> <BR><BR>";

   pg_Close($conn);
?>

<INPUT TYPE="submit" VALUE="Alterar"></INPUT>
<INPUT TYPE="reset" VALUE="Limpar"></INPUT>
</FORM>
<?PHP MostraRodape(); ?>
