<?PHP 
   require ( "../lib/victorelli.lib.php");
   MostraCabec("TESTE");
?>

<?PHP
   $telefone=$_POST['telefone'];
   $testearray=$_POST['testearray'];
   $nome=$_POST['nome'];

   echo" _POST= ";
   print_r($_POST);
   echo"<BR>";

   echo" _REQUEST= ";
   print_r($_REQUEST);
   echo"<BR>";

//   echo "GLOBALS=";
//   print_r($GLOBALS);
//   echo"<BR>";

   Debuga("telefone=[$telefone] nome=[$nome] testearray=$testearray<BR>");
   Debuga("testearray[0]=$testearray[0] testearray[1]=$testearray[1] testearray[2]=$testearray[2] <BR>");

   echo is_array($testearray) ? 'testearray é um Array' : 'testearray não é um Array';
   echo "<BR>";

   $vetor=array(0,1,2,3,4,5,6,7,8,9,10);
   print_r($vetor);

   print_r($estado);

for ($posicao = 1; $posicao < 5; $posicao++)  {
  echo "  <li>".$estado[$posicao]."</li>\r"; // imprime estado
}


   $yes = array('este', 'é', 'um array');

   echo is_array($yes) ? 'yes é um Array' : 'yes é não é um Array';
   echo "<BR>";

   $no = 'este é uma string';

   echo is_array($no) ? 'no é um Array' : 'no não é um Array';


  MostraRodape(); 
?>

