<html>
<head>
<title>TbTxt1.0</title>
</head>
<body background="bkgtbtxt.gif">
<img src="tbtxt.GIF"  border="0" alt="">
<?php
    $id = fopen("texto.txt", "r"); 
	 	 
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
	     
        //|||||||||||||||||exibindo select||||||||||||||||||||||||
	 echo "<center>";
		echo "<font size=\"3\"><b>Exibir Selecionado</b></font>";
		echo "<form name=\"form1\" method=\"post\" action=\"$PHP_SELF\">
	            <select name=\"sel\" onchange=\"Javascript:(document.form1.submit())\" >";
		     echo "<option value=\"$sel\"  checked >$sel</option>";
		     while($i2 < count($mostra)){
		        //individualizando cada campo de sequencia 
		        //de registros (modelo - cor - ano)		  
	            list($modelo[$i2],$cor[$i2],$ano[$i2]) = explode("-",$mostra[$i2]);		         	     
		       $i2++;   
		     }
			 for($r=0;$r<count($mostra);$r++){
			    //eliminando valores duplicados
	            $modelo2=array_unique($modelo);
				//retirando registros vazios criados
				//pela função array_unique
	            if($modelo2[$r]!=""){
	               echo "<option value=\"$modelo2[$r]\" >$modelo2[$r] </option>";
		        }
			 }
	      echo "</select>
		     </form>";
	 echo"</center>";
	
		 //||||||||||||fim select|||||||||||||||
		 
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
	 
		
	   while($i < count($mostra)){
	   
	      //individualizando cada campo de sequencia 
		  //de registros (modelo - cor - ano)
	      list($modelo[$i],$cor[$i],$ano[$i]) = explode("-",$mostra[$i]);
		  
		   //eliminando registros que satisfaçam a variável $ano
		   if( $modelo[$i]=="$sel" ){		   
		   		   
		     //definindo se a linha da tabela e ímpar ou par, para
		     //pintar o texto de cores diferentes
	         if(($i%2 )){$texto = "$cortexto1";} else{$texto = "$cortexto2";}; 
		  			
 	            echo "<tr ";
		       //definindo se a linha da tabela e ímpar ou par, para
		       //pinta-las de cores diferentes e se o ano do carro
		       //é igual ao definido na configuração, para destaca-lo
		       //com uma terceira cor 	
		          if( $i%2 && $ano[$i]!=$limite ){
		             echo "bgcolor=\"$corlinha2\"";
		          }elseif((!$i%2 ||$i%2)|| $ano[$i]==$limite ){
			         echo "bgcolor=\"$corlinha3\"";
		          }else{
			         echo "bgcolor=\"$corlinha1\"";
		          };
		           echo ">
		                    <td
		                    style=\"border-style : solid;border-width : $borda_celula;
		                    border-color : $cor_borda;color:$texto\">".$modelo[$i]."</td><td 
		                    style=\"border-style : solid;border-width : $borda_celula;
		                    border-color : $cor_borda;color:$texto\">".$cor[$i]."</td><td 
		                    style=\"border-style : solid;border-width : $borda_celula;
		                    border-color : $cor_borda;color:$texto\">".$ano[$i];
		     }
	         $i++; 
		  }
	   
      }
      echo "</td>
	     </tr>
	  </table>";
    
   fclose ($id);
?>
<p align="center"><i><font face="Georgia, Times New Roman, Times, serif" 
color="#99ccff" size="2">Copyright © 2002 <br></i></font>
<i><font face="Georgia, Times New Roman, Times, serif" 
size="2">
<a href="mailto:dermevald@hotmail.com" style="color:#99ccff;" >Dermeval Dias Pereira Junior</a></font></i></p>
</body>
</html>