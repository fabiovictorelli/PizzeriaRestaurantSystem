<?PHP
   require ( "../../lib/victorelli.lib.php");
   MostraCabec("Alteracao de Produtos ");
   MostraMenuAdmProdutos();


	$numero=$_POST['numero'];
	$nome=$_POST['nome'];
	$cod_tiposprodutos=$_POST['cod_tiposprodutos'];
	$descricao=$_POST['descricao'];

	Debuga("variaaveis= numero=[$numero] nome=[$nome] cod_tiposprodutos=[$cod_tiposprodutos]<BR>");
	     
        $conn = pg_Connect("localhost", "5432", "", "", "victorelli") or die("Não foi possível conectar ao banco de dados"); 
        if (empty($nome)) {
		MostraErro("O campo nome é obrigatorio !\n");
	}
        if (empty($cod_tiposprodutos)) {
		MostraErro("O campo tipo deve ser preenchido!\n");
	}
        if (empty($numero)) {
		MostraErro("O campo numero deve ser preenchido!\n");
	}

/*** Gravando na base   ***/

//		datainicioproj = '$datainicioproj', 

	$result = pg_Exec($conn, "update produtos set nome = '$nome', descricao = '$descricao',
		cod_tiposprodutos = '$cod_tiposprodutos' where numero = '$numero';");

	if (!$result) {
		echo "Ocorreu um erro durante a alteraçao da base de dados.\n";
		exit;
	}
	echo "<CENTER><BR>Produto $nome com numero=$numero alterado. </CENTER>";
	pg_FreeResult($result);
	pg_Close($conn);
	MostraRodape();
?>
