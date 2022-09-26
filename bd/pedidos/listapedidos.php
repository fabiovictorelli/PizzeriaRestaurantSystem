<?PHP
   require ( "../lib/victorelli.lib.php");
   MostraCabec("Listagem de Pedidos:");
   MostraMenuPedidos();
?>

<head>
<html>

<?PHP

echo "<BR><BR>";
echo "<FORM ACTION=\"listapedidos2.php\" METHOD=\"POST\">";
echo "<font size=\"+1\">Listar </font>";
   echo "<select name=\"localaux\">";
   echo "  <option select value=todos> todos";
   echo "  <option value=balcao> só balcao ";
   echo "  <option value=mesa> só mesa ";
   echo "  <option value=entrega> só entrega ";
   echo "</select> ";
echo "<font size=\"+1\">os pedidos das</font>";
   echo "<select name=\"listagem\">";
   echo "  <option select value=Ultimas12Horas> Ultimas 12 horas";
   echo "  <option value=Ultimas24Horas> Ultimas 24 horas";
   echo "  <option value=Ultimos3Dias> Ultimos 3 dias";
   echo "  <option value=Ultimos7Dias> Ultimos 7 dias";
   echo "  <option value=Ultimos30Dias> Ultimos 30 dias";
   echo "  <option value=Ultimos60Dias> Ultimos 60 dias";
   echo "  <option value=Ultimos90Dias> Ultimos 90 dias";
   echo "  <option value=UmAno> Ultimo Ano";
   echo "  <option value=Acima60dias> Acima de 60 dias";
   echo "</select> ";
echo "<INPUT TYPE=\"submit\" VALUE=\"Listar \"></INPUT>";
echo "</FORM>";


?>
<A HREF=listapedidos-cliente.php>Listar Pedidos de um cliente</A> <BR>

<?PHP MostraRodape(); ?>
