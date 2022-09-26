<?PHP 
   require ( "../../lib/victorelli.lib.php");
   MostraCabec("Inclusão de Tipos Produtos ");
   MostraMenuAdmTiposProdutos();
?>

<?PHP
        $nome=$_POST['nome'];
        $valorbroto=$_POST['valorbroto'];
        $valormedio=$_POST['valormedio'];
        $valorgrande=$_POST['valorgrande'];
        $valormaster=$_POST['valormaster'];
        $valorbig=$_POST['valorbig'];

Debuga("variaveis= nome=[$nome] valorbroto=[$valorbroto] vvalormedio=[$valormedio] valorgrande=[$valorgrande] valormaster=[$valormaster] valorbig=[$valorbig] <BR>");


// Verificando se o usuario preencheu os campos obrigatorio
   if (empty($nome)) {
      MostraErro( "<BR><BR> Você deve preencher o NOME!  <BR><BR> <BR><BR>");
   }

   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 

// Gravando os dados na base de dados
   $result = pg_Exec($conn,
                        "INSERT INTO tiposprodutos VALUES ('$nome','$valorbroto','$valormedio','$valorgrande','$valormaster','$valorbig');");
   if (!$result) {
      echo "Ocorreu um erro durante a inclusao na base de dados tiposprodutos.\n";
      exit;
   }

   echo "<CENTER>";
   echo "<BR><BR>Tipo de Produto incluído";
   echo "</CENTER>";
   pg_FreeResult($result);
   pg_Close($conn);
?>
<?PHP MostraRodape(); ?>
