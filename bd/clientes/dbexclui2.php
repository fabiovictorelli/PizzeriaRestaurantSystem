<?PHP
   require ( "../lib/victorelli.lib.php");
   MostraCabec("Exclus�o de Clientes ");
   MostraMenuClientes();


   $telefone=$_POST['telefone'];
   $nome=$_POST['nome'];
   $endereco=$_POST['endereco'];

   Debuga("variaaveis= telefone=[$telefone] nome=[$nome] endereco=[$endereco]<BR>");
   
   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("N�o foi poss�vel conectar ao banco de dados"); 
        if (empty($telefone)) { MostraErro("O campo telefone deve ser preenchido!\n"); }

/*** Gravando na base   ***/

   $result = pg_Exec($conn, "delete from clientes where telefone = '$telefone';");

   if (!$result) {
     echo "Ocorreu um erro durante a exclus�o da base de dados.\n";
     exit;
   }
   echo "<CENTER><BR>Cliente $nome com fone=$telefone exclu�do. </CENTER>";
   pg_FreeResult($result);
   pg_Close($conn);
   MostraRodape();
?>
