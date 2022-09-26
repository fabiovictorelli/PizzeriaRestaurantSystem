<?PHP 
   require ( "../lib/victorelli.lib.php");

//   Debuga(" _GET= ");
//   print_r($_GET);
//   Debuga("<BR>");

   $imprimircabec=$_GET['imprimircabec'];
   $imprimir=$_GET['imprimir'];

//   Debuga("<BR>imprimircabec=$imprimircabec <BR>imprimir=$imprimir";
   
   $bufferimpressao = "<BR>Reimpressão de Pedido<BR>";
   $bufferimpressao = $bufferimpressao .$imprimircabec .$imprimir;  // Buffer de impressao
   $bufferimpressao = ereg_replace("<BR>", "\n", $bufferimpressao);
   $bufferimpressao = $bufferimpressao ."\n\n\n\n\n\n\n\n\n\n\n\n";

// Gravando arquivo temporario para impressao
   $Arqtemp="/tmp/temp-reimpressao";
   $id = fopen($Arqtemp, "w") or die ("Falha abrindo arquivo: $Arqtemp");
   fwrite($id,$bufferimpressao,4096)or die ("Falha escrevendo arquivo: $Arqtemp");
   fclose($id);

//   $auxdebug= ereg_replace("\n", "<BR>", $bufferimpressao);
//     Debuga ("<BR>auxdebug=$auxdebug");


// Imprimindo arquivo temporario
   $pid=exec("/usr/bin/lp $Arqtemp > /dev/null & echo \$!");

//   echo "reimprimi pedido - descomentar linha acima, pois senao gasto muito papel hehehe";

   echo "<BR>Pedido reimpresso!<BR>";

?>
<BR><BR>
<a href="javascript:window.close()">Fechar Janela</a>
