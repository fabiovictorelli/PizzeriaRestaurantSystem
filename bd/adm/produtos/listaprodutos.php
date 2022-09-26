<?PHP
   require ( "../../lib/victorelli.lib.php");
   MostraCabec("Listagem de Produtos:");
   MostraMenuAdmProdutos();
?>

<head>
<html>

<H5>Listar Produtos por ordem de: </H5>
<A HREF=listaprodutos-nome.php>nome</A> <BR>
<A HREF=listaprodutos-numero.php>numero</A> <BR>
<A HREF=listaprodutos-tipo.php>tipo do produto</A> <BR>

<?PHP MostraRodape(); ?>
