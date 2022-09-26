#!/bin/bash
echo Content-type: text/html
echo

meu_mail="fabiodvic@yahoo.com.br"
TEMPFILE=/tmp/temp.$$


  echo
  echo "<html> <head> <title>Victorelli Restaurante e Pizzaria </title> </head>"
  echo "<body>"

  echo "<center>"
  echo "<img src=\"../images/logo.jpg\">"
  echo "</center>"


  VAR=$(sed -n '1p')
#  echo "$VAR"
  nome=$(echo $VAR | sed 's/\(nome=\)\(.*\)\(\&endereco=.*\)/\2/;s/+/ /g')
  nome=`echo $nome | ./unescape`
  ende=$(echo $VAR | sed 's/\(.*&endereco=\)\(.*\)\(\&cidade=.*\)/\2/;s/+/ /g')
  ende=`echo $ende | ./unescape`
  cida=$(echo $VAR | sed 's/\(.*&cidade=\)\(.*\)\(\&fone=.*\)/\2/;s/+/ /g')
  cida=`echo $cida | ./unescape`
  fone=$(echo $VAR | sed 's/\(.*&fone=\)\(.*\)\(\&email=.*\)/\2/;s/+/ /g')
  fone=`echo $fone | ./unescape`
  mail=$(echo $VAR | sed 's/\(.*&email=\)\(.*\)\(\&comentario=.*\)/\2/;s/%40/@/')
  mail=`echo $mail | ./unescape`
  come=$(echo $VAR | sed 's/\(.*&comentario=\)\(.*\)\(\&querresposta=.*\)/\2/;s/%0D%0A/ /g;s/+/ /g;s/%2C/ /g;s/%3F//g;s/%E9/é/g;s/%E1/á/g;s/%E3/ã/g')
  come=`echo $come | ./unescape`
  resp=$(echo $VAR | sed 's/.*\&querresposta=//')
  
#  echo "<br>
#  <br><b>Nome      :</b> $nome
#  <br><b>Endereco  :</b> $ende
#  <br><b>Cidade    :</b> $cida
#  <br><b>Fone      :</b> $fone
#  <br><b>E-mail    :</b> $mail
#  <br><b>Comentario:</b> $come
#  <br><b>Responder :</b> $resp
#  <br>"
  
aux="
  Nome      : $nome 
  Endereco  : $ende
  Cidade    : $cida
  Fone      : $fone
  E-mail    : $mail
  Comentario: $come
  Responder : $resp"

  echo "$aux" > $TEMPFILE

  mail -s "victorellis.com - Comentarios" "$meu_mail" < $TEMPFILE

  rm -rf $TEMPFILE

#  mail -s "Mail from CGI -Comentarios" "$meu_mail" < $(echo -e "
#  Nome      : $nome 
#  Endereco  : $ende
#  Cidade    : $cida
#  Fone      : $fone
#  E-mail    : $mail
#  Comentario: $come
#  Responder : $resp") 

  echo "<br>
  <br><b> Obrigado $nome por enviar seu comentário</b>
  <br><b> Sua mensagem foi recebida com sucesso.</b>
  <br>"

   if [ "$resp" = "Sim" ]; then
	echo "<br><b>Entraremos em contato brevemente.</b><br>"
   fi
  
  echo "</body>"
  echo "</html>"

