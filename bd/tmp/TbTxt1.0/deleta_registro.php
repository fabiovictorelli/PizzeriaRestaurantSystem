<html>
<head>
<title>TbTxt1.0</title>
</head>
<body background="bkgtbtxt.gif">
<img src="tbtxt.GIF"  border="0" alt="">
<?php

    $id = fopen("texto.txt", "r");
	
	if(isset($grava) && $sel!=" "){
	    $id3 = fopen("texto.txt", "w");	
		fwrite($id3," ",4096);
		fclose($id3);			  
	    $id2 = fopen("texto.txt", "w");
		fwrite($id2,$grava,4096);
		fclose($id2);
	  }		
	 
	 	 
	$i="0";
	$i2="0";
	  
	
	include "config.inc";
	   
	
	 
	while(!feof($id)){	
	
	   $buffer = fgets($id,4096);
	   
	   //retirando o primeiro asterisco do arquivo txt
	   //para que não seja criada uma primeira linha vazia	
	   $buffer[0]=" ";		
	   	   	   
	   //Separando cada sequencia de registros
       $mostra = explode("*",$buffer);
	     
        //||||||||||exibindo select||||||||||||||||||
		
		echo "<table align=\"center\" >
		         <tr>
				    <td valign=\"middle\">";
		      echo "<font size=\"3\"><b>Exclui Selecionado</b></font>";
		         echo "<form name=\"form1\" method=\"get\" action=\"$PHP_SELF\">
	                      <select name=\"sel\" 
						  onchange=\"Javascript:(document.form1.submit())\" >";
		               echo "<option value=\"$sel\"  checked >$sel</option>";
		               while($i2 < count($mostra)){
		                  //individualizando cada campo de sequencia 
		                  //de registros (modelo - cor - ano)		  
	                      list($modelo[$i2],$cor[$i2],$ano[$i2]) = explode("-",$mostra[$i2]);
		   
		                  echo "<option value=\"$modelo[$i2] $cor[$i2] $ano[$i2]\" >
		                        $modelo[$i2] $cor[$i2]  $ano[$i2] </option>";
		                  $i2++;		   
		               }
	                echo "</select>		 
		               </form>";
		      echo "</td>
		         </tr>
                 <tr>
		            <td valign=\"middle\" align=\"center\">";		    
		  
		            //|||||||||||||||fim select||||||||||||||||||
		 
	               //Selecionando Registro a ser deletado 		
	               while($i < count($mostra)){
	   
	                  //individualizando cada campo de sequencia 
		              //de registros (modelo - cor - ano)
	                  list($modelo[$i],$cor[$i],$ano[$i]) = explode("-",$mostra[$i]);
		  
		              //eliminando registros que satisfaçam a variável 
		              //$modelo,$cor,$ano
		              if(  ($modelo[$i]." ".$cor[$i]." ".$ano[$i])!="$sel" ){		  
		   
		                 //variável que guardara os valores dos registros
		                 //para posteriormente serem deletados do arquivo .txt
		                 $grava.= "*".$modelo[$i]."-".$cor[$i]."-".$ano[$i];
		   
		              }
	                  $i++; 		
	               }	    
   }
            
  fclose ($id);     
    
              echo "<a href=\"$PHP_SELF?grava=$grava\" name=\"vai\" id=\"vai\" style=\"font:20\">
	                   DELETAR
	                </a>";
           echo "</td>
	          </tr>
           </table>";
	 
	    //||||||||||||||||||||Exibindo Registros||||||||||||||||||||||||||||
		   
     echo "<table border=\"0\" align=\"center\"  cellspacing=\"0\" 
	       style=\"border-style : $estilo;border-width : $borda_tabela;
		   border-color : $cor_borda\">
		      <tr style=\"font-weight:$negrito;
	          color: $cortitulo;background-color:$caption\">
                 <td style=\"border-style : $estilo;border-width : $borda_celula;
		         border-color : $cor_borda;text-align:center\">MODELO</td>
	             <td style=\"border-style : $estilo;border-width : $borda_celula;
		         border-color : $cor_borda;text-align:center\">COR</td>
	             <td style=\"border-style : $estilo;border-width : $borda_celula;
		         border-color : $cor_borda;text-align:center\">ANO</td>
			  </tr>";
		   
	       for($r=0;$r<count($mostra);$r++){
			    
              $modelo2=$modelo;
		      $cor2=$cor;
			  $ano2=$ano;
			     
	             if($modelo2[$r]!=""){
				
				    //eliminando registros que satisfaçam a variável $ano
		            if(($modelo2[$r]." ".$cor2[$r]." ".$ano2[$r])!="$sel" ){
		  		   		   
		               //definindo se a linha da tabela e ímpar ou par, para
		               //pintar o texto de cores diferentes
	                   if(($r%2)){$texto = "$cortexto1";} else{$texto = "$cortexto2";}; 
		  			
        echo "<tr ";
		      //definindo se a linha da tabela e ímpar ou par, para
		      //pinta-las de cores diferentes e se o ano do carro
		      //é igual ao definido na configuração, para destaca-lo
		      //com uma terceira cor 	
		      if( $r%2 && $ano2[$r]!=$limite ){
		         echo "bgcolor=\"$corlinha2\"";
		      }elseif((!$r%2 ||$r%2)|| $ano2[$r]==$limite ){
			     echo "bgcolor=\"$corlinha3\"";
		      }else{
			     echo "bgcolor=\"$corlinha1\"";
		      };		 
	       echo ">
		         <td
		         style=\"border-style : $estilo;border-width : $borda_celula;
		         border-color : $cor_borda;color : $texto\">".$modelo2[$r]."</td><td 
		         style=\"border-style : $estilo;border-width : $borda_celula;
		         border-color : $cor_borda;color:$texto\">".$cor2[$r]."</td><td 
		         style=\"border-style : $estilo;border-width : $borda_celula;
		         border-color : $cor_borda;color:$texto\">".$ano2[$r];
	               
		        }
			 }
		  }
	       echo "</td>
              </tr>
           </table>";
	 //||||||||||||||||||||Fim Exibindo Registros|||||||||||||||||||||||
	 	  
?>
<p align="center"><i><font face="Georgia, Times New Roman, Times, serif" 
color="#99ccff" size="2">Copyright © 2002 <br></i></font>
<i><font face="Georgia, Times New Roman, Times, serif" 
size="2">
<a href="mailto:dermevald@hotmail.com" style="color:#99ccff;" >Dermeval Dias Pereira Junior</a></font></i></p>
</body>
</html>