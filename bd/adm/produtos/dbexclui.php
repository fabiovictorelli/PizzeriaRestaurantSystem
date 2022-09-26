<?PHP 
   require ( "../../lib/victorelli.lib.php");
   MostraCabec("Exclusão de Produtos ");
   MostraMenuAdmProdutos();
   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 

   $numero=$_POST['numero'];
   $nome=$_POST['nome'];
   $tipo=$_POST['tipo'];
   $descricao=$_POST['descricao'];

   Debuga("variaveis= numero=[$numero] nome=[$nome] tipo=[$tipo]<BR>");

   echo "<TABLE BORDER=1 ><TR><TD>";
   echo "<FORM ACTION=\"dbexclui2.php\" METHOD=\"POST\">";
   echo "Numero: $numero </TD></TR><TR><TD>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"numero\" VALUE=\"$numero\" SIZE=\"10\"></INPUT>";
   echo "Nome: $nome</TD></TR><TR><TD>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"nome\" VALUE=\"$nome\" SIZE=\"70\"></INPUT> ";
   echo "Tipo: $tipo</TD></TR><TR><TD>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"tipo\" VALUE=\"$tipo\" SIZE=\"87\"></INPUT> ";
   echo "Descricao: $descricao</TD></TR>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"descricao\" VALUE=\"$descricao\" SIZE=\"87\"></INPUT> ";
   echo "</TABLE>";
   echo "<H4> Voce tem certeza que quer excluir o produto acima ? </H4>";

   pg_Close($conn);
?>

<INPUT TYPE="submit" VALUE="Excluir mesmo"></INPUT>
</CENTER>
</FORM>
<?PHP MostraRodape(); ?>
