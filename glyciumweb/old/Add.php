

<?php
session_start(); 
require_once "config.php";
//($_SERVER["REQUEST_METHOD"] == "POST" && 
if (isset($_POST['additem'])){

$deg = $_POST["DESIGNATION"];
$type = $_POST["TYPE"];
$ref = $_POST["REFERENCE"];
$fourn = $_POST["FOURNISEUR"];
$pp1 = $_POST["PRIXPUBLIC1"] . "." . $_POST["PRIXPUBLIC0"];
$pn1 = $_POST["PRIXNET1"] . "." . $_POST["PRIXNET0"];
$refclient = $_POST["REFCLIENT"];

$qrb = $_POST["QRB"];
$qlb = $_POST["QLB"];
$qrw = $_POST["QRW"];
$qlw = $_POST["QLW"];
$qrj = $_POST["QRJ"];
$qlj = $_POST["QLJ"];
$qpl = $_POST["QPL"] / 100;

 $sql = "INSERT INTO `stock`(`DESIGNATION`, `TYPE`, `REFERENCE`, `FOURNISEUR`, `PRIXPUBLIC`, `PRIXNET`, `REFCLIENT`, `QRB`, `QLB`, `QRW`, `QLW`, `QRJ`, `QLJ`, `QPL`) VALUES ('$deg','$type','$ref','$fourn','$pp1','$pn1','$refclient','$qrb','$qlb','$qrw','$qlw','$qrj','$qlj','$qpl')";

$conn = $link;

if(mysqli_query($conn, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error(conn);
}

mysqli_close($conn);

?>


<script type="text/javascript">
window.location.href = "liste.php";
</script>

<?php
}



include "AddForm.php";


?>
