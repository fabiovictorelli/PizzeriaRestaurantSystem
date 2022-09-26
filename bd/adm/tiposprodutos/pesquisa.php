<?PHP 
   require ( "../../lib/victorelli.lib.php");
   MostraCabec("Pesquisa de Clientes:");
   MostraMenuAdmProdutos();
?>

<FORM ACTION="dbpesquisa.php" METHOD="POST">
<?PHP
     echo "<P>Numero:";
     echo "<INPUT TYPE=\"text\" NAME=\"numero\" SIZE=\"10\"></INPUT>";
?>                              

<INPUT TYPE="submit" VALUE="Pesquisar"></INPUT>
<INPUT TYPE="reset" VALUE="Limpar"></INPUT>
</FORM>
<?PHP MostraRodape(); ?>
