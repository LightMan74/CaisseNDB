<script type="text/javascript">
function energiechange(el) {
    var element = document.getElementById(el);
    if (element.style.display = "none") {
        element.style.display = "contents";
    } else {
        element.style.display = "none";
    }

}
</script>
</script>
<?php
//session_start();
require_once "config.php";
$text;
function loadintervention()
{
    global $text;
    if ($_POST["ID"] != "") {
        $id = $_POST["ID"];
    } else {
        $id = $_SESSION["FILTRE-ID"];
    }
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $conninter = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // Check connection
    if (!$conn) {
        $msg = "Connection failed: " . mysqli_connect_error();
        die($msg);
        PopUpMsg($msg);
    }

    $sql = "SELECT * FROM `clients` WHERE `id` = '" . $id . "'";
    $_SESSION["FILTRE-ID"] = "";

    //echo $sql;
// echo "</br>";

    $result = mysqli_query($conn, $sql);

    //"SELECT * FROM stock";
?>
<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">

    <input class="btn btn-warning" type="button" name="MODIFIER" value="MODIFIER" onClick="energiechange('trchange')">

    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>

    <table id="searchtable" class="blueTable tableFixHead">
        <thead>
            <tr>
                <th>
                    <font>NOM</font>
                </th>
                <th>
                    <font>CREDIT</font>
                </th>
                <th>
                    <font>ID</font>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th><?php echo $row["nom"] ?></th>
                <th><?php echo $row["credit"] ?></th>
                <th><?php echo $row["id"] ?></th>
            </tr>
            <tr style="display:none" id="trchange">

                <th>
                    <input name="nom" class="element text medium" type="text" maxlength="255"
                        value="<?php echo $row["nom"] ?>" placeholder="NOUVEAU NOM" title="NOUVEAU NOM" />
                </th>

                <th><input id="creditadd" name="CREDITADD" class="element text medium" type="text" maxlength="255"
                        value="0" placeholder="CREDIT A AJOUTER" title="CREDIT A AJOUTER" onchange="ifcredit()" /></th>

                <th><?php echo "ID" ?></th>
            </tr>
        </tbody>
    </Table>

    <br><br>
    <input style="display:none" id="element_6" name="ID" class="element text medium" type="text" maxlength="255"
        value="<?php echo $id; ?>" />
    <input style="display:none" id="creditin" name="CREDIT" class="element text medium" type="text" maxlength="255"
        value="<?php echo $row["credit"]; ?>" />
    <input style="" id="creditbtn" class="btn btn-warning" name="<?php if (htmlspecialchars($_GET["addc"]) == "true") {
echo 'ADDITEM';
} else {
echo 'MODIFIERITEM';
} ?>" value="<?php if (htmlspecialchars($_GET["addc"]) == "true") {
echo 'AJOUTER';
} else {
echo 'PAYER CONSOMATIONS';
} ?>" type="submit">

    <?php include "itemliste.php"; ?>

</form>
<?php    
}
}

?>
<?php  
}

function getUpperPost($keepVar = true)
{
    $return_array = array();
    /* Edited on 4/1/2015 */
    foreach ($_POST as $postKey => $postVar) {
        $return_array[$postKey] = strtoupper(ltrim(rtrim($postVar, " "), " "));
    }
    if ($keepVar) {
        $_POST = $return_array;
    } else {
        return $return_array;
    }
}

function modifinterventionupdate($AorM)
{
    //$_POST = array_map("strtoupper", $_POST);

    getUpperPost();

    $id = $_POST["ID"];
    $nom = str_replace("'", "\'", $_POST["nom"]);
    $nom = trim($nom);

    if ($nom == "") {
        PopUpMsg("INDIQUER AU MOINS UN NOM !");
        exit ;
    }
    $creditadd = str_replace("'", "\'", $_POST["CREDITADD"]);
    $credit = str_replace("'", "\'", $_POST["CREDIT"]);
    echo  $credit;
    $conso = $_POST["conso"];
    echo  $conso;
    $credit = $credit - $conso + $creditadd;
    echo  $credit;

    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // Check connection
    if (!$conn) {
        $msg = "Connection failed: " . mysqli_connect_error();
        die($msg);
        PopUpMsg($msg);
    }
    if ($AorM == "MODIFIERITEM") {
        $sql = "UPDATE `clients` SET `nom` = '$nom',`credit`='$credit' WHERE `id` = '$id'";
        //echo $sql;
    }//$sql = str_replace("'", "\'", $sql);
    if ($AorM == "ADDITEM") {
        $sql = "INSERT INTO `clients`(`idgcm`, `nom`, `prenom`, `adresse`, `cp`, `ville`, `coordgps`, `telephone`, `email`, `remarque`, `adressefacturation`,`etatrappel`, `infosclient`, `etatcontrat`, `datecontrat`, `marquechaudiere`, `modelchaudiere`, `numerochaudiere`, `marquebruleur`, `modelbruleur`, `numerobruleur`, `marqueregulation`, `modelregulation`, `numeroregulation`, `energie`, `prefiltre`, `emetteurs`) VALUES ('$idgcm','$nom','$prenom','$adresse','$cp','$ville','$coordgps','$telephone','$email','$remarque','$adressefacturation','$etatrappel','$infosclient','$etatcontrat','$datecontrat','$marquechaudiere','$modelchaudiere','$numerochaudiere','$marquebruleur','$modelbruleur','$numerobruleur',' $marqueregulation','$modelregulation','$numeroregulation','$energie','$prefiltre','$emetteur')";
    }
    if (mysqli_query($conn, $sql)) {
        if ($AorM == "ADDITEM") {
            PopUpMsg("AJOUT EFFECTUER.");
        } else {
            PopUpMsg("MODIFICATION EFFECTUER.");
        }
    } else {
        PopUpMsg("Error: " . mysqli_error($conn));
    }
    $sqlogs = 'INSERT INTO `logs` (`user`, `action`) VALUES ("' . $_SESSION["username"] . '","' . $sql . '")';
    //echo '<br>';
    //echo $sqlogs;
    $ww = mysqli_query($conn, $sqlogs);
    mysqli_close($conn);


    // include "voirfunc.php";
    // loadintervention();
    ?>
<script type="text/javascript">
window.location.href = "liste.php?id=<?php echo $id; ?>";
</script>
<?php
}



 ?>