<?php
//session_start();
require_once "config.php";
$text;
function modifintervention()
{
    ?>
<script>
function energiechange(cb, el) {
    var combo = document.getElementById(cb);
    var element = document.getElementById(el);
    if (combo.value == "AUTRE") {
        element.style.display = "block";
    } else {
        element.style.display = "none";
    }
    element.value = combo.value;
}
</script>
<?php
    global $text;
    if ($_POST["ID"] != "") {
        $id = $_POST["ID"];
    } else {
        $id = $_SESSION["FILTRE-ID"];
    }

    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $conninter = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $connconfig = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check connection
    if (!$conn) {
        $msg = "Connection failed: " . mysqli_connect_error();
        die($msg);
        PopUpMsg($msg);
    }

    $sql = "SELECT * FROM `clients` WHERE `id` = '" . $id . "'";
    if (htmlspecialchars($_GET["addc"]) == "true") {
        $sql = "SELECT * FROM `clients` WHERE `id` = '1'";
    }

    $_SESSION["FILTRE-ID"] = "";


    $marquecb = array();
    $energiecb = array();
    $prefiltrecb = array();
    $emetteurcb = array();
    $infosclientcb = array();
    $sqlconfig = "SELECT `MARQUE`,`ENERGIE`,`PREFILTRE`,`EMETTEUR`,`INFORMATIONCLIENT` FROM `config` WHERE 1";
    $resultconfig = mysqli_query($connconfig, $sqlconfig);
    if (mysqli_num_rows($resultconfig) > 0) {
        while ($rowconfig = mysqli_fetch_assoc($resultconfig)) {
            $marquecb[] = $rowconfig["MARQUE"];
            $energiecb[] = $rowconfig["ENERGIE"];
            $prefiltrecb[] = $rowconfig["PREFILTRE"];
            $emetteurcb[] = $rowconfig["EMETTEUR"];
            $infosclientcb[] = $rowconfig["INFORMATIONCLIENT"];
        }
        $marquecb = array_filter($marquecb);
        $energiecb = array_filter($energiecb);
        $prefiltrecb = array_filter($prefiltrecb);
        $emetteurcb = array_filter($emetteurcb);
        $infosclientcb = array_filter($infosclientcb);
    }
    // print_r($marquecb);
    // print_r($energiecb);
    // print_r($prefiltrecb);
    // print_r($emetteurcb);
    // print_r($infosclientcb);

    // echo $sql;
    $result = mysqli_query($conn, $sql);

    //"SELECT * FROM stock";

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
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
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
      $idgcm = $row["idgcm"];
            $sqlinter = "SELECT * FROM `interventions` WHERE `idgcm`=" . "\"" . $idgcm . "\"" . "ORDER BY SUBSTR(`dateintervention`, 7, 4) DESC, SUBSTR(`dateintervention`, 4, 2) DESC, SUBSTR(`dateintervention`, 1, 2) DESC"; ?>
                <th><input name="nom" value="<?php echo $row["nom"] ?>" /></th>
                <th><input name="prenom" value="<?php echo $row["prenom"] ?>" /></th>
                <th><input name="adresse" value="<?php echo $row["adresse"] ?>" /></th>
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
                <th>
                    <font>Coord GPS (Tech)</font>
                </th>
            </tr>
        <tbody>
            <tr>

                <th><input name="cp" value="<?php echo $row["cp"] ?>" /></th>
                <th><input name="ville" value="<?php echo $row["ville"] ?>" /></th>
                <th><input name="coordgps" value="<?php echo $row["coordgps"] ?>" /></th>
            </tr>
        </tbody>
    </Table>
    <table id="searchtable" class="blueTable tableFixHead">
        <thead>
            <tr>
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


                <th><input name="telephone" value="<?php echo $row["telephone"] ?>" /></th>
                <th><input name="email" value="<?php echo $row["email"] ?>" /></th>
                <th><input name="remarque" value="<?php echo $row["remarque"] ?>" /></th>
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
                <th><input name="adressefacturation" value="<?php echo $row["adressefacturation"] ?>" /></th>
                <th>
                    <!-- <input name="infosclient" value="<?php echo $row["infosclient"] ?>" /> -->
                    <select name="infoscliente0" id="cbinfosclient"
                        onchange="energiechange('cbinfosclient','autreinfosclient')">
                        <option value="<?php echo $row["infosclient"] ?>" selected>
                            <?php echo $row["infosclient"] ?>
                        </option>
                        <?php
                        foreach ($infosclientcb as $it) {
                            echo '<option value="'.$it.'">'.$it.'</option>';
                        } ?>
                        <option value=""></option>
                        <option value="AUTRE">AUTRE</option>
                    </select>
                    <input name="infosclient" id="autreinfosclient" value="<?php echo $row["infosclient"] ?>"
                        style="display:none;" />
                </th>
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
                <th> <select name="etatrappel">
                        <option value="0" <?php if ($row['etatrappel'] == "0") {
                            echo 'selected';
                        } ?>>RIEN
                        </option>
                        <option value="1" <?php if ($row['etatrappel'] == "1") {
                            echo 'selected';
                        } ?>>RDV OK
                        </option>
                        <option value="2" <?php if ($row['etatrappel'] == "2") {
                            echo 'selected';
                        } ?>>MESS OK
                        </option>
                    </select> </th>

                <th><?php echo $row["rdvupdate"] ?></th>

                <th><select name="etatcontrat">
                        <option value="OUI" <?php if ($row['etatcontrat'] == "OUI") {
                            echo 'selected';
                        } ?>>OUI
                        </option>
                        <option value="NON" <?php if ($row['etatcontrat'] == "NON") {
                            echo 'selected';
                        } ?>>NON
                        </option>
                    </select>
                </th>
                <th>

                    <?php

          function checkma($AorM, $ref, $date)
          {
              if ($AorM == 'mois') {
                  if (sdcmois($date) == $ref) {
                      echo 'selected';
                  }
              }
              if ($AorM == 'annee') {
                  if (sdcannee($date) == $ref) {
                      echo 'selected';
                  }
              }
          }

            function sdcmois($date)
            {
                //$date = $ref; // $row["datecontrat"];
                switch (explode("/", $date)[1]) {
              case '01':
                return '01';
              break;
              case '02':
                return '02';
              break;
              case '03':
                return '03';
              break;
              case '04':
                return '04';
              break;
              case '05':
                return '05';
              break;
              case '06':
                return '06';
              break;
              case '07':
                return '07';
              break;
              case '08':
                return '08';
              break;
              case '09':
                return '09';
              break;
              case '10':
                return '10';
              break;
              case '11':
                return '11';
              break;
              case '12':
                return '12';
              break;
              default:
                return '01';
              break;
            }
            }

            function sdcannee($date)
            {
                //$date = $ref; // $row["datecontrat"];

                switch (explode("/", $date)[2]) {
              case '2017':
                return '2017';
              break;
              case '2018':
                return '2018';
              break;
              case '2019':
                return '2019';
              break;
              case '2020':
                return '2020';
              break;
              case '2021':
                return '2021';
              break;
              case '2022':
                return '2022';
              break;
              case '2023':
                return '2023';
              break;
              case '2024':
                return '2024';
              break;
              case '2025':
                return '2025';
              break;
              case '2026':
                return '2026';
              break;
              default:
                return '2017';
              break;
            }
            }
            $date = $row["datecontrat"]; ?>

                    01 /
                    <select name="mois" class="textdate">
                        <option value="01" <?php checkma('mois', '01', $date); ?>>JANVIER
                        </option>
                        <option value="02" <?php checkma('mois', '02', $date); ?>>FEVRIER
                        </option>
                        <option value="03" <?php checkma('mois', '03', $date); ?>>MARS
                        </option>
                        <option value="04" <?php checkma('mois', '04', $date); ?>>AVRIL
                        </option>
                        <option value="05" <?php checkma('mois', '05', $date); ?>>MAI
                        </option>
                        <option value="06" <?php checkma('mois', '06', $date); ?>>JUIN
                        </option>
                        <option value="07" <?php checkma('mois', '07', $date); ?>>JUILLET
                        </option>
                        <option value="08" <?php checkma('mois', '08', $date); ?>>AOUT
                        </option>
                        <option value="09" <?php checkma('mois', '09', $date); ?>>SEPTEMBRE
                        </option>
                        <option value="10" <?php checkma('mois', '10', $date); ?>>OCTOBRE
                        </option>
                        <option value="11" <?php checkma('mois', '11', $date); ?>>NOVEMBRE
                        </option>
                        <option value="12" <?php checkma('mois', '12', $date); ?>>DECEMBRE
                        </option>
                    </select>
                    /
                    <select name="annee" class="textdate">
                        <option value="2016" <?php checkma('annee', '2016', $date); ?>>2016
                        </option>
                        <option value="2017" <?php checkma('annee', '2017', $date); ?>>2017
                        </option>
                        <option value="2018" <?php checkma('annee', '2018', $date); ?>>2018
                        </option>
                        <option value="2019" <?php checkma('annee', '2019', $date); ?>>2019
                        </option>
                        <option value="2020" <?php checkma('annee', '2020', $date); ?>>2020
                        </option>
                        <option value="2021" <?php checkma('annee', '2021', $date); ?>>2021
                        </option>
                        <option value="2022" <?php checkma('annee', '2022', $date); ?>>2022
                        </option>
                        <option value="2023" <?php checkma('annee', '2023', $date); ?>>2023
                        </option>
                        <option value="2024" <?php checkma('annee', '2024', $date); ?>>2024
                        </option>
                        <option value="2025" <?php checkma('annee', '2025', $date); ?>>2025
                        </option>
                        <option value="2026" <?php checkma('annee', '2026', $date); ?>>2026
                        </option>
                    </select>

                    <!-- <input name="datecontrat" value="<?php echo $row["datecontrat"] ?>" /> -->
                </th>

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
                <th><select name="energie0" id="cbenergie" onchange="energiechange('cbenergie','autreenergie')">
                        <option value="<?php echo $row["energie"] ?>" selected><?php echo $row["energie"] ?></option>
                        <?php
                        foreach ($energiecb as $it) {
                            echo '<option value="'.$it.'">'.$it.'</option>';
                        } ?>
                        <option value=""></option>
                        <option value="AUTRE">AUTRE</option>
                    </select>
                    <input name="energie" id="autreenergie" value="<?php echo $row["energie"] ?>"
                        style="display:none;" />
                </th>
                <th>
                    <!-- <input name="prefiltre" value="<?php echo $row["prefiltre"] ?>" /> -->
                    <select name="prefiltre0" id="cbprefiltre" onchange="energiechange('cbprefiltre','autreprefiltre')">
                        <option value="<?php echo $row["prefiltre"] ?>" selected><?php echo $row["prefiltre"] ?>
                        </option>
                        <?php
                        foreach ($prefiltrecb as $it) {
                            echo '<option value="'.$it.'">'.$it.'</option>';
                        } ?>
                        <option value=""></option>
                        <option value="AUTRE">AUTRE</option>
                    </select>
                    <input name="prefiltre" id="autreprefiltre" value="<?php echo $row["prefiltre"] ?>"
                        style="display:none;" />
                </th>
                <th>
                    <!-- <input name="emetteur" value="<?php echo $row["emetteurs"] ?>" /></th> -->
                    <select name="emetteur0" id="cbemetteur" onchange="energiechange('cbemetteur','autreemetteur')">
                        <option value="<?php echo $row["emetteurs"] ?>" selected><?php echo $row["emetteurs"] ?>
                        </option>
                        <?php
                        foreach ($emetteurcb as $it) {
                            echo '<option value="'.$it.'">'.$it.'</option>';
                        } ?>
                        <option value=""></option>
                        <option value="AUTRE">AUTRE</option>
                    </select>
                    <input name="emetteur" id="autreemetteur" value="<?php echo $row["emetteurs"] ?>"
                        style="display:none;" />
                </th>
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
                <th>
                    <!-- <input name="marquechaudiere" value="<?php echo $row["marquechaudiere"] ?>"/>  -->
                    <select name="marquechaudiere0" id="cbmarquechaudiere"
                        onchange="energiechange('cbmarquechaudiere','autremarquechaudiere')">
                        <option value="<?php echo $row["marquechaudiere"] ?>" selected>
                            <?php echo $row["marquechaudiere"] ?></option>
                        <?php
                        foreach ($marquecb as $it) {
                            echo '<option value="'.$it.'">'.$it.'</option>';
                        } ?>
                        <option value=""></option>
                        <option value="AUTRE">AUTRE</option>
                    </select>
                    <input name="marquechaudiere" id="autremarquechaudiere"
                        value="<?php echo $row["marquechaudiere"] ?>" style="display:none;" />
                </th>
                <th><input name="modelchaudiere" value="<?php echo $row["modelchaudiere"] ?>" />
                </th>
                <th><input name="numerochaudiere" value="<?php echo $row["numerochaudiere"] ?>" />
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
                <th>
                    <!-- <input name="marquebruleur" value="<?php echo $row["marquebruleur"] ?>" /> -->
                    <select name="marquebruleur0" id="cbmarquebruleur"
                        onchange="energiechange('cbmarquebruleur','autremarquebruleur')">
                        <option value="<?php echo $row["marquebruleur"] ?>" selected>
                            <?php echo $row["marquebruleur"] ?></option>
                        <?php
                        foreach ($marquecb as $it) {
                            echo '<option value="'.$it.'">'.$it.'</option>';
                        } ?>
                        <option value=""></option>
                        <option value="AUTRE">AUTRE</option>
                    </select>
                    <input name="marquebruleur" id="autremarquebruleur" value="<?php echo $row["marquebruleur"] ?>"
                        style="display:none;" />
                </th>
                <th><input name="modelbruleur" value="<?php echo $row["modelbruleur"] ?>" />
                </th>
                <th><input name="numerobruleur" value="<?php echo $row["numerobruleur"] ?>" />
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
                <th>
                    <!-- <input name="marqueregulation" value="<?php echo $row["marqueregulation"] ?>" /> -->
                    <select name="marqueregulation0" id="cbmarqueregulation"
                        onchange="energiechange('cbmarqueregulation','autremarqueregulation')">
                        <option value="<?php echo $row["marqueregulation"] ?>" selected>
                            <?php echo $row["marqueregulation"] ?>
                        </option>
                        <?php
                        foreach ($marquecb as $it) {
                            echo '<option value="'.$it.'">'.$it.'</option>';
                        } ?>
                        <option value=""></option>
                        <option value="AUTRE">AUTRE</option>
                    </select>
                    <input name="marqueregulation" id="autremarqueregulation"
                        value="<?php echo $row["marqueregulation"] ?>" style="display:none;" />
                </th>
                <th><input name="modelregulation" value="<?php echo $row["modelregulation"] ?>" />
                </th>
                <th><input name="numeroregulation" value="<?php echo $row["numeroregulation"] ?>" />
                </th>
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
            <tr>
                <th>
                    <?php echo $rowinter["dateintervention"] ?>
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
    </br></br></br>

    <input style="display:none" id="element_6" name="ID" class="element text medium" type="text" maxlength="255"
        value="<?php echo $id; ?>" />
    <input class="btn btn-warning" name="<?php if (htmlspecialchars($_GET["addc"]) == "true") {
        echo 'ADDITEM';
    } else {
        echo 'MODIFIERITEM';
    } ?>" value="<?php if (htmlspecialchars($_GET["addc"]) == "true") {
        echo 'AJOUTER';
    } else {
        echo 'MODIFIER';
    } ?>" type="submit">
