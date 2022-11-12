<link rel="stylesheet" type="text/css" href="CSS_JS/popup.css" media="all">
<link rel="stylesheet" type="text/css" href="CSS_JS/stockstyle.css" media="all">

<link rel="stylesheet" type="text/css" href="CSS_JS/styleappel.css" media="all">

<script type="text/javascript" src="CSS_JS/view.js"></script>

<script type="text/javascript" src="CSS_JS/popup.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

<script type="text/javascript" src="CSS_JS/table.js"></script>
<link rel="icon" type="image/png" sizes="32x32" href="https://lmbruleurs.fr/logo.ico">

<body>
    <?php
        session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
    ?>
    <script type="text/javascript">
    window.location.href = "login.php";
    </script>
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

getUpperPost();

        function dtc($data)
        {
            $output = $data;
            if (is_array($output)) {
                $output = implode(',', $output);
            }

            echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
        }
        include "listefunc.php";
    ?>

    <table id="123" class="blueTable tablenoFixHead" style="width: 100%;">
        <thead>
            <tr>
                <th colspan="11">

                    <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post" style="margin: 0;">
                        <input class="btn btn-outline-danger btnadd intable" id="addbutton" type="submit"
                            name="openadditem" value="AJOUTER" />
                    </form>

                </th>
            </tr>

            <tr>
                <form id="formfiltre" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post"
                    style="margin: 0;">
                    <th>
                        <input class="btn btn-outline-danger btnadd intable" id="searchfilter" type="submit"
                            name="addfilter" value="FILTRER" />
                    </th>
                    <th>
                        <div class="checkbox">
                            <input type="checkbox" name="FILTRE-FAV" id="FILTRE-FAV1" value="1"
                                onchange="$('#formfiltre').submit();" <?php if ($_SESSION["FILTRE-FAV"] >= "1") {
        echo 'checked';
    }; ?>>
                            A COMMANDÉ<br>
                            <?php if ($_SESSION["FILTRE-FAV"] >= "1") {
        echo '<input type="checkbox" name="FILTRE-FAV" id="FILTRE-FAV2" value="2" onchange="$(\'#formfiltre\').submit();"';
        if ($_SESSION["FILTRE-FAV"] >= "2") {
            echo "checked";
        }
        echo '>COMMANDÉ';
    }?>

                        </div>
                    </th>
                    <th>
                        <input style="width:75%; height: 3vh; text-align: center;" type="text" id=""
                            placeholder="REF INTERNE" title="REF INTERNE" name="FILTRE-REFINT"
                            value="<?php echo $_SESSION["FILTRE-REFINT"]; ?>">
                    </th>
                    <th>
                        <input style="width:75%; height: 3vh; text-align: center;" type="text" id=""
                            placeholder="DESIGNATION" title="DESIGNATION" name="FILTRE-DESIGNATION"
                            value="<?php echo $_SESSION["FILTRE-DESIGNATION"]; ?>">
                    </th>
                    <!-- <th>
                        <input style="width:75%; height: 3vh; text-align: center;" type="text" id=""
                            placeholder="REFERENCE" title="REFERENCE" name="FILTRE-REFERENCE"
                            value="<?php echo $_SESSION["FILTRE-REFERENCE"]; ?>">
                    </th>
                    <th>
                        <input style="width:75%; height: 3vh; text-align: center;" type="text" id=""
                            placeholder="FOURNISSEUR" title="FOURNISSEUR" name="FILTRE-FOURNISSEUR"
                            value="<?php echo $_SESSION["FILTRE-FOURNISSEUR"]; ?>">
                    </th>
                    <th>
                        <input style="width:75%; height: 3vh; text-align: center;" type="text" id=""
                            placeholder="PRIX PUBLIC" title="PRIX PUBLIC" name="FILTRE-PRIXPUBLIC"
                            value="<?php echo $_SESSION["FILTRE-PRIXPUBLIC"]; ?>">
                    </th>
                    <th>
                        <input style="width:75%; height: 3vh; text-align: center;" type="text" id=""
                            placeholder="PRIX NET" title="PRIX NET" name="FILTRE-PRIXNET"
                            value="<?php echo $_SESSION["FILTRE-PRIXNET"]; ?>">
                    </th>
                    <th>
                        <input style="width:75%; height: 3vh; text-align: center;" type="text" id=""
                            placeholder="REFERENCE CLIENT" title="REFERENCE CLIENT" name="FILTRE-REFERENCECLIENT"
                            value="<?php echo $_SESSION["FILTRE-REFERENCECLIENT"]; ?>">
                    </th> -->
                    <th>

                        <div class="checkbox">
                            <input type="checkbox" name="FILTRE-JPM" value="true" onchange="$('#formfiltre').submit();" <?php if ($_SESSION["FILTRE-JPM"] != "") {
        echo 'checked';
    }; ?>>
                            JPM
                        </div>
                    </th>
                    <th>
                        <div class="checkbox">
                            WL
                            <input type="checkbox" name="FILTRE-WL" value="true" onchange="$('#formfiltre').submit();" <?php if ($_SESSION["FILTRE-WL"] != "") {
        echo 'checked';
    }; ?>>
                        </div>
                    </th>
                    <th>

                        <input class="btn btn-outline-danger btnadd intable" id="searchfilter" type="submit"
                            name="removefilter" value="ANNULER" />
                    </th>
                </form>
            </tr>

            <th colspan="11">

                <div class="navbarchild navbarmiddle">
                    <input style="width:75%; height: 3vh; text-align: center;" type="text" id="myInput"
                        onkeyup="searchtable()" placeholder="Rechercher Item..." title="ENTRE LE NOM D'UN ITEM">
                    <select style="width:24%;height: 3vh;text-align: center;" id="columid">
                        <option value="0">REF INTERNE</option>
                        <option value="1">DESIGNATION</option>
                        <option value="2">REFERENCE</option>
                        <option value="3">FOURNISSEUR</option>
                        <option value="4">PRIX PUBLIC</option>
                        <option value="5">PRIX NET</option>
                        <option value="6">REF CLIENT</option>
                        <option value="7">QUANTITE</option>
                    </select>
                </div>

            </th>
            </tr>

    </table>

    <table id="searchtable" class="blueTable tableFixHead">
        <?php

        if (!isset($_POST['openadditem'])) {
            if (!isset($_POST['openmodifitem'])) {
                loadpieces();
            }
        }
        ?>
    </table>

    <div class="modif-popup_close" id="modif-popup">
        <?php
            include "modif.php";
        ?>
    </div>

    <div class="del-popup_close" id="del-popup">
        <?php
            include "del.php";
        ?>
    </div>

    <button onclick="topFunction()" id="myBtn" title="Go to top">↑ HAUT ↑</button>

    <?php
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
            ?>
    <script type="text/javascript">
    window.location.href = "login.php";
    </script>
    <?php
        } ?>

</body>