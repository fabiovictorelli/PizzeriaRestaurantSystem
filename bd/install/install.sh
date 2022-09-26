# Revisado em 26/08/2003
# Qui Ago 28 16:13:47 BRT 2003
# fabio@conectiva.com.br
#
# ver inicio da linha ???

echo "Para ser instalado o victorelli precisamos das seguintes  rpms de 
	- apache
	- php4
	- php4-pgsql
	- openssl
	- postgress

"	

echo "1)Troubleshooting -  verificar se o /etc/php.ini linha engine=On" 
echo "2) alterar o /etc/rc.d/init.d/postgresql, colocar -i na linha:
	 su postgres -c '/usr/bin/postmaster -S -i -D/var/lib/pgsql'"

echo "3) criar o usuario www como abaixo:
su - postgres
#createuser www
Enter user's postgres ID or RETURN to use unix user ID: 99 ->
Is user \"www\" allowed to create databases (y/n) n
Is user \"www\" allowed to add users? (y/n) n
createuser: www was successfully added
don't forget to create a database for www"

echo "Sempre que atualizar a maquina , executar o comando:
       initdb --pgdata=/var/lib/pgsql --pglib=/usr/lib/pgsql 

no arquivo /etc/apache/conf/httpd.conf  descomentar a linha
        Include conf/conf.d/*.module


AddModule mod_php3.c
DirectoryIndex index.html index.htm index.cgi index.phtml index.php3
AddType application/x-httpd-php3 .php3 .phtml
"

echo "descomentar a linha  do /etc/php.ini :
extension=pgsql.so "

echo "4) Retirar a senha do usuarios postgres no /etc/passwd ou /etc/shadow,
         para os scripts paraservidor e iniciaservidor " 
echo "chmod 777 /home/httpd/html/victorelli/materias/"
echo "chown -R www.www /home/httpd/html/victorelli"
echo "Copiar o /home/httpd/html/victorelli/cgis/websistema.cgi para o
      /home/httpd/cgi-bin/victorelli/"
echo "Copiar o /home/httpd/html/victorelli/cgis/web-sistema.cgi /home/httpd/cgi-bin/victorelli/"
echo "Copiar o /home/httpd/html/victorelli/cgis/unescape /usr/bin/"

echo "Incrementar o /etc/httpd/conf/access.conf com as seguintes linhas :
	<Directory /home/httpd/html/victorelli/professores/private>
	ForceType application/x-httpd-php3
	php3_auto_prepend_file /home/httpd/html/victorelli/professores/private/.logon.professores.phtml
	</Directory>"

echo "Alterar no /etc/httpd/conf/srm.conf a linha :
	  DirectoryIndex index.html index.htm index.shtml index.cgi index.phtml index.php3"  

echo "Alterar no /etc/httpd/conf/access.conf 
	no <Directory /home/httpd/html>
	colocar a Options ExecCGI "
echo "adicionar .phtml na linha:
	AddType application/x-httpd-php3 .php3 .phtml 
	"
echo "Alterar: 
access.conf:
<Directory /home/mailman>
AllowOverride None
Options ExecCGI Indexes FollowSymLinks
</Directory>        

srm.conf:ScriptAlias   /mailman/       /home/mailman/cgi-bin/
srm.conf:Alias /pipermail/ /home/mailman/archives/public/   
	"

echo "Internacionalização (i18n) :
	Exemplo de tradução para pt_BR           #\$LANG=pt_BR  
	1) criar um diretorio do locale da linguagem que se queira traduzir em baixo de:
          bindtextdomain(\$gettext_domain, \"/home/fabio/site/bd/locale\");
       cd /home/fabio/site/bd/locale
       mkdir pt_BR
       mkdir pt_BR/LC_MESSAGES
	2) Ir para este diretório :
           cd pt_BR/LC_MESSAGES
	3) Copiar o esqueleto do português.
	   cp (ARQUIVO victorelli.po original) .

	4) Traduzir as mensagens nas linhas msgstr, aqui vai ser trabalhoso.

	   editar o (locale/pt_BR/LC_MESSAGES/victorelli.po e traduzir todas as mensagens para a lingua pt_BR
	   exemplo do victorelli.po:

	     ...
	     msgid \"msgid \"WebMaster Page\"
	     msgstr \"Página do Webmaster\"  
	     ...

     5) Gerar o arquivo victorelli.mo
        executar:  msgfmt -o victorelli.mo victorelli.po    
	 6) Copiar o arquivo victorelli.mo gerado para o diretório:
	    cp  victorelli.mo /usr/share/locale/\$LANG/LC_MESSAGES/victorelli.mo  

	 7) Testar, abrindo uma página
	 
	 no projeto victorelli ver webmaster/index.phtml e lib/victorelli.lib.phtml a funcao _();"
