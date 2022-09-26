<?PHP 
   require ( "../../lib/victorelli.lib.php");
   MostraCabec("Inclusão de Produtos ");
   MostraMenuAdmProdutos();
?>

<FORM ACTION="dbinclusao.php" METHOD="POST">
<?PHP
   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 


   $result = pg_Exec($conn, "Select * from tiposprodutos ORDER BY cod_tiposprodutos;");
   $num = pg_NumRows($result);
   if($num == 0) { MostraErro("ERRO-Não existem tipos de produtos cadastradas,cadastre-os.<BR>"); }

   echo "<P>Numero:"; echo "<INPUT TYPE=\"text\" NAME=\"numero\" SIZE=\"10\"></INPUT>";
   echo "<P>Nome:"; echo "<INPUT TYPE=\"text\" NAME=\"nome\" SIZE=\"30\"></INPUT> <BR>";
   echo "<P>Descricao:"; echo "<INPUT TYPE=\"text\" NAME=\"descricao\" SIZE=\"87\"></INPUT> <BR><BR>";

   echo "<font size=\"+1\">Tipo:</font>";
   echo "<select name=\"cod_tiposprodutos\">";
   for($i = 0; $i < $num; $i++) {
      echo "<tr align=\"left\"> <td>";
      $nome= pg_Result($result, $i, "nome");
      $cod_tiposprodutos= pg_Result($result, $i, "cod_tiposprodutos");
      echo "<option value=$cod_tiposprodutos>$nome";
   }
   echo "</select> ";
   pg_FreeResult($result);
   pg_Close($conn);
?>                              

<INPUT TYPE="submit" VALUE="Cadastrar"></INPUT>
<INPUT TYPE="reset" VALUE="Limpar"></INPUT>
</CENTER>
</FORM>
<?PHP MostraRodape(); ?>
