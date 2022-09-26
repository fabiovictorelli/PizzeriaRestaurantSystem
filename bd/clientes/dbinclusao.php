<?PHP 
   require ( "../lib/victorelli.lib.php");
   MostraCabec("Inclusão de Clientes ");
   MostraMenuClientes();
?>

<?PHP
        $telefone=$_POST['telefone'];
        $nome=$_POST['nome'];
        $endereco=$_POST['endereco'];

//        echo "variaveis= [$telefone] [$nome] [$endereco]";
//        echo "<BR>";

// Verificando se o usuario preencheu os campos obrigatorio
   if (empty($telefone)) { MostraErro( "<BR><BR> O campo Telefone deve ser preenchido!<BR>"); }
   if (empty($nome)) { MostraErro( "<BR><BR> Você deve preencher o NOME!  <BR><BR> <BR><BR>"); }
   if (empty($endereco)) { MostraErro( "<BR><BR> Você deve preencher um ENDERECO !  <BR><BR> <BR><BR>"); }

   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 

// Verificando se o telefone ja esta gravado
   $testafone = pg_Exec($conn, "select * from clientes WHERE telefone = $telefone;");
   $num = pg_NumRows($testafone);
   $i=0;
   for($i = 0; $i < $num; $i++) {
      // trim() tira os espacos em brancos  do comeco ate o fim da base de dados 
      $auxfone= trim(pg_Result( $testafone, $i, "telefone" ));
      $auxnome= trim(pg_Result( $testafone, $i, "nome" ));
      $auxendereco= trim(pg_Result( $testafone, $i, "endereco" ));
      $ret=strcmp ( $auxfone, $telefone );
      if ( $ret == 0 ) {
         //echo "<BR>auxfone=$auxfone telefone=$telefone i=$i num=$num"; 
         pg_Close($conn);
         MostraeSai("<BR>telefone <b>$telefone</b> cadastrado para:
                      <b><BR>$auxnome <BR>Endereco:$auxendereco</b>");
      }
      else {
         echo "<BR>auxfone=$auxfone telefone=$telefone"; 
      }
   }

// Gravando os dados na base de dados
   $cep = 1111;
   //$data_hoje = getdate();    
   //$data_hoje = "2004-01-25";

   $data_hoje = mktime(date('G,i,s,m,d,Y')); //guarda o valor em segundos decorridos desde 01/01/1970 - 0h0min0s até o segundo atual 
   echo "data_hoje = $data_hoje";
   $result = pg_Exec($conn,
                        "INSERT INTO clientes VALUES ('$telefone','$nome','$endereco','$cep','$data_hoje');");
   if (!$result) {
      echo "Ocorreu um erro durante a inclusao na base de dados.\n";
      exit;
   }

   pg_FreeResult($result);
   pg_Close($conn);

// agora pegando o cod_cliente do cliente que acabei de gravar

   $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 
   $testafone = pg_Exec($conn, "select cod_cliente from clientes WHERE telefone = $telefone;");
   $num = pg_NumRows($testafone);
   if ( $num == 0 ) { echo "problemas na recuperacao do cod_cliente do telefone $telefone"; }
   $i=0;
//   Debuga ("num=$num");
   for($i = 0; $i < $num; $i++) {
      $cod_cliente= trim(pg_Result( $testafone, $i, "cod_cliente" ));
   }
   pg_Close($conn);

   echo "<table>";
   echo "<TR><TD>";
   echo"<BR>telefone <b>$telefone</b> cadastrado para: <b><BR>$nome <BR>Endereco:$endereco  cod_cliente=$cod_cliente</b>";
   echo "</TD></TR><TR><TD>";
   echo "<FORM ACTION=\"$HOME/bd/pedidos/dbpedepizza.php\" METHOD=\"POST\">";
   echo "<INPUT TYPE=\"hidden\" NAME=\"cod_cliente\" VALUE=\"$cod_cliente\" ></INPUT>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"telefone\" VALUE=\"$telefone\" ></INPUT>";
   echo "<INPUT TYPE=\"hidden\" NAME=\"nome\" VALUE=\"$nome\" ></INPUT> ";
   echo "<INPUT TYPE=\"hidden\" NAME=\"endereco\" VALUE=\"$endereco\" ></INPUT>";
   echo "<INPUT TYPE=\"submit\" VALUE=\"PedirPizzas\"></INPUT>";
   echo "</FORM>";
   echo "</TD></TR><TR>";
   
   echo "</TD></TR>";
   echo "</table>";

?>
<?PHP MostraRodape(); ?>
