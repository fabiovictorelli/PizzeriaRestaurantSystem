
<!-- FORMULARIO HTML -->
<form>
Corretor(a): <select name="corretor">
    <?=corretores($corretor)?>  
</select>
<input type=submit value="ok">
</form>

<?
### Versão MySQL    
function corretores($sel=0) {
    $con_server="localhost";
    $con_usuario="root";
    $con_senha="";
    $con_database="dbempresa";
    $db=mysql_connect($con_server, $con_usuario, $con_senha);
    mysql_select_db($con_database,$db);
    $SQL="SELECT login, nome FROM tabela WHERE cargo LIKE 'Corretor%'";
    $rs=mysql_query($SQL);
    $corretor = "Selecione";
    $rel_crs  = "<option value=\"$corretor\" ";
    $rel_crs .= ($corretor==$sel) ? "selected " : "";
    $rel_crs .= " >Selecione</option>\n";
    if($rs==true) {                
        while($fields=mysql_fetch_row($rs)) {
            $corretor = $fields[0];
            $nomecr   = $fields[1];
            $rel_crs .= "<option value=\"$corretor\" ";
            $rel_crs .= ($corretor==$sel) ? "selected " : "";
            $rel_crs .= " >$nomecr</option>\n";    
        }                
    }
    return $rel_crs;
}    

