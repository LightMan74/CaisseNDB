<?php

$items = array(
"Bierre" => "2.50",
"Coca" => "2.00",
"Cafe" => "1.50",
"pate" => "4.00",
"crepe" => "2.00",
"limonade" => "2.00",
"pizza" => "2.50",
);

$cumulitem;
$first = true;

echo "<script>\n";
foreach ($items as $item => $prix){
echo "var $item = 0;\n";
}
echo "function onClick(itm) {\n";
foreach ($items as $item => $prix){
    echo "if (itm == \"$item\"){\n";
    echo "$item += 1;\n";
    echo "document.getElementById(\"$item\").innerHTML = $item;\n";
    echo "document.getElementById(\"".$item."total\").innerHTML = $item * $prix + ' €';\n";
    if ($first){
        $cumulitem = $item ."*". $prix ;
        $first = false;
    }else{
        $cumulitem = $cumulitem ."+". $item ."*". $prix ;
    }
    echo "};\n";
 }
 echo "document.getElementById(\"total\").innerHTML = $cumulitem  + ' €';\n";
 echo "document.getElementById(\"conso\").value = $cumulitem;\n";

echo "};\n";

echo "function resetfunc() {\n";
    foreach ($items as $item => $prix){
        echo "$item = 0;\n";
        echo "document.getElementById(\"$item\").innerHTML = 0;\n";
        echo "document.getElementById(\"".$item."total\").innerHTML = 0 + ' €';\n";
     }
     echo "document.getElementById(\"total\").innerHTML = 0;\n";
 echo "document.getElementById(\"conso\").value = 0;\n";
 echo "};\n";
echo "</script>\n";



echo "<p>Total general: <a id=\"total\" name=\"total\" value=\"0\">0 €</a></p>\n";
echo "<input style=\"display:none\" id=\"conso\" name=\"conso\" class=\"element text medium\" type=\"text\" maxlength=\"255\" value=\"0\" />\n";

echo "<br><br>";

foreach ($items as $item => $prix){
echo "<input class=\"btn btn-good\" type=\"button\" onClick=\"onClick('$item')\" value=\"$item : $prix €\">\n";
echo "<p>Nbres: <a id=\"$item\">0</a></p>\n";
echo "<p>Total: <a id=\"".$item."total\">0 €</a></p>\n";
}

echo "<input class=\"btn btn-danger\" type=\"button\" onClick=\"resetfunc();\" value=\"RESET\">\n";




?>

<!-- <script>
var bierre = 0;
var coca = 0;

function onClick(item) {
    bierre += 1;
    document.getElementById("bierre").innerHTML = bierre;
    document.getElementById("bierretotal").innerHTML = bierre * 2.5;
    coca += 1;
    document.getElementById("coca").innerHTML = coca;
    document.getElementById("cocatotal").innerHTML = coca * 2;



    document.getElementById("total").innerHTML = coca * 2 + bierre * 2.5;
    document.getElementById("conso").value = coca * 2 + bierre * 2.5;
};
</script>

<button type="button" onClick="onClick('bierre')">Bierre : 2€50</button>
<p>Nbres: <a id="bierre">0</a></p>
<p>Total: <a id="bierretotal">0</a></p>


<button type="button" onClick="onClick('coca')">coca : 2€00</button>
<p>Nbres: <a id="coca">0</a></p>
<p>Total: <a id="cocatotal">0</a></p>

<p>Total general: <a id="total" name="total" value="0">0</a></p>
<input style="display:none" id="conso" name="conso" class="element text medium" type="text" maxlength="255" value="0" />

-->