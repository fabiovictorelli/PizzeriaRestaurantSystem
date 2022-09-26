<SCRIPT LANGUAGE="JavaScript">
<!--

  var ar = new Array();

  ar[0] = new Array();
  ar[0][0] = new makeOption("teste1");
  ar[0][1] = new makeOption("teste2");
  ar[0][2] = new makeOption("teste3");

  ar[1] = new Array();
  ar[1][0] = new makeOption("seila1");
  ar[1][1] = new makeOption("seila2");
  ar[1][2] = new makeOption("seila3");
  
  ar[2] = new Array();
  ar[2][0] = new makeOption("hehe1");
  ar[2][1] = new makeOption("hehe2");
  ar[2][2] = new makeOption("hehe3");
 
function makeOption(text) {
  this.text = text;
}

function relate(form) {
  var options = form.list.options;
  for (var i = options.length - 1; i > 0; i--) {
    options[i] = null;
  }
  var curAr = ar[form.topics.selectedIndex];
  for (var j = 0; j < curAr.length; j++) {
    options[j] = new Option(curAr[j].text);
  }
  options[0].selected = true;
  
}

// -->
</SCRIPT>

<FORM NAME="menu">
<SELECT NAME="topics" onChange="relate(this.form)">
    <option value="" selected>teste</option>
    <option value="">seila</option>
    <option value="">hehe</option>
  </SELECT>

<SELECT NAME="list">
<OPTION VALUE="" SELECTED>teste1
<OPTION VALUE="">teste2
<OPTION VALUE="">teste3
</SELECT>
</FORM>