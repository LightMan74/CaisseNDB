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
echo "</br>";

    $result = mysqli_query($conn, $sql);

    //"SELECT * FROM stock";

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
<table id="searchtable" class="blueTable tableFixHead">
    <thead>
        <tr>
            <th>
                <font>Nom</font>
            </th>
            <th>
                <font>Prenom</font>
            </th>
            <th>
                <font>Adresse</font>
            </th>
            <th>
                <font>Code Postal</font>
            </th>
            <th>
                <font>Ville</font>
            </th>
            <th>
                <font>Coord GPS (Tech)</font>
            </th>
            <th>
                <font>Coord GPS</font>
            </th>
            <th>
                <font>Telephone</font>
            </th>
            <th>
                <font>Email</font>
            </th>
            <th>
                <font>Remarque</font>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php
            $idgcm = $row["idgcm"];
            $sqlinter = "SELECT * FROM `interventions` WHERE `idgcm`=" . "\"" . $idgcm . "\"" . "ORDER BY SUBSTR(`dateintervention`, 7, 4) DESC, SUBSTR(`dateintervention`, 4, 2) DESC, SUBSTR(`dateintervention`, 1, 2) DESC"; ?>
            <th><?php echo $row["nom"] ?></th>
            <th><?php echo $row["prenom"] ?></th>
            <th><?php echo $row["adresse"] ?></th>
            <th><?php echo $row["cp"] ?></th>
            <th><?php echo $row["ville"] ?></th>
            <th><?php echo $row["coordgps"] ?></th>
            <th><?php echo $row["latitude"] . ', ' . $row["longitude"] ?></th>
            <th><?php echo $row["telephone"] ?></th>
            <th><?php echo $row["email"] ?></th>
            <th><?php echo $row["remarque"] ?></th>
        </tr>
    </tbody>
</Table>

<table id="searchtable" class="blueTable tableFixHead">
    <thead>
        <tr>
            <th>
                <font>Adresse Facturation</font>
            </th>
            <th>
                <font>Infos Client</font>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th><?php echo $row["adressefacturation"] ?></th>
            <th><?php echo $row["infosclient"] ?></th>
        </tr>
    </tbody>
</Table>
<table id="searchtable" class="blueTable tableFixHead">
    <thead>
        <tr>
            <th>
                <font>Etat Rappel</font>
            </th>
            <th>
                <font>Rappel Date</font>
            </th>
            <th>
                <font>Etat Contrat</font>
            </th>
            <th>
                <font>Date Contrat</font>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th <?php
                    if ($row["etatrappel"] == 1) {
                        echo 'style="background-color:lightgreen"';
                    }
            if ($row["etatrappel"] == 2) {
                echo 'style="background-color:yellow"';
            } ?>><?php echo etatrappelstring($row["etatrappel"]) ?></th>
            <th><?php echo $row["rdvupdate"] ?></th>
            <th><?php echo $row["etatcontrat"] ?></th>
            <th><?php echo $row["datecontrat"] ?></th>
        </tr>
    </tbody>
</Table>
<table id="searchtable" class="blueTable tableFixHead">
    <thead>
        <tr>
            <th>
                <font>Energie</font>
            </th>
            <th>
                <font>Pré Filtre</font>
            </th>
            <th>
                <font>Emetteurs</font>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th><?php echo $row["energie"] ?></th>
            <th><?php echo $row["prefiltre"] ?></th>
            <th><?php echo $row["emetteurs"] ?></th>
        </tr>
    </tbody>
</Table>
<table id="searchtable" class="blueTable tableFixHead">
    <thead>
        <tr>
            <th>
                <font>Marque Chaudiere</font>
            </th>
            <th>
                <font>Type Chaudiere</font>
            </th>
            <th>
                <font>Numero Chaudiere</font>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th><?php echo $row["marquechaudiere"] ?></th>
            <th><?php echo $row["modelchaudiere"] ?></th>
            <th><?php echo $row["numerochaudiere"] ?></th>
        </tr>
    </tbody>
