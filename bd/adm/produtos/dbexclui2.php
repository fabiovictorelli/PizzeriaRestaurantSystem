<?PHP
   require ( "../../lib/victorelli.lib.php");
   MostraCabec("Exclus�o de Produtos ");
   MostraMenuAdmProdutos();

   $numero=$_POST['numero'];
   $nome=$_POST['nome'];
   $tipo=$_POST['tipo'];

   Debuga("variaaveis= numero=[$numero] nome=[$nome] tipo=[$tipo]<BR>");
   
   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("N�o foi poss�vel conectar ao banco de dados"); 
   if (empty($numero)) { MostraErro("O campo numero deve ser preenchido!\n"); }

/*** Gravando na base   ***/
   $result = pg_Exec($conn, "delete from produtos where numero = '$numero';");
   if (!$result) {
     echo "Ocorreu um erro durante a exclus�o da base de dados.\n";
     exit;
   }
   echo "<CENTER><BR>Produtos $nome com numero=$numero exclu�do. </CENTER>";
   pg_FreeResult($result);
   pg_Close($conn);
   MostraRodape();
?>
