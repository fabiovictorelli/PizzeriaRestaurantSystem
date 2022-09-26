<?PHP
   require ( "../lib/victorelli.lib.php");
   MostraCabec("Listagem de Clientes:");
   MostraMenuClientes();
?>

<head>
<html>

<H5>Listar clientes por ordem de: </H5>
<A HREF=listaclientes-telefone.php>telefone</A> <BR>
<A HREF=listaclientes-data.php>data do cadastro - TODOS</A> <BR>
<A HREF=listaclientes-data1.php>data do cadastro - Ultimos 30 dias</A> <BR>
<A HREF=listaclientes-data2.php>data do cadastro - Ultimos 30 dias- Ordem endereco</A> <BR>
<A HREF=listaclientes-nometodos.php>nome - Listar todos os clientes por ordem Alfabética</A> <BR>
<A HREF=listaclientes-nomeletra.php>nome - Listar clientes por letra inicial do nome</A> <BR>

<?PHP MostraRodape(); ?>
