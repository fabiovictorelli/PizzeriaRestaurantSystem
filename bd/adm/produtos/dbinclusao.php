<?PHP 
   require ( "../../lib/victorelli.lib.php");
   MostraCabec("Inclusão de Produtos ");
   MostraMenuAdmProdutos();
?>

<?PHP
   $numero=$_POST['numero'];
   $nome=$_POST['nome'];
   $descricao=$_POST['descricao'];
   $cod_tiposprodutos=$_POST['cod_tiposprodutos'];

Debuga("variaveis= numero=[$numero] nome=[$nome] descricao=[$descricao] cod_tiposprodutos=[$cod_tiposprodutos] <BR>");

// Verificando se o usuario preencheu os campos obrigatorio
   if (empty($numero)) { MostraErro( "<BR><BR> O campo Numero deve ser preenchido!<BR>"); }
   if (empty($nome)) { MostraErro( "<BR><BR> Você deve preencher o NOME!  <BR><BR> <BR><BR>"); }
   if (empty($descricao)) { MostraErro( "<BR><BR> Você deve preencher uma Descricao !  <BR><BR> <BR><BR>"); }
   if (empty($cod_tiposprodutos)) { MostraErro( "<BR><BR> Você deve preencher um tipo !  <BR><BR> <BR><BR>"); }

   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 

// Verificando se o numero ja esta gravado
   $testaproduto = pg_Exec($conn, "select * from produtos WHERE numero = $numero;");
   $num = pg_NumRows($testaproduto);
   $i=0;
   for($i = 0; $i < $num; $i++) {
      // trim() tira os espacos em brancos  do comeco ate o fim da base de dados 
      $auxnumero= trim(pg_Result( $testaproduto, $i, "numero" ));
      $auxnome= trim(pg_Result( $testaproduto, $i, "nome" ));
      $auxdescricao= trim(pg_Result( $testaproduto, $i, "descricao" ));
      $ret=strcmp ( $auxnumero, $numero );
      if ( $ret == 0 ) {
         //echo "<BR>auxnumero=$auxnumero numero=$numero i=$i num=$num"; 
         pg_Close($conn);
         MostraeSai("<BR>numero <b>$numero</b> cadastrado com nome:
                      <b><BR>$auxnome <BR>Descricao:$auxdescricao</b>");
      }
      else {
         echo "<BR>auxnumero=$auxnumero numero=$numero"; 
      }
   }

// Gravando os dados na base de dados
   $result = pg_Exec($conn,
                        "INSERT INTO produtos VALUES ('$numero','$nome','$descricao','$cod_tiposprodutos');");
   if (!$result) {
      echo "Ocorreu um erro durante a inclusao na base de dados.\n";
      exit;
   }

   echo "<CENTER>";
   echo "<BR><BR>Produto incluído";
   echo "</CENTER>";
   pg_FreeResult($result);
   pg_Close($conn);
?>
<?PHP MostraRodape(); ?>
