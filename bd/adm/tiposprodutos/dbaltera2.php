<?PHP
   require ( "../../lib/victorelli.lib.php");
   MostraCabec("Altera��o Tipos de Produtos");
   MostraMenuAdmTiposProdutos();

   $cod_tiposprodutos=$_POST['cod_tiposprodutos'];
   $nome=$_POST['nome'];
   $valorbroto=$_POST['valorbroto'];
   $valormedio=$_POST['valormedio'];
   $valorgrande=$_POST['valorgrande'];
   $valormaster=$_POST['valormaster'];
   $valorbig=$_POST['valorbig'];

   Debuga("cod_tiposprodutos=[$cod_tiposprodutos] nome=$nome valorbroto=[$valorbroto]<BR>");
   
   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("N�o foi poss�vel conectar ao banco de dados"); 

/*** Gravando na base   ***/

   $result = pg_Exec($conn, "update tiposprodutos set nome = '$nome', 
         valorbroto = '$valorbroto', valormedio = '$valormedio', 
         valorgrande = '$valorgrande', valormaster = '$valormaster', valorbig = '$valorbig'
         where cod_tiposprodutos = '$cod_tiposprodutos';");

   if (!$result) {
     echo "Ocorreu um erro durante a altera�ao da base de dados.\n";
     exit;
   }
   echo "<CENTER><BR>Tipo de Produto $nome alterado. </CENTER>";
   pg_FreeResult($result);
   pg_Close($conn);
   MostraRodape();
?>
