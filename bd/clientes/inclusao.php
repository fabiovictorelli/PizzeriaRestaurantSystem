<?PHP 
   require ( "../lib/victorelli.lib.php");
   MostraCabec("Inclus�o de Clientes ");
   MostraMenuClientes();
?>

<FORM ACTION="dbinclusao.php" METHOD="POST">
<?PHP
     echo "<P>Telefone:";
     echo "<INPUT TYPE=\"text\" NAME=\"telefone\" SIZE=\"10\"></INPUT>";
     echo "Nome:";
     echo "<INPUT TYPE=\"text\" NAME=\"nome\" SIZE=\"70\"></INPUT> <BR>";
     echo "<P>Endere�o:";
     echo "<INPUT TYPE=\"text\" NAME=\"endereco\" SIZE=\"87\"></INPUT> <BR><BR>";

?>                              

<INPUT TYPE="submit" VALUE="Cadastrar"></INPUT>
<INPUT TYPE="reset" VALUE="Limpar"></INPUT>
</CENTER>
</FORM>
<?PHP MostraRodape(); ?>
