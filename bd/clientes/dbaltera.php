<?PHP 
   require ( "../lib/victorelli.lib.php");
   MostraCabec("Alteração de Clientes ");
   MostraMenuClientes();

   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 

   $telefone=$_POST['telefone'];
   $nome=$_POST['nome'];
   $endereco=$_POST['endereco'];

   Debuga("variaaveis= telefone=[$telefone] nome=[$nome] endereco=[$endereco]<BR>");

   echo "<FORM ACTION=\"dbaltera2.php\" METHOD=\"POST\">";
   echo "<P>Telefone: $telefone <BR>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"telefone\" VALUE=\"$telefone\" SIZE=\"10\"></INPUT>";
   echo "Nome:";
   echo "<INPUT TYPE=\"text\" NAME=\"nome\" VALUE=\"$nome\" SIZE=\"70\"></INPUT> <BR>";
   echo "<P>Endereço:";
   echo "<INPUT TYPE=\"text\" NAME=\"endereco\" VALUE=\"$endereco\" SIZE=\"87\"></INPUT> <BR><BR>";




   pg_Close($conn);
?>

<INPUT TYPE="submit" VALUE="Alterar"></INPUT>
<INPUT TYPE="reset" VALUE="Limpar"></INPUT>
</CENTER>
</FORM>
<?PHP MostraRodape(); ?>
