
<script language="JavaScript">
<!--
function makeget (frm,jw,jh,jt,jl) { // Recebe (formulario,largura,altura,top,left)
var query = '?';
    for(i = 0; i < frm.elements.length; i++) {
        if(frm.elements[i].name != '') {
        var val = escape(frm.elements[i].value);
        var ctrl = false;
            if(frm.elements[i].type == 'radio' ||
                frm.elements[i].type == 'checkbox') {
                if(frm.elements[i].checked == true) {
                query += frm.elements[i].name +"="+ val;
                ctrl = true;
                }
            } else {
            query += frm.elements[i].name +"="+ val;
            ctrl = true;
            }
        if(i < frm.elements.length - 1 && ctrl) query += "&";    
        }
    }
window.open(frm.action+query,'_blank','resizable=yes,scrollbars=yes,top='+jt+',left='+jl+',height='+jh+',width='+jw);
}
-->
</script></head>


<?

$SITE_LOCAL="localhost";
$DIR_HOME="/home/httpd/html/ed";
$ERRO=-1;   // Ver em ValidaData()
$DEBUGA=1;   // para Debugar o codigo 1=LIGADO 0=DESLIGADO *** usar global $DEBUGA dentro da funcao!!!
$HOME="http://localhost/victorelli/";      // URL HOME




// a funcao _( foi implementada no PHP4, é um alias para a função gettext, entao:
$language = "pt_BR";
$locale = setlocale(LC_ALL, $language );
$gettext_domain = 'victorelli';
// Specify location of translation tables
bindtextdomain($gettext_domain, "/home/fabio/site/bd/locale");
// Choose domain
textdomain($gettext_domain);

