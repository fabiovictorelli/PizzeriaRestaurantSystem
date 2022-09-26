<?PHP 
   require ( "../lib/victorelli.lib.php");
   MostraCabec("Testando Datas");
   MostraMenuClientes();
?>

<FORM ACTION="dbdata.php" METHOD="POST">

<?PHP
   $data_db = mktime(date('G,i,s,m,d,Y')); //guarda o valor em segundos decorridos desde 01/01/1970 - 0h0min0s até o segundo atual 
   $data_formatada = date('d/m/Y',$data_db); // a função date() retornará dd/mm/yyyy do tempo em segundos que passou como segundo parâmetro 
   echo "data_db = $data_db <BR>";
   echo "data_formatada = $data_formatada";
   echo "<P>Data inicial:";
   echo "<INPUT TYPE=\"text\" NAME=\"datai\" SIZE=\"10\"></INPUT>dd/mm/yyyy";
   echo "<BR>Data Final:";
   echo "<INPUT TYPE=\"text\" NAME=\"dataf\" VALUE=$data_formatada SIZE=\"10\"></INPUT>dd/mm/yyyy <BR>";
?>                              

<INPUT TYPE="submit" VALUE="Calcular"></INPUT>
<INPUT TYPE="reset" VALUE="Limpar"></INPUT>
</CENTER>
</FORM>
<?PHP MostraRodape(); ?>
