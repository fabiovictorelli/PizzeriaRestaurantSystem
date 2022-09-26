<?php
/*
  Autor : Junior Della Mea (jrd) [jrwm@ieg.com.br]
  Data  : 29/12/2002
  Título: Iterando através de um array
*/

// Obs: Não há limite para array deste tipo
// Criamos um array(), cuja seus elementos são estados brasileiros
$estado = array("Acre","Alagoas","Amapá","Amazonas","Bahia","Ceará","Distrito Federal","Espírito Santo","Goiás","Maranhão","Mato Grosso","Mato Grosso do Sul","Minas Gerais","Paraná","Paraíba","Pará","Pernambuco","Piauí","Rio Grande do Norte","Rio Grande do Sul","Rio de aneiro","Rondônia","Roraima","Santa Catarina","Sergipe","São Paulo", "Tocantins");

/*
Uma vez que você tenha um array() criado com vários elementos, fica difícil voltar e recuperar individualmente cada ítem dele. Para resolver este problema, temos os loops. (for, while, do).
Se for de nosso interesse, podemos exibir o nome de cada um desses estados em uma página Web.
*/
echo "<b>Imprimindo lista de estados utilizando FOR</b>\r";
echo "<hr>\r";
echo "<ul>\r";

// para #posicao que é igual a 1; $posicao é menor que 27; incremente $posicao
for ($posicao = 1; $posicao < 27; $posicao++)  // 27 = número de estados 
{

  echo "  <li>".$estado[$posicao]."</li>\r"; // imprime estado
}
echo "</ul>\r";
echo "<br><br>\r";
echo "<b>listando estados em um select utilizando WHILE</b>\r";
echo "<hr>\r";

echo "<select>\r"; // abre select (html)
$posicao2 = 1; // inializa posição para entrar no while
while ($posicao2 < 27) // enquanto a $posicao2 for menor que 27 ...
{
  echo "  <option value=\"$estado[$posicao2]\">$estado[$posicao2]</option>\r"; // imprime os estados dentro do <option>
  $posicao2 += 1; // = $posicao2 + $posição2 + 1 (incremento)
}
echo "</select>"; // fecha select (html)

/*
Espero que este simples script seja útil em sua vida profissional, porém, se não for, ja fico 
gratificado pela sua leitura. Obrigado.
*/



?>