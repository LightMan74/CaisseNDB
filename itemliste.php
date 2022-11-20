<?php

$items = array(
"Biere" => "2.50",
"Soda" => "2.00",
"Cafe" => "1.00",
"Pates" => "5.00",
"Crepe_Nutela" => "2.00",
"Crepe_Sucrée" => "1.50",
"Patisserie_2" => "2.00",
"Patisserie_1" => "1.00",
"Consigne" => "1.00"
);

$cumulitem;
$first = true;

echo "<script>\n";
echo "var detailsitemtext = '';\n";
echo "var countitems = 0;\n";
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
//  echo "detailsitemtext = ";
//  $first = true;
//  foreach ($items as $item => $prix){
//     //echo " + '$item --> ' + $item + ' / '";
//     if ($first){
//         echo "'$item : $prix € --> ' + $item + ' / '";
//         $first = false;
//     }else{
//         echo " + '$item : $prix € --> ' + $item + ' / '";
//     }
// }
echo "detailsitemtext = '';\n";
echo "countitems = 0;\n";
foreach ($items as $item => $prix){
echo "if ($item > 0){\n";
echo "countitems += 1;\n";
echo "detailsitemtext += ";
echo "'$item : $prix € --> ' + $item + ' / '\n";
echo "}\n";
}
echo "detailsitemtext = detailsitemtext.slice(0, -3);\n";

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
echo "<input style=\"display:none\" id=\"detailsitems\" name=\"detailsitems\" class=\"element text medium\" type=\"text\" maxlength=\"500\" value=\"0\" />\n";
echo "<input style=\"display:none\" id=\"conso\" name=\"conso\" class=\"element text medium\" type=\"text\" maxlength=\"255\" value=\"0\" />\n";

echo "<br>";

foreach ($items as $item => $prix){
echo "<div id=\"btnitems\">"; 

echo "<p>Nbres: <a id=\"$item\">0</a></p>\n";

echo "<input class=\"btn btn-good\" type=\"button\" onClick=\"onClick('$item')\" value=\"$item\n$prix €\">\n";
 
echo "<p>Total: <a id=\"".$item."total\">0 €</a></p>\n";

echo "</div>";
}
echo "<br><br>";
echo "<input class=\"btn btn-danger\" type=\"button\" onClick=\"resetfunc();\" value=\"RESET\">\n";
echo "<br><br>";



?>
<script>
function ifcredit() {
    // console.log(parseFloat(document.getElementById("creditin").value) + parseFloat(document.getElementById("creditadd")
    //     .value) < parseFloat(document
    //     .getElementById("conso").value));
    // console.log(document.getElementById("creditin").value);
    // console.log(document.getElementById("creditadd").value);
    // console.log(parseFloat(document.getElementById("creditin").value) + parseFloat(document.getElementById("creditadd")
    //     .value));
    // console.log(document.getElementById("conso").value);
    // console.log(document.getElementById("detailsitems").value = detailsitemtext);
    var creditaddnozero = parseFloat(document.getElementById("creditadd").value);
    if (!creditaddnozero) {
        creditaddnozero = 0;
    }
    if (parseFloat(document.getElementById("creditin").value) + creditaddnozero < parseFloat(document
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

// String.prototype.removeCharAt = function(i) {
//     var tmp = this.split(''); // convert to an array
//     tmp.splice(i - 1, 1); // remove 1 element from the array (adjusting for non-zero-indexed counts)
//     return tmp.join(''); // reconstruct the string
// }

// function reverse(s) {
//     return s.split("").reverse().join("");
// }
// console.log("crt/r2002_2".slice(0, -4));
</script>