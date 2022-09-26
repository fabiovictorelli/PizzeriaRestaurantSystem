<?php
/*
  Autor : Junior Della Mea (jrd) [jrwm@ieg.com.br]
  Data  : 29/12/2002
  T�tulo: Iterando atrav�s de um array
*/

// Obs: N�o h� limite para array deste tipo
// Criamos um array(), cuja seus elementos s�o estados brasileiros
$estado = array("Acre","Alagoas","Amap�","Amazonas","Bahia","Cear�","Distrito Federal","Esp�rito Santo","Goi�s","Maranh�o","Mato Grosso","Mato Grosso do Sul","Minas Gerais","Paran�","Para�ba","Par�","Pernambuco","Piau�","Rio Grande do Norte","Rio Grande do Sul","Rio de aneiro","Rond�nia","Roraima","Santa Catarina","Sergipe","S�o Paulo", "Tocantins");

/*
Uma vez que voc� tenha um array() criado com v�rios elementos, fica dif�cil voltar e recuperar individualmente cada �tem dele. Para resolver este problema, temos os loops. (for, while, do).
Se for de nosso interesse, podemos exibir o nome de cada um desses estados em uma p�gina Web.
*/
echo "<b>Imprimindo lista de estados utilizando FOR</b>\r";
echo "<hr>\r";
echo "<ul>\r";

// para #posicao que � igual a 1; $posicao � menor que 27; incremente $posicao
for ($posicao = 1; $posicao < 27; $posicao++)  // 27 = n�mero de estados 
{

  echo "  <li>".$estado[$posicao]."</li>\r"; // imprime estado
}
echo "</ul>\r";
echo "<br><br>\r";
echo "<b>listando estados em um select utilizando WHILE</b>\r";
echo "<hr>\r";

echo "<select>\r"; // abre select (html)
$posicao2 = 1; // inializa posi��o para entrar no while
while ($posicao2 < 27) // enquanto a $posicao2 for menor que 27 ...
{
  echo "  <option value=\"$estado[$posicao2]\">$estado[$posicao2]</option>\r"; // imprime os estados dentro do <option>
  $posicao2 += 1; // = $posicao2 + $posi��o2 + 1 (incremento)
}
echo "</select>"; // fecha select (html)

/*
Espero que este simples script seja �til em sua vida profissional, por�m, se n�o for, ja fico 
gratificado pela sua leitura. Obrigado.
*/



?>