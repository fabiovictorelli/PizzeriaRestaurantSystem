Simple Pizzeria and Restaurant Management and Control System
fabiovictorelli@gmail.com
2008


SOFTWARES NECESSARIOS: 
* Servidor Linux
* HTTPD (Apache)
* PHP3 
* PostgreSQL  



1. Instalacao do Sistema

  Assim que instalar o sistema criar os telefones 1 (balcao) e 2 (mesa),
veja o passo 3.3 abaixo.



1.1 Cadastro de Clientes

   O Cadastro de clientes é simples, com somente alguns dados para serem
cadastrados, pois o cliente estará no telefone e nao podemos perder muito 
tempo, cadastramos entao somente o nome,endereço e telefone.
   O TELEFONE é campo chave, ou seja nao podem haver dois telefones 
iguais.

2. Pedidos

2.1 Inserindo pedidos
   Os pedidos sao inseridos até que o usuário opte pela opção de NÃO 
continuar os pedidos.

   nos campos valor e observação nao podem conter o caracter "|".


3. Administração


3.1 Cadastro de Tipos de Produtos
  
   Precisa incialmente cadastrar os tipos de produtos, respeitando a ordem:
   $PIZZASTRADICIONAIS=1;
   $PIZZASESPECIAIS=2;
   $PIZZASPREMIUM=3;
   $PIZZASSUPREMAS=4;
   $CALZONE=5;
   $CALZONEESPECIAL=6;
   $LASANHAS=7;

3.2 Cadastro de Produtos

  Uma vez cadastrados os Tipos de produtos podemos cadastrar os produtos,
observer que se sua pizzaria nao tem produtos do tamanho médio ou big, basta
deixar em branco o preço destes tamanhos. 


3.3 Cadastro de Clientes

  Atencao, segue duas observacoes importantes quando cadastramento de clientes:

  Cadastrar cliente com numero de telefone=1 para pizza balcao.
  Cadastrar cliente com numero de telefone=2 para pizza mesa.

4 Backup dos dados SQL

  ver em http://www.htmlstaff.org/postgresqlmanual/app-pgdump.html

Para exportar um banco de dados: 
$ pg_dump meu_bd > db.out 

Para importar este banco de dados: 
$ psql -d database -f db.out

Para exportar um banco de dados chamado meu_bd que contém objetos grandes para um arquivo tar: 
$ pg_dump -Ft -b meu_bd > bd.tar

Para importar este banco de dados (com os objetos grandes) para um banco de dados existente 
chamado novo_bd:
$ pg_restore -d novo_bd bd.tar
