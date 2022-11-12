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
 echo "document.getElementById(\"nocredit2\").innerHTML = $cumulitem  + ' €';\n";
 echo "document.getElementById(\"conso\").value = $cumulitem;\n";
 echo "ifcredit()\n";
echo "};\n";

echo "function resetfunc() {\n";
    foreach ($items as $item => $prix){
        echo "$item = 0;\n";
        echo "document.getElementById(\"$item\").innerHTML = 0;\n";
        echo "document.getElementById(\"".$item."total\").innerHTML = 0 + ' €';\n";
     }
     echo "document.getElementById(\"nocredit2\").innerHTML = 0  + ' €';\n";
 echo "document.getElementById(\"conso\").value = 0;\n"; 
 echo "ifcredit();";
 echo "};\n";
echo "</script>\n";


echo "<p style=\"display:none\" id=\"nocredit\">PAS ASSEZ DE CREDIT</p>\n";
echo "<p style=\"display:\" id=\"nocredit1\">Total general: <a id=\"nocredit2\" name=\"total\" value=\"0\">0 €</a></p>\n";
echo "<input style=\"display:none\" id=\"conso\" name=\"conso\" class=\"element text medium\" type=\"text\" maxlength=\"255\" value=\"0\" />\n";

echo "<br><br>";

foreach ($items as $item => $prix){
echo "<input class=\"btn btn-good\" type=\"button\" onClick=\"onClick('$item')\" value=\"$item : $prix €\">\n";
echo "<p>Nbres: <a id=\"$item\">0</a></p>\n";
echo "<p>Total: <a id=\"".$item."total\">0 €</a></p>\n";
}

echo "<input class=\"btn btn-danger\" type=\"button\" onClick=\"resetfunc();\" value=\"RESET\">\n";




?>
<script>
function ifcredit() {
    console.log(parseFloat(document.getElementById("creditin").value) + parseFloat(document.getElementById("creditadd")
        .value) < parseFloat(document
        .getElementById("conso").value));
    console.log(document.getElementById("creditin").value);
    console.log(document.getElementById("creditadd").value);
    console.log(parseFloat(document.getElementById("creditin").value) + parseFloat(document.getElementById("creditadd")
        .value));
    console.log(document.getElementById("conso").value);
    if (parseFloat(document.getElementById("creditin").value) + parseFloat(document.getElementById("creditadd")
            .value) < parseFloat(document
            .getElementById("conso").value)) {
        consochangeon();
    } else {
        consochangeoff();
    }

    function consochangeon() {
        var element = document.getElementById('creditbtn');
        var element2 = document.getElementById('nocredit');
        element.style.display = "none";
        element2.style.display = "";

    }

    function consochangeoff() {
        var element = document.getElementById('creditbtn');
        var element2 = document.getElementById('nocredit');
        element.style.display = "";
        element2.style.display = "none";
    }
}
</script>