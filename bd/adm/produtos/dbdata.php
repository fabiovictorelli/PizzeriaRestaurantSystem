<?PHP 
   require ( "../../lib/victorelli.lib.php");
   MostraCabec("Testando Datas ");
   MostraMenuAdmProdutos();
?>

<?PHP
   $datai=$_POST['datai'];
   $dataf=$_POST['dataf'];
   $diffdata=$dataf-$datai;

//Numero de Segundos de:
   $UmMinuto=60;
   $UmaHora=60*$UmMinuto;
   $UmDia=24*$UmaHora;
   $UmMes=30*$UmDia;
   $UmAno=12*$UmMes;
   echo "<BR>variaveis= datai=[$datai] dataf=[$dataf] ";
   echo "<BR>variaveis= UmaHora=$UmaHora UmDia=$UmDia UmMes=$UmMes UmAno=$UmAno";

// Verificando se o usuario preencheu os campos obrigatorio
   if (ValidaData($datai) == $ERRO) {
      MostraErro( "<BR><BR> O campo data inicial esta errado !<BR>");
   }
   if (ValidaData($dataf)) {
      MostraErro( "<BR><BR> O campo data final esta errado !<BR>");
   }


//int mktime ( [int hora [, int minuto [, int second [, int mes [, int dia [, int ano [, int is_dst]]]]]]])

   $data_hoje = mktime(date('G,i,s,m,d,Y')); //guarda o valor em segundos decorridos desde 01/01/1970 - 0h0min0s até o segundo atual 
   $data_formatada = date('d/m/Y',$data_db); // a função date() retornará dd/mm/yyyy do tempo em segundos que passou como segundo parâmetro 

   echo "data_hoje = $data_hoje <BR>";
   echo "diffdata = $diffdata <BR>";

?>
<?PHP MostraRodape(); ?>
