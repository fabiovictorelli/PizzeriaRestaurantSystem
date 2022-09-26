<html>
<head>
<title>DbTxt1.0_Beta</title>
</head>
<body background="bkgtbtxt.gif">
<img src="tbtxt.GIF"  border="0" alt="">
<?php
    $id = fopen("texto.txt", "r"); 
	 	 
	$i="0";	  
	
	include "config.inc";
	
	 echo "<center><font size=\"3\"><b>Exibindo Condeúdo do Arquivo
	      Texto.txt</b></font></center><br>";  
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
		        border-color : $cor_borda;text-align:center\">ANO</td></tr>";
	 
	while(!feof($id)){	
	
	   $buffer = fgets($id,4096);	
	   //retirando o primeiro asterisco do arquivo txt
	   //para que não seja criada uma primeira linha vazia		 
	   $buffer[0]=" "; 
	   	   
	   //Separando cada sequencia de registros
       $mostra = explode("*",$buffer);
	     
    
	   while($i < count($mostra)){
	   
	      //individualizando cada campo de sequencia 
		  //de registros (modelo - cor - ano)
	      list($modelo[$i],$cor[$i],$ano[$i]) = explode("-",$mostra[$i]);
		  
		  //definindo se a linha da tabela e ímpar ou par, para
		  //pintar o texto de cores diferentes
	      if(($i%2)){$texto = "$cortexto1";} else{$texto = "$cortexto2";}; 
		  			
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
		           style=\"border-style : $estilo;border-width : 1;
		           border-color : $cor_borda;color:$texto\">".$modelo[$i]."</td><td 
		           style=\"border-style : $estilo;border-width : 1;
		           border-color : $cor_borda;color:$texto\">".$cor[$i]."</td><td 
		           style=\"border-style : $estilo;border-width : 1;
		           border-color : $cor_borda;color:$texto\">".$ano[$i];
		  
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