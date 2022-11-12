<script type="text/javascript" src="CSS_JS/signature.js"></script>
<script type="text/javascript">
function showSpoiler(obj) {
    var inner = obj.parentNode.getElementsByTagName("div")[0];
    if (inner.style.display == "none")
        inner.style.display = "";
    else
        inner.style.display = "none";
}
var hc1 = 0;
var hc2 = 0;
var hc3 = 0;
var hc4 = 0;

function handleChange() {
    hc1 = 1;
    handleChangeCheck();
}

function handleChange1() {
    hc2 = 1;
    handleChangeCheck();
}

function handleChange2() {
    hc3 = 1;
    handleChangeCheck();
}

function required() {
    var emptcount = 0;
    var empt = [document.forms["myForm"]["email1"].value, document.forms["myForm"]["fumee"].value, document.forms[
            "myForm"]["co2"].value, document.forms["myForm"]["co"].value, document.forms["myForm"]["o2"].value,
        document.forms["myForm"]["rendement"].value, document.forms["myForm"]["opacite"].value, document.forms[
            "myForm"]["nox"].value, document.forms["myForm"]["coamb"].value, document.forms["myForm"]["technicien"],
        document.forms["myForm"]["energie"]
        .value
    ];

    empt.forEach(function(em) {
        if (em != "") {
            emptcount = emptcount + 1;
        }
    });

    if (emptcount != 11) {
        alert("MERCI D'AJOUTER UNE ADRESSE EMAIL PRINCIPAL OU LA COMBUSTION");
        return false;
    } else {
        //alert('Code has accepted : you can try another');
        return true;
    }
}

function handleChangeCheck() {
    var element = document.getElementById('buttonpdf');
    if (hc1 == 1 && hc2 == 1 && hc3 == 1) {
        element.style.display = "";
    } else {
        element.style.display = "none";
    }
}

function hidesignature() {
    var element = document.getElementById('hidesignature');
    if (element.style.display == "") {
        element.style.display = "none";
    } else {
        element.style.display = "";
    }
}

function multifunc0() {
    hc3 = 0;
    hidesignature();
    handleChangeCheck();
}

function multifunc1() {
    hidesignature();
    handleChange2();
}

function multifunc2() {
    signatureSave();
    handleChange2();
}
</script>

<style>
@media print {
    #ghostery-tracker-tally {
        display: none !important
    }
}
</style>

