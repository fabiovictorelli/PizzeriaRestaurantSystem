
<?php
   function pesquisa_arq_conf($string_para_pesquisar){

      $charcomentario='#';
      $separador='=';
      $arqconf = "bd.config";  // nome do arquivo a ser visualizado
      $handle = fopen ($arqconf, "r") or die("falha ao abrir $arqconf");

      while (!feof ($handle)) {
         $buffer = fgets($handle, 4096);
         $linha=´´;
// tirando os comentarios da linha
         $pos = strpos($buffer, $charcomentario);             // ver se tem comentario na linha
         if ($pos === false) {
            $linha = $buffer;                                   // nao achei comentario
         }else {                                 
            $linha = substr($buffer, 0, $pos);                  // tirando o comentario da linha
         }
         //echo "<BR>$linha";

// retornando o conteudo da variavel se eu achar
         $array=explode ( "$separador" , $linha );
         $aux = trim($array[0]);                                 // tirando espassom em branco
         if ( $aux == $string_para_pesquisar ) {
            fclose ($handle);
            return ( trim($array[1]) ); 
         }
      }
      fclose ($handle);
      return("erro");

}// fim da funcao



$nome=pesquisa_arq_conf('nome');
echo "<BR>nome=[$nome]";

$telefone=pesquisa_arq_conf('telefone');
echo "<BR>telefone=[$telefone]";

$mesas=pesquisa_arq_conf('numerodemesas');
echo "<BR>numerodemesas=[$mesas]";

$url=pesquisa_arq_conf('url');
echo "<BR>url=[$url]";

?> 
