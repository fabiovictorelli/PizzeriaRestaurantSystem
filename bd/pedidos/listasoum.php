<?PHP 
   require ( "../lib/victorelli.lib.php");

//   Debuga(" _GET= ");
//   print_r($_GET);
//   Debuga("<BR>");

   
   $imprimircabec=$_GET['imprimircabec'];
   $imprimir=$_GET['imprimir'];

   echo "$imprimircabec";
   $imprimir= ereg_replace("\n", "<BR>", $imprimir);
   echo "$imprimir";


// Aqui abro uma janela pequena do browser com os dados do pedido
// Chamo o JavaScript makeget na minha lib que Recebe (formulario,largura,altura,top,left)

    echo "<form name=\"form2\" method=\"post\" action=\"reimprimepedido.php\">";
    echo "<INPUT TYPE=\"hidden\" NAME=\"imprimircabec\" VALUE=\"$imprimircabec\" ></INPUT>";
    echo "<INPUT TYPE=\"hidden\" NAME=\"imprimir\" VALUE=\"$imprimir\" ></INPUT>";
    echo "<p><input type=\"button\" value=\"Reimprimir pedido\" onClick=\"makeget(this.form,200,200,200,300)\"p>";
    echo "</FORM>";




?>

<BR><BR>
<a href="javascript:window.close()">Fechar Janela</a>
