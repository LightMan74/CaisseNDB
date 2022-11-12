<?php
        
    session_start();
    require_once "config.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $refint 		= strtoupper(htmlspecialchars($_POST["REFINT"], ENT_QUOTES));
        $deg 		= strtoupper(htmlspecialchars($_POST["DESIGNATION"], ENT_QUOTES));
        $ref 		= strtoupper(htmlspecialchars($_POST["REFERENCE"], ENT_QUOTES));
        $fourn 		= strtoupper(htmlspecialchars($_POST["FOURNISSEUR"], ENT_QUOTES));
        $pp1 		= htmlspecialchars($_POST["PRIXPUBLIC1"], ENT_QUOTES); // . "." . $_POST["PRIXPUBLIC0"]	, ENT_QUOTES);
        $pn1 		= htmlspecialchars($_POST["PRIXNET1"], ENT_QUOTES); // . "." . $_POST["PRIXNET0"]		, ENT_QUOTES);
        $refclient 	= strtoupper(htmlspecialchars($_POST["REFCLIENT"], ENT_QUOTES));
        
        $qrb = intval(htmlspecialchars($_POST["QRB"], ENT_QUOTES)) + intval(htmlspecialchars($_POST["QRBM"], ENT_QUOTES));
        $qlb = htmlspecialchars($_POST["QLB"], ENT_QUOTES);
        $qrw = intval(htmlspecialchars($_POST["QRW"], ENT_QUOTES)) + intval(htmlspecialchars($_POST["QRWM"], ENT_QUOTES));
        $qlw = htmlspecialchars($_POST["QLW"], ENT_QUOTES);
        $qrj = intval(htmlspecialchars($_POST["QRJ"], ENT_QUOTES)) + intval(htmlspecialchars($_POST["QRJM"], ENT_QUOTES));
        $qlj = htmlspecialchars($_POST["QLJ"], ENT_QUOTES);
        $qpl = htmlspecialchars($_POST["QPL"], ENT_QUOTES);

        $jpm 		= strtoupper(htmlspecialchars($_POST["JPM"], ENT_QUOTES));
        $wl 		= strtoupper(htmlspecialchars($_POST["WL"], ENT_QUOTES));
        $fav 		= strtoupper(htmlspecialchars($_POST["FAV"], ENT_QUOTES));

        $deprecier = htmlspecialchars($_POST["DEPRECIER"], ENT_QUOTES);
        
        dtc('jpm' . $jpm);
        dtc('wl' . $wl);
        dtc('fav' . $fav);

        if ($qpl > 0) {
            $qpl = $qpl / 100;
        }
        
        $id = $_POST["ID"];
        
        if (isset($_POST['additem'])) {
            $sql = "INSERT INTO `stock`(`DESIGNATION`, `REFINT`, `REFERENCE`, `FOURNISSEUR`, `PRIXPUBLIC`, `PRIXNET`, `REFCLIENT`, `QRB`, `QLB`, `QRW`, `QLW`, `QRJ`, `QLJ`, `QPL`, `WL`, `JPM`, `FAV`) VALUES ('$deg','$refint','$ref','$fourn','$pp1','$pn1','$refclient','$qrb','$qlb','$qrw','$qlw','$qrj','$qlj','$qpl','$wl','$jpm','$fav')";
            
            $sql = str_replace("'.'", "'0.0'", $sql);
            $sql = str_replace("''", "'0'", $sql);
            
            $conn = $link;
            
            if (mysqli_query($conn, $sql)) {
                //PopUpMsg("AJOUT EFFECTUER.");
            } else {
                PopUpMsg("AJOUT ERROR: $sql. " . mysqli_error(conn));
            }
            $sqlogs = 'INSERT INTO `logs` (`user`, `action`) VALUES ("' . $_SESSION["username"] . '","' . $sql . '")';
        //echo '<br>';
        //echo $sqlogs;
        $ww = mysqli_query($conn, $sqlogs);
            mysqli_close($conn);
        }
        if (isset($_POST['modifitem']) || isset($_POST['WL']) || isset($_POST['JPM']) || isset($_POST['FAV'])) {
            //dtc("merdeeeeeeeeeeee");
            $sql = "UPDATE `stock` SET `DESIGNATION`='$deg',`REFINT`='$refint',`REFERENCE`='$ref',`FOURNISSEUR`='$fourn',`PRIXPUBLIC`='$pp1',`PRIXNET`='$pn1',`REFCLIENT`='$refclient',`QRB`='$qrb',`QLB`='$qlb',`QRW`='$qrw',`QLW`='$qlw',`QRJ`='$qrj',`QLJ`='$qlj',`QPL`='$qpl',`WL`='$wl',`JPM`='$jpm',`FAV`='$fav' WHERE `ID`='$id'";
            
            $sql = str_replace("'.'", "'0.0'", $sql);
            $sql = str_replace("''", "'0'", $sql);
            $conn = $link;
            if (mysqli_query($conn, $sql)) {
                //PopUpMsg("MODIFICATION EFFECTUER.");
            } else {
                PopUpMsg("MODIFICATION Error: " . mysqli_error($conn));
            }
            $sqlogs = 'INSERT INTO `logs` (`user`, `action`) VALUES ("' . $_SESSION["username"] . '","' . $sql . '")';
        //echo '<br>';
        //echo $sqlogs;
        $ww = mysqli_query($conn, $sqlogs);
            mysqli_close($conn);
        } ?>

<?php
    if ((isset($_POST['additem'])) || (isset($_POST['modifitem'])) || (isset($_POST['WL'])) || (isset($_POST['JPM'])) || (isset($_POST['FAV']))) {
        $_SESSION['keepfiltre'] = true; ?>

<script type="text/javascript">
window.location.href = "liste.php";
</script>
<?php //window.location.href = "liste.php";
    } else {
        $_SESSION['keepfiltre'] = false;
    } ?>

<?php
    if (isset($_POST['openmodifitem'])) {
        $conn = $link;
        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $id = $_POST["ID"];
        
        $sql = "SELECT * FROM `stock` WHERE `ID` = $id";  //"SELECT * FROM stock";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $modifierORadd = "MODIFIER";
                $namemodifierORadd = "modifitem";
                include "modifform.php";
            }
        } else {
            PopUpMsg("0 results");
        }
        $sqlogs = 'INSERT INTO `logs` (`user`, `action`) VALUES ("' . $_SESSION["username"] . '","' . $sql . '")';
        //echo '<br>';
        //echo $sqlogs;
        $ww = mysqli_query($conn, $sqlogs);
        mysqli_close($conn);
    }
    
        if (isset($_POST['openadditem'])) {
            $modifierORadd = "AJOUTER";
            $namemodifierORadd = "additem";
            include "modifform.php";
        }
    
        if ((isset($_POST['openadditem'])) || (isset($_POST['openmodifitem']))) {
            ?>

<script type="text/javascript">
toogleForm('modif-popup');
</script>

<?php
$_SESSION['keepfiltre'] = true;
        }
    }
?>