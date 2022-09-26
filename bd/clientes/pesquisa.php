<?PHP 
   require ( "../lib/victorelli.lib.php");
   MostraCabec("Pesquisa de Clientes:");
   MostraMenuClientes();

   echo "<FORM ACTION=\"dbpesquisa.php\" METHOD=\"POST\">";
   echo "<P>Telefone:";
   echo "<INPUT TYPE=\"text\" NAME=\"telefone\" SIZE=\"10\"></INPUT>";
   echo "<INPUT TYPE=\"submit\" VALUE=\"Pesquisar\"></INPUT>";
   echo "<INPUT TYPE=\"reset\" VALUE=\"Limpar\"></INPUT>";
   echo "</FORM>";

   MostraRodape(); 

?>
