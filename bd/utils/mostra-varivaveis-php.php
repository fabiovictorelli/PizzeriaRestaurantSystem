<?PHP 
   require ( "../lib/victorelli.lib.php");
   MostraCabec("teste");
?>

<FORM ACTION="dbmostrateste.php" METHOD="POST">
<?PHP
     
   $testearray= array('pr', 'sc', 'rs');

   $numelementosarray= count($testearray);
   
   echo "mostrando o array testearray com $numelementosarray elementos.<br>";
   for ($posicao = 0; $posicao < $numelementosarray; $posicao++)  {
     echo "  <li>".$testearray[$posicao]."</li>\r"; // imprime testearray
   }


   echo "<P>Telefone:";
   for ($posicao = 0; $posicao < $numelementosarray; $posicao++)  {
     $aux=$testearray[$posicao]; 
     echo "<INPUT TYPE=\"hidden\" NAME=\"testearray[]\" VALUE=\"$aux\" ></INPUT>";
   }
   echo "<INPUT TYPE=\"hidden\" NAME=\"nome\" VALUE=\"fabio\"></INPUT>";
   echo "<INPUT TYPE=\"text\" NAME=\"telefone\" SIZE=\"10\"></INPUT>";
?>                              

<INPUT TYPE="submit" VALUE="Testar"></INPUT>
<INPUT TYPE="reset" VALUE="Limpar"></INPUT>
</FORM>
<?PHP MostraRodape(); ?>