<?php
session_start();
require_once "config.php";
$text;
function pdfclient()
{
    global $text;
    if ($_POST["ID"] != "") {
        $id = $_POST["ID"];
    } else {
        $id = $_SESSION["FILTRE-ID"];
    }

    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check connection
    if (!$conn) {
        $msg = "Connection failed: " . mysqli_connect_error();
        die($msg);
        PopUpMsg($msg);
    }

    $sql = "SELECT * FROM `clients` WHERE `id` = '" . $id . "'";
    if (htmlspecialchars($_GET["add"]) == "true") {
        $sql = "SELECT * FROM `clients` WHERE `id` = '1'";
    }


    $_SESSION["FILTRE-ID"] = "";


    echo $sql;
    $result = mysqli_query($conn, $sql);

    //"SELECT * FROM stock";

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
<form action="https://attestations.lmbruleurs.fr/attestation.php" name="myForm" method="post" target="_blank"
    onsubmit="return required()">
    <table id="searchtable" class="blueTable tableFixHead">
        <thead>
            <tr>
                <th>
                    <font>Nom Prenom</font>
                </th>
                <th>
                    <font>2eme Ligne</font>
                </th>
                <th>
                    <font>Adresse</font>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
            $idgcm = $row["idgcm"]; ?>
                <th><input style="width:100%;" name="nomprenom"
                        value="<?php echo $row["nom"] . " " . $row["prenom"] ?>" />
                    <input style="display:none;" name="nom" value="<?php echo $row["nom"] ?>" />
                    <input style="display:none;" name="prenom" value="<?php echo $row["prenom"] ?>" />
                </th>
                <th><input style="width:100%;" name="nomprenom2" value="" /></th>
                <th><input style="width:100%;" name="adresse" value="<?php echo $row["adresse"] ?>" /></th>
            </tr>
        </tbody>
    </Table>
    <table id="searchtable" class="blueTable tableFixHead">
        <thead>
            <tr>
                <th>
                    <font>Code Postal</font>
                </th>
                <th>
                    <font>Ville</font>
                </th>
            </tr>
        <tbody>
            <tr>
                <th><input style="width:100%;" name="cp" value="<?php echo $row["cp"] ?>" /></th>
                <th><input style="width:100%;" name="ville" value="<?php echo $row["ville"] ?>" /></th>
            </tr>
        </tbody>
    </Table>

    <table id="searchtable" class="blueTable tableFixHead">
        <thead>
            <tr>
                <th>
                    <font>Adresse chaufferie</font>
                </th>
                <th>
                    <font>Cp et ville chaufferie</font>
                </th>
                <th>
                    <font>Energie</font>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th><input style="width:100%;" name="adressechaufferie" value="" /></th>
                <th><input style="width:100%;" name="cpetvillechaufferie" value="" /></th>
                <th><input style="width:100%;" name="energie" value="<?php echo $row["energie"] ?>" /></th>
            </tr>
        </tbody>
    </Table>
    </br>
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
                <th><input style="width:100%;" name="marquechaudiere" value="<?php echo $row["marquechaudiere"] ?>" />
                </th>
                <th><input style="width:100%;" name="modelchaudiere" value="<?php echo $row["modelchaudiere"] ?>" />
                </th>
                <th><input style="width:100%;" name="numerochaudiere" value="<?php echo $row["numerochaudiere"] ?>" />
                </th>
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
                <th><input style="width:100%;" name="marquebruleur" value="<?php echo $row["marquebruleur"] ?>" />
                </th>
                <th><input style="width:100%;" name="modelbruleur" value="<?php echo $row["modelbruleur"] ?>" />
                </th>
                <th><input style="width:100%;" name="numerobruleur" value="<?php echo $row["numerobruleur"] ?>" />
                </th>
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
                <th><input style="width:100%;" name="marqueregulation" value="<?php echo $row["marqueregulation"] ?>" />
                </th>
                <th><input style="width:100%;" name="modelregulation" value="<?php echo $row["modelregulation"] ?>" />
                </th>
                <th><input style="width:100%;" name="numeroregulation" value="<?php echo $row["numeroregulation"] ?>" />
                </th>
            </tr>
        </tbody>
    </Table>
    </br>
    <center>
        <a onClick="showSpoiler(this);" value="Show/Hide">Conseils pour le bon usage de l’installation de chauffage, les
            améliorations possibles, l’intêret d’un éventuel remplacement</a>
        <div Class="inner" style="display: none;">

            <table id="searchtable" class="blueTable tableFixHead">
                <thead>
                    <tr>
                        <th>
                            <font>Le bon usage de l’installation de chauffage en place (Autre...)</font>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><input style="width:100%;" maxlength="50" name="autre1_1" value="" /></th>
                    </tr>
                    <tr>
                        <th><input style="width:100%;" maxlength="50" name="autre1_2" value="" /></th>
                    </tr>
                    <tr>
                        <th><input style="width:100%;" maxlength="50" name="autre1_3" value="" /></th>
                    </tr>
                    <tr>
                        <th><input style="width:100%;" maxlength="50" name="autre1_4" value="" /></th>
                    </tr>
                    <tr>
                        <th><input style="width:100%;" maxlength="50" name="autre1_5" value="" /></th>
                    </tr>
                </tbody>
            </Table>

            <table id="searchtable" class="blueTable tableFixHead">
                <thead>
                    <tr>
                        <th>
                            <font>Évolution ou remplacement de l’installation de chauffage (Autre...)</font>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><input style="width:100%;" maxlength="50" name="autre2_1" value="" /></th>
                    </tr>
                    <tr>
                        <th><input style="width:100%;" maxlength="50" name="autre2_2" value="" /></th>
                    </tr>
                    <tr>
                        <th><input style="width:100%;" maxlength="50" name="autre2_3" value="" /></th>
                    </tr>
                    <tr>
                        <th><input style="width:100%;" maxlength="50" name="autre2_4" value="" /></th>
                    </tr>
                    <tr>
                        <th><input style="width:100%;" maxlength="50" name="autre2_5" value="" /></th>
                    </tr>
                </tbody>
            </Table>

            <table id="searchtable" class="blueTable tableFixHead">
                <thead>
                    <tr>
                        <th>
                            <font>Les améliorations possibles de l’ensemble de l’installation
                                de chauffage (Autre...)</font>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><input style="width:100%;" maxlength="50" name="autre3_1" value="" /></th>
                    </tr>
                    <tr>
                        <th><input style="width:100%;" maxlength="50" name="autre3_2" value="" /></th>
                    </tr>
                    <tr>
                        <th><input style="width:100%;" maxlength="50" name="autre3_3" value="" /></th>
                    </tr>
                    <tr>
                        <th><input style="width:100%;" maxlength="50" name="autre3_4" value="" /></th>
                    </tr>
                    <tr>
                        <th><input style="width:100%;" maxlength="50" name="autre3_5" value="" /></th>
                    </tr>
                </tbody>
            </Table>
        </div>
    </center></br>
    <table id="searchtable" class="blueTable tableFixHead">
        <thead>
            <tr>
                <th>
                    <font>Fumée</font>
                </th>
                <th>
                    <font>Co2</font>
                </th>
                <th>
                    <font>Co</font>
                </th>
                <th>
                    <font>O2</font>
                </th>
                <th>
                    <font>Rendement</font>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th><input style="width:100%;" name="fumee" value="" /></th>
                <th><input style="width:100%;" name="co2" value="" /></th>
                <th><input style="width:100%;" name="co" value="" /></th>
                <th><input style="width:100%;" name="o2" value="" /></th>
                <th><input style="width:100%;" name="rendement" value="" /></th>
            </tr>
        </tbody>
    </Table>
    <table id="searchtable" class="blueTable tableFixHead">
        <thead>
            <tr>
                <th>
                    <font>Opacité</font>
                </th>
                <th>
                    <font>Nox</font>
                </th>
                <th>
                    <font>Co Ambiant</font>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th><input style="width:100%;" name="opacite" value="" /></th>
                <th><input style="width:100%;" name="nox" value="" /></th>
                <th><input style="width:100%;" name="coamb" value="" /></th>
            </tr>
        </tbody>
    </Table>
    </br>
    <table id="searchtable" class="blueTable tableFixHead">
        <thead>
            <tr>
                <th>
                    <font>Date</font>
                </th>
                <th>
                    <font>Date de prestation</font>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th><input style="width:100%;" name="date" value="<?php echo date("d/m/Y"); ?>" /></th>
                <th><input style="width:100%;" name="dateintervention" value="" /></th>
            </tr>
        </tbody>
    </Table>
    </br>
    <table id="searchtable" class="blueTable tableFixHead">
        <thead>
            <tr>
                <th colspan="2">
                    <font>Technicien</font>
                </th>
                <th colspan="2">
                    <font>Client Present</font>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <div class="radio">
                    <th><label for="radios-0">
                            <input type="radio" id="radios-0" name="technicien" value="Jean Philippe" <?php if (htmlspecialchars($_SESSION["username"]) == "jpm") {
                echo "checked";
            } ?>>
                            Jean Phillipe
                        </label></th>
                    <th><label for="radios-1">
                            <input type="radio" id="radios-1" name="technicien" value="William" <?php if (htmlspecialchars($_SESSION["username"]) == "william") {
                echo "checked";
            } ?>>
                            William
                        </label></th>
                </div>
                <div class="radio">
                    <th><label for="radios-2">
                            <input type="radio" id="radios-2" name="client" value="present" onchange="multifunc0()"
                                checked>
                            Client present
                        </label></th>
                    <th><label for="radios-3">
                            <input type="radio" id="radios-3" name="client" value="absent" onchange="multifunc1()">
                            Client absent
                        </label></th>
                </div>
            </tr>
        </tbody>
    </Table>
    </br>
    <table id="searchtable" class="blueTable tableFixHead">
        <thead>
            <tr>
                <th colspan="3">
                    <font>Proprietaire / Locataire / Autre</font>
                </th>
                <th colspan="3">
                    <font>10% / 5.5%</font>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <div class="radio">
                    <th><label for="radios-c1">
                            <input type="radio" id="radios-c1" name="PorL" value="propietaire"
                                onchange="handleChange();">
                            Propietaire
                        </label></th>
                    <th><label for="radios-c1.1">
                            <input type="radio" id="radios-c1.1" name="PorL" value="locataire"
                                onchange="handleChange()">
                            Locataire
                        </label></th>
                    <th><label for="radios-c1.2">
                            <input type="radio" id="radios-c1.2" name="PorL" value="autre" onchange="handleChange()">
                            Autre...<input style="width:100%;" name="autretext" value="" />
                        </label>
                    </th>
                </div>
                <div class="radio">
                    <th><label for="radios-c2">
                            <input type="radio" id="radios-c2" name="tva" value="10%" onchange="handleChange1()">
                            10%
                        </label></th>
                    <th><label for="radios-c2.1">
                            <input type="radio" id="radios-c2.1" name="tva" value="5.5%" onchange="handleChange1()">
                            5.5%
                        </label></th>
                    <th><label for="radios-c2.2">
                            <input type="radio" id="radios-c2.2" name="tva" value="NE"
                                onchange="handleChange1();handleChange();">
                            NON ELIGIBLE
                        </label></th>
                </div>
            </tr>
        </tbody>
    </Table>

    </br>
    <table id="searchtable" class="blueTable tableFixHead">
        <thead>
            <tr>
                <th>
                    <font>EMAIL PRINCIPAL</font>
                </th>
                <th>
                    <font>EMAIL SECONDAIRE</font>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th><input style="width:100%;" name="email1" value="<?php echo $row["email"]; ?>" /></th>
                <th><input style="width:100%;" name="email2" value="" /></th>
            </tr>
        </tbody>
    </Table>
    </br>
    <table id="searchtable" class="blueTable tableFixHead">
        <thead>
            <tr>
                <th>
                    <font>NOM DE LA PERSONNE PRESENTE</font>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th><input style="width:100%;" name="personne" value="" /></th>
            </tr>
        </tbody>
    </Table>

    <?php
        }
    } ?>

    </div>
    </div>

    </br></br></br>
    <center>
        <div id="hidesignature">
            <div id="canvas">
                <canvas class="roundCorners" id="newSignature"
                    style="position: relative; margin: 0; padding: 0; border: 1px solid #c4caac;" width="500"
                    height="500"></canvas>
            </div>

            <script>
            signatureCapture();
            </script>
            <button type="button" onclick="multifunc2()">Save signature</button>
            <button type="button" onclick="signatureClear()">Clear signature</button>
        </div>
        <br>
        <img style="display:none" id="saveSignature" alt="Saved image png" src="">
        <input style="display:none" name="signature" id="saveSignatureV" value="" />
    </center>
    </br></br></br>

    <input style="display:none" id="element_6" name="ID" class="element text medium" type="text" maxlength="255"
        value="<?php echo $id; ?>" />
    <input id="buttonpdf" style="width:100%;display:none;" class="btn btn-warning" name="generatedpdf"
        value="GENERER PDF" type="submit">
