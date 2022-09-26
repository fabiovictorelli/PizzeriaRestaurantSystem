<?PHP 
   require ( "../lib/victorelli.lib.php");
   MostraCabec("Exclusão de Clientes ");
   MostraMenuClientes();

   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 

   $telefone=$_POST['telefone'];
   $nome=$_POST['nome'];
   $endereco=$_POST['endereco'];

   Debuga("variaaveis= telefone=[$telefone] nome=[$nome] endereco=[$endereco]<BR>");

   echo "<TABLE BORDER=1 ><TR><TD>";
   echo "<FORM ACTION=\"dbexclui2.php\" METHOD=\"POST\">";
   echo "Telefone: $telefone </TD></TR><TR><TD>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"telefone\" VALUE=\"$telefone\" SIZE=\"10\"></INPUT>";
   echo "Nome: $nome</TD></TR><TR><TD>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"nome\" VALUE=\"$nome\" SIZE=\"70\"></INPUT> ";
   echo "Endereço: $endereco</TD></TR>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"endereco\" VALUE=\"$endereco\" SIZE=\"87\"></INPUT> ";
   echo "</TABLE>";
   echo "<H4> Voce tem certeza que quer excluir o cliente acima ? </H4>";

   pg_Close($conn);
?>

<INPUT TYPE="submit" VALUE="Excluir mesmo"></INPUT>
</CENTER>
</FORM>
<?PHP MostraRodape(); ?>
