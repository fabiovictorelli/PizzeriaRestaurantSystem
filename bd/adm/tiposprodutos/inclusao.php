<?PHP 
   require ( "../../lib/victorelli.lib.php");
   MostraCabec("Inclusão Tipos de Produtos ");
   MostraMenuAdmTiposProdutos();
?>

<FORM ACTION="dbinclusao.php" METHOD="POST">
<?PHP
     echo "Use . para separar os centavos, Exemplo 9.90:";
     echo "<P>Nome:";
     echo "<INPUT TYPE=\"text\" NAME=\"nome\" SIZE=\"30\"></INPUT> <BR>";
     echo "<P>Valor Broto:";
     echo "<INPUT TYPE=\"text\" NAME=\"valorbroto\" SIZE=\"10\"></INPUT> ";
     echo "<P>Valor Medio:";
     echo "<INPUT TYPE=\"text\" NAME=\"valormedio\" SIZE=\"10\"></INPUT> ";
     echo "<P>Valor Grande:";
     echo "<INPUT TYPE=\"text\" NAME=\"valorgrande\" SIZE=\"10\"></INPUT> ";
     echo "<P>Valor Master:";
     echo "<INPUT TYPE=\"text\" NAME=\"valormaster\" SIZE=\"10\"></INPUT> ";
     echo "<P>Valor Big:";
     echo "<INPUT TYPE=\"text\" NAME=\"valorbig\" SIZE=\"10\"></INPUT> ";

?>                              

<INPUT TYPE="submit" VALUE="Cadastrar"></INPUT>
<INPUT TYPE="reset" VALUE="Limpar"></INPUT>
</CENTER>
</FORM>
<?PHP MostraRodape(); ?>
