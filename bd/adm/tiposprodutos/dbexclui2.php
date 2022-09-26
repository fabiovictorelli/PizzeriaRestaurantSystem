<?PHP
   require ( "../../lib/victorelli.lib.php");
   MostraCabec("Exclusão Tipos de Produtos");
   MostraMenuAdmTiposProdutos();

   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 

   $cod_tiposprodutos=$_POST['cod_tiposprodutos'];
   $nome=$_POST['nome'];
   Debuga("cod_tiposprodutos=[$cod_tiposprodutos] nome=[$nome]<BR>");

// Excluindo da base
   $result = pg_Exec($conn, "delete from tiposprodutos where cod_tiposprodutos = $cod_tiposprodutos;");
   if (!$result) {
      echo "Ocorreu um erro durante a exclusão da base de dados.\n";
      exit;
   }
   echo "<CENTER><BR>Tipos de produtos $nome excluído. </CENTER>";
   pg_FreeResult($result);
   pg_Close($conn);
   MostraRodape();
?>