</form>

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

    $prenom = str_replace("'", "\'", $_POST["prenom"]);
    $adresse = str_replace("'", "\'", $_POST["adresse"]);
    $cp = str_replace("'", "\'", $_POST["cp"]);
    $ville = str_replace("'", "\'", $_POST["ville"]);
    $coordgps = str_replace("'", "\'", $_POST["coordgps"]);
    $telephone = str_replace("'", "\'", $_POST["telephone"]);
    $email = str_replace("'", "\'", $_POST["email"]);
    $remarque = str_replace("'", "\'", $_POST["remarque"]);
    $adressefacturation = str_replace("'", "\'", $_POST["adressefacturation"]);
    $infosclient = str_replace("'", "\'", $_POST["infosclient"]);
    $etatcontrat = str_replace("'", "\'", $_POST["etatcontrat"]);
    $etatrappel = str_replace("'", "\'", $_POST["etatrappel"]);
    //$datecontrat = str_replace("'", "\'", $_POST["datecontrat"]);
  $datecontrat = '01/' . $_POST["mois"] . '/' . $_POST["annee"];//str_replace("'", "\'", $_POST["datecontrat"]);
  $energie = str_replace("'", "\'", $_POST["energie"]);
    $prefiltre = str_replace("'", "\'", $_POST["prefiltre"]);
    $emetteur = str_replace("'", "\'", $_POST["emetteur"]);
    $marquechaudiere = str_replace("'", "\'", $_POST["marquechaudiere"]);
    $modelchaudiere = str_replace("'", "\'", $_POST["modelchaudiere"]);
    $numerochaudiere = str_replace("'", "\'", $_POST["numerochaudiere"]);
    $marquebruleur = str_replace("'", "\'", $_POST["marquebruleur"]);
    $modelbruleur = str_replace("'", "\'", $_POST["modelbruleur"]);
    $numerobruleur = str_replace("'", "\'", $_POST["numerobruleur"]);
    $marqueregulation = str_replace("'", "\'", $_POST["marqueregulation"]);
    $modelregulation = str_replace("'", "\'", $_POST["modelregulation"]);
    $numeroregulation = str_replace("'", "\'", $_POST["numeroregulation"]);
    $idgcm = $nom . "$" . $prenom . "$" . $adresse . "$" . $cp . "$" . $ville;

    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // Check connection
    if (!$conn) {
        $msg = "Connection failed: " . mysqli_connect_error();
        die($msg);
        PopUpMsg($msg);
    }
    if ($AorM == "MODIFIERITEM") {
        $sql = "UPDATE `clients` SET `nom`='$nom',`prenom`='$prenom',`adresse`='$adresse',`cp`='$cp',`ville`='$ville',`coordgps`='$coordgps',`telephone`='$telephone',`email`='$email',`remarque`='$remarque',`adressefacturation`='$adressefacturation',`etatrappel`='$etatrappel',`infosclient`='$infosclient',`etatcontrat`='$etatcontrat',`datecontrat`='$datecontrat',`marquechaudiere`='$marquechaudiere',`modelchaudiere`='$modelchaudiere',`numerochaudiere`='$numerochaudiere',`marquebruleur`='$marquebruleur',`modelbruleur`='$modelbruleur',`numerobruleur`='$numerobruleur',`marqueregulation`='$marqueregulation',`modelregulation`='$modelregulation',`numeroregulation`='$numeroregulation',`energie`='$energie', `prefiltre`='$prefiltre',`emetteurs`='$emetteur' WHERE `id` = '$id'";
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

    mysqli_close($conn);


    include "voirfunc.php";
    loadintervention();
}




?>