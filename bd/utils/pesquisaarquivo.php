
<?php
   function pesquisa_campos($string_to_find_array,$separador,$filename){
             //$string_to_find_array -array contendo as palavras que deseja procurar -
             //$separador - caracter delimitador entre o nome do campo e o valor ex traco dois pontos,etc
             //filename - nome do arquivo , deve estar em formado ascii e nao binário. 

     $file_array = file($filename);

     if (is_array($string_to_find_array)){
          if(!$file_array){
                $resultado = false;
                return $resultado;
          } else {

                foreach ($file_array as $linha_array){ //percorre as linhas do array file_array que representa cada linha do arquivo, uma a uma
                    for ($contador = 0; $contador < count($string_to_find_array); $contador++){// usado para percorrer os itens do array com os termos a serem procurados
                           if(strstr($linha_array,$string_to_find_array[$contador])){//se encontra a palavra procurada no momento então seleciona a linha inteira.
                              $campos = array();
                              $campos = explode($separador,$linha_array); //o separador é retirado do array e seu item do lado esquerdo é colocado em $campos[0] enquanto o valor fica em $campos{1]
                              print("$campos[0] - $campos[1]");

                           } //fim do if strstr
                    } // fim do for $contador
                }  // fim do foreach
             print('fim');
             return $resultado;
          } //fim do if $file_array
     }// fim do if is_array
   }// fim da funcao


$filen = "bd.config";  // nome do arquivo a ser visualizado

$matriz_nomes = array('nome','telefone');
pesquisa_campos($matriz_nomes,'=',$filen);

?> 