//   function _($texto) {
//   $fp = popen( "gettext ed \"$texto\"", "r" );
//      $var = fgets($fp,4096);
//      pclose ($fp);
//      return ($var);
//   }

   function MostraHora() {
      //$data_atual = date("d/m/Y"); 
      //print strftime("%d/%m/%Y - %H:%M:%S"); 
      print strftime("%d/%m - %H:%M"); 
   } // Fim de Funcao MostraHora

   function MostraCabec($cabecalho) {

      global $HOME;

      echo "<HTML>";
      echo "<HEAD>";
      $titulosistema=ProcuraConfig("TituloSistema");
      echo "<TITLE>$titulosistema</TITLE>";
      echo "<link rel=\"shortcut icon\" href=\"../images/icone.ico\" >"; 
      echo "</HEAD>";
      echo "<BODY BGCOLOR=\"#FFFFFF\" TEXT=\"#000000\" LINK=\"#0000FF\" VLINK=\"#000080\" ALINK=\"#FF0000\">";

      echo "<TABLE WIDTH=100% BORDER=9 cellpadding=\"0\"cellspacing=\"0\" >";
      echo "<TR ><TD WIDTH=33% ><H4>$cabecalho</H4></TD>";
      echo "<TD><CENTER><IMG SRC=\"$HOME/images/logo-mini.jpg\" ";
      echo "HEIGHT=37 WIDTH=200></CENTER></TD> ";
      echo "<TD>"; MostraHora(); echo "<TD></TR>";
      echo "</TABLE>";


   } // Fim de Funcao MostraCabec

   function MostraRodape() {
      echo "<hr size=1 align=center>";
      echo "<BR><form><input type=\"button\" value=\"";
      echo _("Back");
      echo "\" onClick=\"history.back()\"></form>";
      echo "</BODY>";
      echo "</HTML>";
   } // Fim de Funcao MostraRodape

   function ValidaData($data) {
      echo "<BR>data=[$data]";
      if (empty($data)) {
        echo "<BR>Erro";
	return $ERRO;
      }
   }

   function MostraMenuClientes() {
      global $HOME;
      echo "<A HREF=$HOME/bd/index.php>Home</A> |<A HREF=$HOME/bd/clientes/index.php>Cadastro de Clientes</A> |<A HREF=pesquisa.php>Pesquisa </A> | <A HREF=inclusao.php>Inclusao </A>  | <A HREF=listaclientes.php>Listagem de clientes </A> | <A HREF=data.php>data </A> ";
   }

   function MostraMenuAdm() {
      global $HOME;
      echo "<A HREF=$HOME/bd/index.php>Home</A> | <A HREF=$HOME/bd/adm/index.php>Administracao</A> | <A HREF=produtos/index.php>Produtos</A> | <A HREF=tiposprodutos/index.php>Tipos de Produtos </A> ";
   }
   function MostraMenuAdmProdutos() {
      global $HOME;
      echo "<A HREF=$HOME/bd/index.php>Home</A> | <A HREF=$HOME/bd/adm/index.php>Administracao</A> | <b>>>Produtos>>><b> <A HREF=pesquisa.php>Pesquisa </A> | <A HREF=inclusao.php>Inclusao </A>  | <A HREF=listaprodutos.php>Listagem de produtos </A>";
   }
   function MostraMenuAdmTiposProdutos() {
      global $HOME;
      echo "<A HREF=$HOME/bd/index.php>Home</A> | <A HREF=$HOME/bd/adm/index.php>Administracao</A> | <b>>Tipos de Produtos>>><b> | <A HREF=inclusao.php>Inclusao </A>  | <A HREF=listatiposprodutos.php>Listagem de Tipos de Produtos </A>";
   }

   function MostraMenuPedidos() {
      global $HOME;
      echo "<A HREF=$HOME/bd/index.php>Home</A> | <A HREF=$HOME/bd/clientes/pesquisa.php>Pesquisa Clientes</A> | <A HREF=$HOME/bd/pedidos/listapedidos.php>Listar pedidos</A> ";
   }

   function MostraNomeTipo($conn,$tipo) {
      $resultt = pg_Exec($conn, "Select * from tiposprodutos;");
      $num = pg_NumRows($resultt);
      if($num == 0) { 
         return ("erro"); 
      }
      for($i = 0; $i < $num; $i++) {
            $nome= pg_Result($resultt, $i, "nome");
            $cod_tiposprodutos= pg_Result($resultt, $i, "cod_tiposprodutos");  
            if ( $tipo == $cod_tiposprodutos ) {
               pg_FreeResult($resultt);
               return ($nome);
            }
      }
      pg_FreeResult($resultt);
      $nome="Nao achei tipo";
      return ($nome);
   }

   function MostraNomeProduto($con,$numero) {
//      Debuga("entrei em MostraNomeProduto con=[$con] numero=[$numero] <BR>");
      $resultt = pg_Exec($con, "Select * from produtos WHERE numero = '$numero';");
      $num = pg_NumRows($resultt);
      if($num == 0) { 
         return ("erro"); 
      }
      $nome= pg_Result($resultt, 0 , "nome");
      pg_FreeResult($resultt);
      return ($nome);
   }

   function MostraCliente($con, $cod_cliente, $dado) {
      $resultt = pg_Exec($con, "Select * from clientes WHERE cod_cliente = '$cod_cliente';");
      $num = pg_NumRows($resultt);
//      Debuga("entrei em MostraCliente con=[$con] cod_cliente=[$cod_cliente] num=[$num]<BR>");
      if($num == 0) { 
         return ("erro"); 
      }
      $nome= pg_Result($resultt, 0, "nome");
      $telefone= pg_Result($resultt, 0, "telefone");
      $endereco= pg_Result($resultt, 0, "endereco");
      pg_FreeResult($resultt);
      switch ($dado) {
         case ( $dado == "nome" ): $retornar = $nome ;  break;
         case ( $dado == "telefone" ): $retornar = $telefone ;  break;
         case ( $dado == "endereco" ): $retornar = $endereco ;  break;
      }
      return ("$retornar");
   }


   function RetornaValorProduto($con,$tamanho,$numero) {
      $result = pg_Exec($con, "
SELECT t.valorbroto, t.valormedio, t.valorgrande, t.valormaster, t.valorbig 
FROM produtos p, tiposprodutos t
WHERE p.numero = '$numero' AND p.cod_tiposprodutos = t.cod_tiposprodutos ;");

      $num = pg_NumRows($result);
      if($num == 0) { MostraErro("Não achei o produto $numero cadastrado !\n"); }

      for($i = 0; $i < $num; $i++) {
         $valorbroto= pg_Result($result, $i, "valorbroto");
         $valormedio= pg_Result($result, $i, "valormedio");
         $valorgrande= pg_Result($result, $i, "valorgrande");
         $valormaster= pg_Result($result, $i, "valormaster");
         $valorbig= pg_Result($result, $i, "valorbig");
   
         if ( $tamanho == "broto" )  { $valor=$valorbroto; }
         if ( $tamanho == "medio" )  { $valor=$valormedio; }
         if ( $tamanho == "grande" ) { $valor=$valorgrande; }
         if ( $tamanho == "master" ) { $valor=$valormaster; }
         if ( $tamanho == "big" )    { $valor=$valorbig; }
      }
      pg_FreeResult($result);
      return ($valor);
   }


function Preenchecombrancos ( $string ,$posicao) {
   $aux = $string;
//   echo "entrei em Preenchecombrancos aux=$aux";
   $tamlinha=48;                                              // tamanho linha de impressao na Bematech
   $taminiciovalor= $posicao;                                 // posicao correta para a primeira linha 
   $taminiciovalor2linhas= $taminiciovalor + $tamlinha;       // posicao correta para a segunda linha 
   $taminiciovalor3linhas= $taminiciovalor + $tamlinha + $tamlinha; // posicao correta para terceira linha 
   
   $tamanho=strlen($string);
   $ultimoenter=strrpos($string,"\n");
//   echo "tamanho=$tamanho ultimoenter=$ultimoenter ";
   $diferenca=$tamanho - $ultimoenter;

// se a descricao é menor que uma linha 
   if ( $diferenca <= $taminiciovalor ) {         // vou preencher com espaco até a posicao 39
      $nrespacos= $taminiciovalor - $diferenca;
      for ( $i=0 ; $i< $nrespacos ; $i++ ) {
        $aux = $aux . " ";
      }
      return $aux;
   }

// se a descricao é menor que duas linha Ex. valor posicao 39 entao 39+46
   if ( $diferenca <= $taminiciovalor2linhas ) {   // vou preencher com espaco até a posicao 39+46
      $nrespacos= $taminiciovalor2linhas - $diferenca;
      for ( $i=0 ; $i< $nrespacos ; $i++ ) {
        $aux = $aux . " ";
      }
      return $aux;
   }

// se a descricao é menor que duas linha Ex. valor posicao 39 entao 39+46
   if ( $diferenca <= $taminiciovalor3linhas ) {   // vou preencher com espaco até a posicao 39+46
      $nrespacos= $taminiciovalor3linhas - $diferenca;
      for ( $i=0 ; $i< $nrespacos ; $i++ ) {
        $aux = $aux . " ";
      }
      return $aux;
   }

// foi maior que 3 linhas, retorno a string.

   return $string;
}

function MontaBufferImpressao ( $conn, $imprimir , $arraypedido ) {

   // varrendo o arraypedido para confirmar o pedido

   $numelementosarray= count($arraypedido);
   $i=0;
   $contaitem=0;
   $numpizzaaux=0;
//   Debuga ("i=$i = numelementosarray=$numelementosarray<BR>");
   for ($posicao = 0; $posicao < $numelementosarray; $posicao++)  {
      $aux=$arraypedido[$posicao];
          //echo "aux=$aux - ";
          // tamanhopizza // sabor1 // sabor1 // sabor1 // borda // calzone // lasanha
      switch ($i) {
         case 0:
            if ( ! empty($aux)) {                                      // Tamanho da pizza
               $contaitem++;
               $imprimir = $imprimir . "\n[" .$contaitem. "]";
               if ( $aux == "broto"  ) { $imprimir = $imprimir . " B :";  }  // tirei palavra PIZZA
               if ( $aux == "grande" ) { $imprimir = $imprimir . " G :";  } 
               if ( $aux == "master" ) { $imprimir = $imprimir . " M :";  } 
            }
            break;
         case 1:
            if ( ! empty($aux)) {
               $auxnome=MostraNomeProduto($conn,$aux);
               $auxnome = strtoupper($auxnome);
               $imprimir = $imprimir .$aux. "-" .$auxnome. " ";   //nr e nome sabor1
            }
            break;
         case 2:
            if ( ! empty($aux)) {
               $auxnome=MostraNomeProduto($conn,$aux);
               $auxnome = strtoupper($auxnome);
               $imprimir = $imprimir . " -- " .$aux. "-" .$auxnome. " "; //nr e nome sabor2
            }
            break;
         case 3:
            if ( ! empty($aux)) {
               $auxnome=MostraNomeProduto($conn,$aux);
               $auxnome = strtoupper($auxnome);
               $imprimir = $imprimir . " -- " .$aux. "-" .$auxnome. " "; //nr e nome sabor3
            }
            break;
         case 4:
            if ( $aux == 1 ) {
               $imprimir = $imprimir . "\n          Borda de CATUPIRY" ;                //Borda
            }
            if ( $aux == 2 ) {
               $imprimir = $imprimir . "\n          Borda de CHEDDAR " ;
            }
            break;
         case 5:                                                                 // Valor da Pizza
            if ( $aux != 0 ) {
               $aux= ereg_replace(",", ".", $aux);
               $imprimir = Preenchecombrancos($imprimir,41);
               $imprimir = $imprimir . sprintf("R$ %01.2f",$aux);   //Valor da pizza
               $imprimir = $imprimir . "\n________________________________________________" ;
            }
            break;
         case 6:
            if ( ! empty($aux)) {                                         // Tamanho do Calzone
               $contaitem++;
               $imprimir = $imprimir . "\n[" .$contaitem. "]";
               if ( $aux == "medio"   ) { $imprimir = $imprimir . " CALZONE   M :";  } 
               if ( $aux == "grande"  ) { $imprimir = $imprimir . " CALZONE   G :";  } 
            }
            break;
         case 7:
            if ( ! empty($aux)) {
               $auxnome=MostraNomeProduto($conn,$aux);
               $auxnome = strtoupper($auxnome);
               $imprimir = $imprimir .$aux. "-" .$auxnome. "\n";     // Numero e sabor do Calzone
            }
            break;
         case 8:
            if ( $aux != 0 ) {
               $aux= ereg_replace(",", ".", $aux);
               $imprimir = $imprimir . "                                      " .sprintf("R$ %01.2f",$aux);  //Valor calzone
               $imprimir = $imprimir . "\n________________________________________________";
            }
            break;
         case 9:
            if ( ! empty($aux)) {                                             // Tamanho Lasanha
               $contaitem++;
               $imprimir = $imprimir . "\n[" .$contaitem. "]";
               if ( $aux == "medio"    ) { $imprimir = $imprimir . " LASANHA   M :";  } 
               if ( $aux == "grande"   ) { $imprimir = $imprimir . " LASANHA   G :";  } 
            }
            break;
         case 10:
            if ( ! empty($aux)) {
               $auxnome=MostraNomeProduto($conn,$aux);
               $auxnome = strtoupper($auxnome);
               $imprimir = $imprimir .$aux. "-" .$auxnome. "\n";          // Numero e sabor da Lasanha
            }
            break;
         case 11:
            if ( $aux != 0 ) {
               $aux= ereg_replace(",", ".", $aux);
               $imprimir = $imprimir . "                                    " .sprintf("R$ %01.2f",$aux);  //Valor lasanha
               $imprimir = $imprimir . "\n________________________________________________";
            }
            break;
      }

      $i++;
      if ( $i == 12 ) {                                       //passei em cada variavel do item do array 
           $i=0;
      } 
   }
   return ($imprimir);
}

function ProcuraConfig($string_para_pesquisar){
      global $HOME;
      $charcomentario='#';
      $separador='=';
      $arqconf = "$HOME/bd/conf/bd.config";                   // nome do arquivo de configuracao
      $handle = fopen ($arqconf, "r") or die("falha ao abrir $arqconf");

      while (!feof ($handle)) {
         $buffer = fgets($handle, 4096);
         $linha=´´;
// tirando os comentarios da linha
         $pos = strpos($buffer, $charcomentario);             // ver se tem comentario na linha
         if ($pos === false) {
            $linha = $buffer;                                 // nao achei comentario
         }else {
            $linha = substr($buffer, 0, $pos);                // tirando o comentario da linha
         }
         //echo "<BR>$linha";

// retornando o conteudo da variavel se eu achar
         $array=explode ( "$separador" , $linha );
         $aux = trim($array[0]);                              // tirando espassom em branco
         if ( $aux == $string_para_pesquisar ) {
            fclose ($handle);
            return ( trim($array[1]) );
         }
      }
      fclose ($handle);
      return("erro");

}// fim da funcao ProcuraConfig




   function send_mail($to_address, $from_address, $subject, $message) {

      $path_to_sendmail = "/usr/lib/sendmail";

      $fp = popen("$path_to_sendmail -t", "w");
      $num = fputs($fp, "To: $to_address\n");
      $num += fputs($fp, "From: $from_address\n");
      $num += fputs($fp, "Subject: $subject\n\n");
      $num += fputs($fp, "$message");
      pclose($fp);

      if ($num > 0) {
        return 1;
      } else {
        return 0;
      }

}

// SaiErro ()
// fabio@conectiva.com.br
// somente avisa o erro GRAVE
// pede para usuário avisar o webmaster
// coloca botão retornar
// e sai
function SaiErro($msg)
{
        echo "<BR><H4>Erro!!</H4>";
        echo "<BR>$msg";
        echo "<BR>Envie email para o webmaster!<BR>";
        echo "<form>";
            echo "<input type=\"button\" value=\"Retornar\" onClick=\"history.back()\">";
        echo "</form>";
        exit;
}    


function Debuga($msg)
{
    global $DEBUGA;
    if ( $DEBUGA == 1 ) {
        echo "<BR>Debugando-->$msg";
    }
}

// MostraErro ()
// fabio@conectiva.com.br
// somente avisa o erro,
// coloca botão retornar
// e sai
function MostraErro($msg)
{
        echo "</td></tr></td></tr></td></tr></table>";
        echo "Erro!!";
        echo "$msg";
        echo "<form>";
        echo "<input type=\"button\" value=\"Retornar\" onClick=\"history.back()\">";
        echo "</form>";
        exit;
}     


function MostraeSai($msg)
{
        echo "<BR>$msg";
        echo "<form>";
        echo "<input type=\"button\" value=\"Retornar\" onClick=\"history.back()\">";
        echo "</form>";
        exit;
}     




function TabelaOK($conn,$tabela)
{
    $result__local = pg_Exec($conn, "Select * from $tabela ;");
    $num__local = pg_NumRows($result__local);
    if ( $num__local == 0 ) {
          MostraErro ("Não existem dados na tabela $tabela cadastradas!.");
    }    
    pg_freeresult($result__local);
    return ;
}

function GravaLog ( $arquivo, $texto )
{
    $DIR_HOME="/home/httpd/html/ed";
   if ( $arquivo == webmaster ) {
      $ARQ_LOG = "$DIR_HOME/logs/webmaster.log";
   }
   if ( $arquivo == professor ) {
      $ARQ_LOG = "$DIR_HOME/logs/professor.log";
   }
   if ( $arquivo == aluno ) {
      $ARQ_LOG = "$DIR_HOME/logs/aluno.log";
   }

//   echo "arquivo=$arquivo , texto=$texto, ARQ_LOG=$ARQ_LOG\\n";
   $fp = fopen("$ARQ_LOG", "a+");
   $data_atual = date("d/m/Y"); 
   $Texto_log="$data_atual - $texto\n";
   fwrite($fp,$Texto_log);
   fclose($fp);
}

function CriaDir ($dir) {
    $ret = mkdir ("$dir" , 0777 );
    if (!$ret) {
        SaiErro ("<BR>\nOcorreu um erro durante a criação do diretório $dir .\n");
    }    
    $DIR_HOME="/home/httpd/html/ed";
   $origem= sprintf( "%s/%s",$DIR_HOME ,"/lib/listadir.php");
   $destino = sprintf( "%s/%s", $dir,"index.php");
   if (!copy($origem, $destino)) {
       SaiErro("Erro durante a criação do arquivo $dir/index.php..\n");
   }

    return ( 0 );
}

function RemoveDir ($dir) {
    $ret = rmdir ("$dir");
    if (!$ret) {
      SaiErro ("<BR>Ocorreu um erro durante a remoção do diretorio $dir \n");
    }    
    return ( 0 );
}


/*********************************************************
*  dom jul  4 15:29:56 EST 1999
*  img_upload = envia arquivo para um curso
*********************************************************/

function img_upload($arquivotmp,$arquivo_real_name,$rota_destino) 
{ 
$arquivotmp = stripslashes($arquivotmp);

   $i = "0"; 
   $d = dir($rota_destino); 
   while($entry=$d->read())  
   { 
      if($entry == $arquivo_real_name) 
      { 
         $arquivo_real_name_in_use = "TRUE";
      } 
      ++$i; 
   } 
                    
$d->close(); 
   if($arquivo_real_name_in_use == "TRUE") {  
      $new_arquivo_real_name = $arquivo_real_name.date('hms');
      echo "<BR>Atenção já existia arquivo com o nome: $arquivo_real_name!";
      echo "<BR>Gravei arquivo com novo nome:$new_arquivo_real_name";
   } 
   else {  
      $new_arquivo_real_name = $arquivo_real_name;
   } 
   $new_img_location = $rota_destino. '/'.$new_arquivo_real_name;

   if ( ! copy($arquivotmp,$new_img_location) ) {
      SaiErro("Erro copiando arquivo $arquivotmp para $new_img_location ");
   }

   if ( ! chmod($new_img_location, 0666) ) {
      SaiErro("Erro mudando a permissão do arquivo $new_img_location ");
   }

   $img_upload_array = array("$new_arquivo_real_name","$new_img_location");
                                     
return($img_upload_array);      
} 
/*-----------------------------///  img_upload()  ///-------------------------*/



/*******************************************************************
* Código Aprimorado por: Thiago Alves Goulart                     *
* Data: 20/06/2002.                                               *
* Projeto: Marmoraria Florianópolis                               *
* URL: www.marmorariaflorianopolis.com.br                         *
* Direitos: Uso livre                                             *
* OBS.: Terei imenso em contribuir pra seu projeto, mas gostaria  *
*       que este cabeçalho fosse mantido.                         *
*******************************************************************/

/*
Esta funcao recebe o valor em Float recebido do banco de dados e retorna um valor no formato da moeda Real (R$).
*/

function Real($valor){
    $valorretorno=number_format($valor, 2, ',', '.');
    return $valor;
    }


/*
class foo {
    function do_foo () {
        echo "Doing foo.";
    }
}

$bar = new foo;
$bar -> do_foo ();    
*/

?>       