</form>

<?php
}

function generatedpdf()
{
    $id = $_POST["ID"];
    $nom =  str_replace("'", "\'", $_POST["nom"]);
    $nom = trim($nom);

    if ($nom == "") {
        PopUpMsg("INDIQUER AU MOINS UN NOM !");
        exit ;
    }

    $prenom =  str_replace("'", "\'", $_POST["prenom"]);
    $adresse =  str_replace("'", "\'", $_POST["adresse"]);
    $cp =  str_replace("'", "\'", $_POST["cp"]);
    $ville =  str_replace("'", "\'", $_POST["ville"]);
    $adressefacturation =  str_replace("'", "\'", $_POST["adressefacturation"]);
    $energie =  str_replace("'", "\'", $_POST["energie"]);
    $marquechaudiere =  str_replace("'", "\'", $_POST["marquechaudiere"]);
    $modelchaudiere =  str_replace("'", "\'", $_POST["modelchaudiere"]);
    $numerochaudiere =  str_replace("'", "\'", $_POST["numerochaudiere"]);
    $marquebruleur =  str_replace("'", "\'", $_POST["marquebruleur"]);
    $modelbruleur =  str_replace("'", "\'", $_POST["modelbruleur"]);
    $numerobruleur =  str_replace("'", "\'", $_POST["numerobruleur"]);
    $marqueregulation =  str_replace("'", "\'", $_POST["marqueregulation"]);
    $modelregulation = str_replace("'", "\'", $_POST["modelregulation"]);
    $numeroregulation =  str_replace("'", "\'", $_POST["numeroregulation"]);
}




?>