</Table>
<table id="searchtable" class="blueTable tableFixHead">
    <thead>
        <tr>
            <th>
                <font>Marque Bruleur</font>
            </th>
            <th>
                <font>Type Bruleur</font>
            </th>
            <th>
                <font>Numero Bruleur</font>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th><?php echo $row["marquebruleur"] ?></th>
            <th><?php echo $row["modelbruleur"] ?></th>
            <th><?php echo $row["numerobruleur"] ?></th>
        </tr>
    </tbody>
</Table>
<table id="searchtable" class="blueTable tableFixHead">
    <thead>
        <tr>
            <th>
                <font>Marque Regulation</font>
            </th>
            <th>
                <font>Type Regulation</font>
            </th>
            <th>
                <font>Numero Regulation</font>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th><?php echo $row["marqueregulation"] ?></th>
            <th><?php echo $row["modelregulation"] ?></th>
            <th><?php echo $row["numeroregulation"] ?></th>
        </tr>
    </tbody>
</Table>
<?php
$text = $row["nom"] . " " . $row["prenom"] . " " . $row["adresse"] . " " . $row["cp"] . " " . $row["ville"] . " *" . $row["telephone"] . "*" ;
        }
    }
    //echo $sqlinter;
    $resultinter = mysqli_query($conninter, $sqlinter);
    if (mysqli_num_rows($resultinter) > 0) {
        ?>


<table id="searchtable" class="blueTable tableFixHead">
    <thead>
        <tr>
            <th colspan="9">
                <font>Intervention</font>
            </th>
        </tr>
        <tr>
            <th>
                <font>Intervention</font>
            </th>
            <th>
                <font>Facturation</font>
            </th>
            <th>
                <font>Facture N°</font>
            </th>
            <th>
                <font>Montant</font>
            </th>
            <th>
                <font>Paye</font>
            </th>
            <th>
                <font>Pieces</font>
            </th>
            <th>
                <font>Commentaire</font>
            </th>
            <th>
                <font>Technicien</font>
            </th>
            <th>
                <font>Type</font>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
while ($rowinter = mysqli_fetch_assoc($resultinter)) {
            ?>
        <tr <?php
                    if ($rowinter["prevoirnext"] == 1) {
                        echo 'style="background-color:yellow"';
                    }
            if ($rowinter["prevoirinter"] == 1) {
                echo 'style="background-color:red"';
            } ?>>
            <th>
                <?php echo $rowinter["dateintervention"]?>
            </th>
            <th>
                <?php echo $rowinter["datefacturation"] ?>
            </th>
            <th>
                <?php echo $rowinter["facturenumber"] ?>
            </th>
            <th>
                <?php echo $rowinter["montant"] ?>
            </th>
            <th>
                <?php echo $rowinter["paye"] ?>
            </th>
            <th>
                <?php echo $rowinter["pieces"] ?>
            </th>
            <th>
                <?php echo $rowinter["commentaire"] ?>
            </th>
            <th>
                <?php echo $rowinter["technicien"] ?>
            </th>
            <th>
                <?php echo $rowinter["type"] ?>
            </th>
        </tr>

        <?php
        } ?>
    </tbody>
</Table>
<?php
    } ?>
</div>
</div>

<?php
global $text;
    countcopy(); ?>
</br></br>
<p id="c1" style="display:none;"><?php echo $text . ' https://gcmw.lmbruleurs.fr/liste.php?id=' . $id; ?></p>
<input class="btn btn-good" value="COPY" onclick="copyToClipboard('#c1')">

</br></br></br>

<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
    <input style="display:none" name="ID" type="text" maxlength="255" value="<?php echo $id; ?>" />
    <input class="btn btn-warning" name="MODIFIER" value="MODIFIER" type="submit">
</form>

</br></br></br>

<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post" target="_blank">
    <input style="display:none" name="ID" type="text" maxlength="255" value="<?php echo $id; ?>" />
    <input class="btn btn-danger" name="GENERERPDF" value="GENERER PDF" type="submit">
</form>

<?php
}

function etatrappelstring($etat)
{
    switch ($etat) {
        case 1:
            return "RDV OK";
        break;
        case 2:
            return "MESS OK";
        break;
        default:
            return "RIEN";
        break;
    }
}
?>