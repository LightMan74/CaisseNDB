<?php
//session_start();
require_once "config.php";
function PopUpMsg($message)
{
    echo "<script>alert('$message');</script>";
}
$countcopypersistant = 0;
function countcopy()
{
    global $countcopypersistant;
    $countcopypersistant++;
}

$_POST = array_map("trim", $_POST);

if (isset($_POST['addfilter'])) {
    // $_SESSION["FILTRE-NOM"] = $_POST["FILTRE-NOM"];
    // $_SESSION["FILTRE-PRENOM"] = $_POST["FILTRE-PRENOM"];
    // $_SESSION["FILTRE-ADRESSE"] = $_POST["FILTRE-ADRESSE"];
    // $_SESSION["FILTRE-TELEPHONE"] = $_POST["FILTRE-TELEPHONE"];
    $_SESSION["FILTRE-IDGCM"] = $_POST["FILTRE-IDGCM"];
//$_SESSION["FILTRE-REFERENCE"] =  preg_replace('/\s+/', '%', $_SESSION["FILTRE-REFERENCE"]);
    //$_SESSION["FILTRE-REFERENCE"] =  str_replace(' ', '%', $_SESSION["FILTRE-REFERENCE"]);
} else {
    if (htmlspecialchars($_GET["nom"]) != "") {
        $_SESSION["FILTRE-NOM"] = htmlspecialchars($_GET["nom"]);
    }
    if (htmlspecialchars($_GET["prenom"]) != "") {
        $_SESSION["FILTRE-PRENOM"] = htmlspecialchars($_GET["prenom"]);
    }
    if (htmlspecialchars($_GET["adresse"]) != "") {
        $_SESSION["FILTRE-ADRESSE"] = htmlspecialchars($_GET["adresse"]);
    }
    if (htmlspecialchars($_GET["telephone"]) != "") {
        $_SESSION["FILTRE-TELEPHONE"] = htmlspecialchars($_GET["telephone"]);
    }
    if (htmlspecialchars($_GET["idgcm"]) != "") {
        $_SESSION["FILTRE-IDGCM"] =  htmlspecialchars($_GET["idgcm"]);
    }
    if (htmlspecialchars($_GET["id"]) != "") {
        $_SESSION["FILTRE-ID"]  = htmlspecialchars($_GET["id"]);
        //$_SESSION["FILTRE-IDURL"] = $_SESSION["FILTRE-ID"];
    }
    if ($_POST['contratin'] == 1){
        $_SESSION["FILTRE-APREVOIR"] = 0;
        $_SESSION["FILTRE-CONTRATIN"] = 0;
        $_SESSION["FILTRE-CONTRATOUT"] = 0;
        $_SESSION["FILTRE-CONTRATIN"] = 1;
    }
    elseif ($_POST['contratout'] == 1){
        $_SESSION["FILTRE-APREVOIR"] = 0;
        $_SESSION["FILTRE-CONTRATIN"] = 0;
        $_SESSION["FILTRE-CONTRATOUT"] = 0;
        $_SESSION["FILTRE-CONTRATOUT"] = 1;
    }
    elseif ($_POST['aprevoir'] == 1){
        $_SESSION["FILTRE-APREVOIR"] = 0;
        $_SESSION["FILTRE-CONTRATIN"] = 0;
        $_SESSION["FILTRE-CONTRATOUT"] = 0;
        $_SESSION["FILTRE-APREVOIR"] = 1;
    }
    else{
        $_SESSION["FILTRE-APREVOIR"] = 0;
        $_SESSION["FILTRE-CONTRATIN"] = 0;
        $_SESSION["FILTRE-CONTRATOUT"] = 0;
    }
}

