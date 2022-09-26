<?
/*////////////////////////////////////////////////////////////////////////////////////////////////
/Script Desenvolvido por: 																		 /
/Olavo Alexandrino 																				 /
/vc.falacomigo@bol.com.br 																		 /
/Recife, PE - Outubro de 2002																	 /
*////////////////////////////////////////////////////////////////////////////////////////////////
?>

<html>
<head>
	<title>Pesquisa Binária</title>
</head>

<body>
<?
function par($param)
{
	if (bcmod($param,2)==0) 
		return true;
}

$vetor=array(0,1,2,3,4,5,6,7,8,9,10);

$chave=0;
$inicio=1;
$fim=10;
print_r($vetor);
echo "<br><br>Chave: $chave<br><br>";

function pesquisa_binaria($chave,$inicio,$fim)
{
global $vetor;

	echo "Inicio: $inicio<br>Fim: $fim<br>";
	if($inicio>$fim)
	{
		echo "Chave não encontrada";			
		exit;
	}	
	if (par($inicio+$fim))
		$meio=($inicio+$fim)/2;			
	else
		$meio=($inicio+$fim+1)/2;			
	
	echo "Meio: $meio<br><br>";
	
	if($chave==$vetor[$meio])
	{
		echo "Chave encontrada";	
		exit;
	}

	if($chave<$vetor[$meio])
		pesquisa_binaria($chave,$inicio,$meio-1);
	else
		pesquisa_binaria($chave,$meio+1,$fim);		
}


pesquisa_binaria($chave,$inicio,$fim);

?>


</body>
</html>