if (isset($_POST['removefilter'])) {
    $_SESSION["FILTRE-NOM"] = "";
    $_SESSION["FILTRE-PRENOM"] = "";
    $_SESSION["FILTRE-ADRESSE"] = "";
    $_SESSION["FILTRE-TELEPHONE"] = "";
    $_SESSION["FILTRE-IDGCM"] = "";
    $_SESSION["FILTRE-ID"] = "";
    $_SESSION["FILTRE-IDURL"] = "";
    $_SESSION["FILTRE-APREVOIR"] = 0;
    $_SESSION["FILTRE-CONTRATIN"] = 0;
    $_SESSION["FILTRE-CONTRATOUT"] = 0;
}
function loadclients()
{
    global $countcopypersistant;
    $countfiltre = false;
    if ($_SESSION["FILTRE-NOM"] != "") {
        $wherecondition = "`NOM` LIKE '%" . $_SESSION["FILTRE-NOM"] . "%'";
        $countfiltre = true;
    }

    if ($_SESSION["FILTRE-PRENOM"] != "") {
        if ($countfiltre) {
            $wherecondition = $wherecondition . " AND";
        }
        $wherecondition = $wherecondition . " " . "`PRENOM` LIKE '%" . str_replace(' ', '%', $_SESSION["FILTRE-PRENOM"]) . "%'";
        $countfiltre = true;
    }

    if ($_SESSION["FILTRE-ADRESSE"] != "") {
        if ($countfiltre) {
            $wherecondition = $wherecondition . " AND";
        }
        $wherecondition = $wherecondition . " " . "Concat(`ADRESSE`,`CP`,`VILLE`) LIKE '%" . $_SESSION["FILTRE-ADRESSE"] . "%'";
        $countfiltre = true;
    }

    if ($_SESSION["FILTRE-TELEPHONE"] != "") {
        if ($countfiltre) {
            $wherecondition = $wherecondition . " AND";
        }
        $wherecondition = $wherecondition . " " . "`TELEPHONE` LIKE '%" . $_SESSION["FILTRE-TELEPHONE"] . "%'";
        $countfiltre = true;
    }
    
    if ($_SESSION["FILTRE-IDGCM"] != "") {
        if ($countfiltre) {
            $wherecondition = $wherecondition . " AND";
        }
        $wherecondition = $wherecondition . " " . "`IDGCM` LIKE '%" . $_SESSION["FILTRE-IDGCM"] . "%'";
        $countfiltre = true;
    }//$idget
    if ($_SESSION["FILTRE-ID"] != "") {
        if ($countfiltre) {
            $wherecondition = $wherecondition . " AND";
        }
        $wherecondition = $wherecondition . " " . "`ID` = " . $_SESSION["FILTRE-ID"];
        $countfiltre = true;
    }
    if ($_SESSION["FILTRE-NOM"] == "" && $_SESSION["FILTRE-PRENOM"] == "" && $_SESSION["FILTRE-ADRESSE"] == "" && $_SESSION["FILTRE-TELEPHONE"] == "" && $_SESSION["FILTRE-IDGCM"] == "" && $_SESSION["FILTRE-ID"] == "") {
        $wherecondition = "1";
    }
    
    //$_SESSION["FILTRE-ID"] = "";

    $wherecondition = $wherecondition . " " . "ORDER BY NOM ASC";
    $wherecondition = str_replace("*", "%", $wherecondition);

    if ($_POST['contratin'] || $_SESSION["FILTRE-CONTRATIN"]) 
    {
        echo "qsdfqsdf" . $_SESSION["FILTRE-CONTRATIN"];
        $wherecondition = "`etatcontrat` <> 'NON' AND `IDGCM` LIKE '%" . $_SESSION["FILTRE-IDGCM"] . "%' AND ";
        $wherecondition = $wherecondition . "concat(SUBSTR(`datecontrat`, 7, 4), SUBSTR(`datecontrat`, 4, 2), SUBSTR(`datecontrat`, 1, 2))" . " > " . date("Ymd");
        $wherecondition = $wherecondition . " " . "ORDER BY concat(SUBSTR(`datecontrat`, 7, 4), SUBSTR(`datecontrat`, 4, 2), SUBSTR(`datecontrat`, 1, 2)) ASC";
        $_SESSION["FILTRE-APREVOIR"] = 0;
        $_SESSION["FILTRE-CONTRATIN"] = 0;
        $_SESSION["FILTRE-CONTRATOUT"] = 0;
        $_SESSION["FILTRE-CONTRATIN"] = 1;
    }
    if ($_POST['contratout'] || $_SESSION["FILTRE-CONTRATOUT"]) {
        $wherecondition = "`etatcontrat` <> 'NON' AND `IDGCM` LIKE '%" . $_SESSION["FILTRE-IDGCM"] . "%' AND ";
        $wherecondition = $wherecondition . "concat(SUBSTR(`datecontrat`, 7, 4), SUBSTR(`datecontrat`, 4, 2), SUBSTR(`datecontrat`, 1, 2))" . " < " . date("Ymd");
        $wherecondition = $wherecondition . " " . "ORDER BY concat(SUBSTR(`datecontrat`, 7, 4), SUBSTR(`datecontrat`, 4, 2), SUBSTR(`datecontrat`, 1, 2)) DESC";
        $_SESSION["FILTRE-APREVOIR"] = 0;
        $_SESSION["FILTRE-CONTRATIN"]= 0 ;
        $_SESSION["FILTRE-CONTRATOUT"] = 0;
        $_SESSION["FILTRE-CONTRATOUT"] = 1;
    }
    if ($_POST['aprevoir'] || $_SESSION["FILTRE-APREVOIR"]) {
        $wherecondition = "Select *,`clients`.`id` FROM `clients`,`interventions` WHERE `clients`.`idgcm` = `interventions`.`idgcm` And `interventions`.`prevoirinter`=1 And `interventions`.`prevoirnext`=0";
        //$wherecondition = $wherecondition . "concat(SUBSTR(`datecontrat`, 7, 4), SUBSTR(`datecontrat`, 4, 2), SUBSTR(`datecontrat`, 1, 2))" . " < " . date("Ymd");
        //$wherecondition = $wherecondition . " " . "ORDER BY concat(SUBSTR(`datecontrat`, 7, 4), SUBSTR(`datecontrat`, 4, 2), SUBSTR(`datecontrat`, 1, 2)) DESC";
        $_SESSION["FILTRE-APREVOIR"] = 0;
        $_SESSION["FILTRE-CONTRATIN"] = 0;
        $_SESSION["FILTRE-CONTRATOUT"] = 0;
        $_SESSION["FILTRE-APREVOIR"] = 1;
    }



    // $wherecondition = "SELECT `datecontrat` ,CONCAT (`nom`, ' ', `prenom`, ' ', `adresse`, ' ', `cp`, ' ', `ville`), concat (SUBSTR(`datecontrat`, 7, 4), SUBSTR(`datecontrat`, 4, 2), SUBSTR(`datecontrat`, 1, 2)), `etatrappel` FROM `clients` WHERE `etatcontrat`= 'OUI' and concat (SUBSTR(`datecontrat`, 7, 4), SUBSTR(`datecontrat`, 4, 2), SUBSTR(`datecontrat`, 1, 2))" ' > '20200522'"
    // If depasse Then
    //     sql += " <= "
    // Else
    //     sql += " > "
    // End If

    // sql += DateTime.Now.ToString("yyyyMMdd")
    //}
    
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $conninter = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // Check connection
    if (!$conn) {
        $msg = "Connection failed: " . mysqli_connect_error();
        die($msg);
        PopUpMsg($msg);
    }

    if (str_starts_with($wherecondition, 'Select ')){
$sql = $wherecondition;
    }else{
        $sql = "SELECT * FROM `clients` WHERE " . $wherecondition; //1 ORDER BY `idgcm` ASC";//"SELECT * FROM stock";
    }


    if ($wherecondition != "1" . " " . "ORDER BY NOM ASC") {
        $result = mysqli_query($conn, $sql);
    } else {
        echo "MODE MOBILE";
        echo "</br>";
    }
    //"SELECT * FROM stock";
    // echo $sql;
    echo "</br>";

    if (mysqli_num_rows($result) > 0) {
        ?>
<table id="searchtable" class="blueTable tableFixHead">
    <thead>
        <tr>
            <th>
                <font>OPTION</font>
            </th>
            <th>
                <font>NOM</font>
            </th>
            <th>
                <font>PRENOM</font>
            </th>
            <th>
                <font>ADRESSE</font>
            </th>
            <th>
                <font>TELEPHONE</font>
            </th>
            <?php if ($_SESSION["FILTRE-CONTRATIN"] || $_SESSION["FILTRE-CONTRATOUT"]) {
            echo "<th>";
            echo "<font>DATE CONTRAT</font>";
            echo "</th>";
        } ?>
        </tr>
    </thead>
    <tbody>
        <?php

        while ($row = mysqli_fetch_assoc($result)) {
            ?>

        <tr <?php
                    if ($row["etatrappel"] == 1) {
                        echo 'style="background-color:lightgreen"';
                    }
            if ($row["etatrappel"] == 2) {
                echo 'style="background-color:yellow"';
            } ?>>
            <?php
$idgcm = $row["idgcm"];
            $sqlinter = "SELECT * FROM `interventions` WHERE `idgcm`=" . "\"" . $idgcm . "\""; ?>
            <th>
                <?php $text = $row["nom"] . " " . $row["prenom"] . " " . $row["adresse"] . " " . $row["cp"] . " " . $row["ville"] . " *" . $row["telephone"] . "* " . 'https://gcmw.lmbruleurs.fr/liste.php?id=' . $row["id"] ;
            countcopy(); ?>
                <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
                    <input name="ID" type="text" maxlength="255" value="<?php echo $row["id"]; ?>"
                        style="display:none" />
                    <input class="btn btn-warning" type="submit" name="viewitem" value="VOIR" />
                </form>

                <p id="c<?php echo $countcopypersistant; ?>" style="display:none;"><?php echo $text; ?></p>
                <input class="btn btn-good" value="COPY"
                    onclick="copyToClipboard('#c<?php echo $countcopypersistant; ?>')">

            </th>
            <th><?php echo $row["nom"] ?></th>
            <th><?php echo $row["prenom"] ?></th>
            <th><?php echo $row["adresse"] . " " . $row["cp"] . " " . $row["ville"] ?></th>
            <th><?php echo $row["telephone"] ?></th>
            <?php if ($_SESSION["FILTRE-CONTRATIN"] || $_SESSION["FILTRE-CONTRATOUT"]) {
                echo "<th>";
                echo $row["datecontrat"];
                echo "</th>";
            } ?>
        </tr>

        <?php
        } ?>
    </tbody>
    <tfoot id=" footer">
        <tr>
            <th>
                <font>OPTION</font>
            </th>
            <th>
                <font>NOM</font>
            </th>
            <th>
                <font>PRENOM</font>
            </th>
            <th>
                <font>ADRESSE</font>
            </th>
            <th>
                <font>TELEPHONE</font>
            </th>
            <?php if ($_SESSION["FILTRE-CONTRATIN"] || $_SESSION["FILTRE-CONTRATOUT"]) {
            echo "<th>";
            echo "<font>DATE CONTRAT</font>";
            echo "</th>";
        } ?>
        </tr>
    </tfoot>
</table>
<?php
    }
}
?>