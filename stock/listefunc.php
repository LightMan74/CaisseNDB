<?php
    session_start();
    require_once "config.php";

    function PopUpMsg($message)
    {
        echo "<script>alert('$message');</script>";
    }

    function compareforcolor($reel, $limite, $pourc)
    {
        if ($reel < $limite) {
            echo "style=". chr(34) . "background:red". chr(34);
        }

        if ($reel < $limite + $pourc*$limite && $reel >= $pourc*$limite) {
            echo "style=". chr(34) . "background:orange". chr(34);
        }
    }

function enableQuant()
{
    if ($_SESSION["username"] != "bureau" && $_SESSION["username"] != "wl" && $_SESSION["username"] != "jpm" && $_SESSION["username"] != "clara" && $_SESSION["username"] != "nora") {
        echo "readonly";
    }
}


    if (isset($_POST['FILTRE-WL']) || isset($_POST['FILTRE-JPM']) || isset($_POST['FILTRE-FAV'])) {
        $_SESSION["FILTRE-WL"] = $_POST["FILTRE-WL"];
        $_SESSION["FILTRE-JPM"] = $_POST["FILTRE-JPM"];
        $_SESSION["FILTRE-FAV"] = $_POST["FILTRE-FAV"];
    }
$filtrekeep = false;
    if (!isset($_POST['FILTRE-WL']) && !isset($_POST['FILTRE-JPM']) && !isset($_POST['FILTRE-FAV'])) {
        if (!isset($_POST['openmodifitem'])) {
            if (!isset($_POST['modifitem'])) {
                if (!isset($_POST['delitem'])) {
                    if (!isset($_POST['confitem'])) {
                        if ($_SESSION['keepfiltre'] == false) {
                            $_SESSION['keepfiltre'] = false;
                            $_SESSION["FILTRE-WL"] = "";
                            $_SESSION["FILTRE-JPM"] = "";
                            $_SESSION["FILTRE-FAV"] = "";
                            $filtrekeep = true;
                        } else {
                            $_SESSION['keepfiltre'] = false;
                        }
                    }
                }
            }
        }
    }


    if (isset($_POST['addfilter']) || isset($_POST['FILTRE-WL']) || isset($_POST['FILTRE-JPM']) || isset($_POST['FILTRE-FAV']) || $filtrekeep) {
        $filtrekeep = false;
        $_SESSION["FILTRE-DESIGNATION"] = $_POST["FILTRE-DESIGNATION"];
        $_SESSION["FILTRE-REFERENCE"] = $_POST["FILTRE-REFERENCE"];
        $_SESSION["FILTRE-FOURNISSEUR"] = $_POST["FILTRE-FOURNISSEUR"];
        $_SESSION["FILTRE-PRIXPUBLIC"] = $_POST["FILTRE-PRIXPUBLIC"];
        $_SESSION["FILTRE-PRIXNET"] = $_POST["FILTRE-PRIXNET"];
        $_SESSION["FILTRE-REFERENCECLIENT"] = $_POST["FILTRE-REFERENCECLIENT"];
        $_SESSION["FILTRE-REFINT"] = $_POST["FILTRE-REFINT"];
    } //else {

        if (htmlspecialchars($_GET["DESIGNATION"]) != "") {
            $_SESSION["FILTRE-DESIGNATION"] = htmlspecialchars($_GET["DESIGNATION"]);
        } elseif (htmlspecialchars($_GET["D"]) != "") {
            $_SESSION["FILTRE-DESIGNATION"] = htmlspecialchars($_GET["D"]);
        } elseif (htmlspecialchars($_GET["d"]) != "") {
            $_SESSION["FILTRE-DESIGNATION"] = htmlspecialchars($_GET["d"]);
        }
        //$_SESSION["FILTRE-DESIGNATION"] = htmlspecialchars($_GET["DESIGNATION"]);

        if (htmlspecialchars($_GET["FOURNISSEUR"]) != "") {
            $_SESSION["FILTRE-FOURNISSEUR"] = htmlspecialchars($_GET["FOURNISSEUR"]);
        } elseif (htmlspecialchars($_GET["F"]) != "") {
            $_SESSION["FILTRE-FOURNISSEUR"] = htmlspecialchars($_GET["F"]);
        } elseif (htmlspecialchars($_GET["f"]) != "") {
            $_SESSION["FILTRE-FOURNISSEUR"] = htmlspecialchars($_GET["f"]);
        }
        if (htmlspecialchars($_GET["REFERENCE"]) != "") {
            $_SESSION["FILTRE-REFERENCE"] = htmlspecialchars($_GET["REFERENCE"]);
        }
        if (htmlspecialchars($_GET["PRIXPUBLIC"]) != "") {
            $_SESSION["FILTRE-PRIXPUBLIC"] = htmlspecialchars($_GET["PRIXPUBLIC"]);
        }
        if (htmlspecialchars($_GET["PRIXNET"]) != "") {
            $_SESSION["FILTRE-PRIXNET"] = htmlspecialchars($_GET["PRIXNET"]);
        }
        if (htmlspecialchars($_GET["REFERENCECLIENT"]) != "") {
            $_SESSION["FILTRE-REFERENCECLIENT"] = htmlspecialchars($_GET["REFERENCECLIENT"]);
        }
        if (htmlspecialchars($_GET["id"]) != "") {
            $_SESSION["FILTRE-ID"]  = htmlspecialchars($_GET["id"]);
        }
        if (htmlspecialchars($_GET["WL"]) != "") {
            $_SESSION["FILTRE-WL"] = htmlspecialchars($_GET["WL"]);
        }
        if (htmlspecialchars($_GET["JPM"]) != "") {
            $_SESSION["FILTRE-JPM"] = htmlspecialchars($_GET["JPM"]);
        }
        if (htmlspecialchars($_GET["FAV"]) != "") {
            $_SESSION["FILTRE-FAV"] = htmlspecialchars($_GET["FAV"]);
        }
        if (htmlspecialchars($_GET["REFINT"]) != "") {
            $_SESSION["FILTRE-REFINT"] = htmlspecialchars($_GET["REFINT"]);
        } elseif (htmlspecialchars($_GET["refint"]) != "") {
            $_SESSION["FILTRE-REFINT"] = htmlspecialchars($_GET["refint"]);
        }

    $_SESSION["DEPRECIER"] = false;
    if (htmlspecialchars($_GET["DEPRECIER"]) != "") {
        $_SESSION["DEPRECIER"] = true;
    } elseif (htmlspecialchars($_GET["deprecier"]) != "") {
        $_SESSION["DEPRECIER"] = true;
    }
        //}
    if (isset($_POST['removefilter'])) {
        $_SESSION["FILTRE-DESIGNATION"] = "";
        $_SESSION["FILTRE-REFERENCE"] =  "";
        $_SESSION["FILTRE-FOURNISSEUR"] = "";
        $_SESSION["FILTRE-PRIXPUBLIC"] =  "";
        $_SESSION["FILTRE-PRIXNET"] =   "";
        $_SESSION["FILTRE-REFERENCECLIENT"] = "";
        $_SESSION["FILTRE-ID"] = "";
        $_SESSION["FILTRE-WL"] = "";
        $_SESSION["FILTRE-JPM"] = "";
        $_SESSION["FILTRE-FAV"] = "";
        $_SESSION["FILTRE-REFINT"]= "";
        $_SESSION["DEPRECIER"] = false;
    }

            function urlfourniseur($fourn, $ref, $view)
            {
                //"<td><a href='https://www.tbs-international.fr/fr/fr/Résultat-de-la-recherche.html?search_keywords=" . $row["REFERENCE"] . "' target='_blank'>" . $row["REFERENCE"] ."</a></td>"
                //https://www.pieces-chauffe.fr/recherche?search_query=
                $ref = ltrim($ref);
                $ref = rtrim($ref);
                $fourn = strtoupper($fourn);
                switch ($fourn) {
    case "TBS":
        return "<a href='https://www.tbs-international.fr/fr/fr/Résultat-de-la-recherche.html?search_keywords=" . $ref . "' target='_blank'>" . $view ."</a>";
    break;

    case "OEG":
        return "<a href='https://www.oeg.net/fr/" . $ref . "' target='_blank'>" . $view ."</a>";
    break;

    case "PPC":
        return "<a href='https://www.pieces-chauffe.fr/recherche?search_query=" . $ref . "' target='_blank'>" . $view ."</a>";
    break;

    default:
        return $view;
}
            }

    function loadpieces()
    {
        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        // Check connection
        if (!$conn) {
            $msg = "Connection failed: " . mysqli_connect_error();
            die($msg);
            PopUpMsg($msg);
        }


        $countfiltre = false;
        if ($_SESSION["FILTRE-DESIGNATION"] != "") {
            $wherecondition = "`DESIGNATION` LIKE '%" . $_SESSION["FILTRE-DESIGNATION"] . "%'";
            $countfiltre = true;
        }

        if ($_SESSION["FILTRE-REFERENCE"] != "") {
            if ($countfiltre) {
                $wherecondition = $wherecondition . " AND" ;
            }
            $wherecondition = $wherecondition . " " . "`REFERENCE` LIKE '%" . str_replace(' ', '%', $_SESSION["FILTRE-REFERENCE"]) . "%'";
            $countfiltre = true;
        }

        if ($_SESSION["FILTRE-FOURNISSEUR"] != "") {
            if ($countfiltre) {
                $wherecondition = $wherecondition . " AND" ;
            }
            $wherecondition = $wherecondition . " " . "`FOURNISSEUR` LIKE '%" . $_SESSION["FILTRE-FOURNISSEUR"] . "%'";
            $countfiltre = true;
        }

        if ($_SESSION["FILTRE-PRIXPUBLIC"] != "") {
            if ($countfiltre) {
                $wherecondition = $wherecondition . " AND" ;
            }
            $wherecondition = $wherecondition . " " . "`PRIXPUBLIC` LIKE '%" . $_SESSION["FILTRE-PRIXPUBLIC"] . "%'";
            $countfiltre = true;
        }

        if ($_SESSION["FILTRE-PRIXNET"] != "") {
            if ($countfiltre) {
                $wherecondition = $wherecondition . " AND" ;
            }
            $wherecondition = $wherecondition . " " . "`PRIXNET` LIKE '%" . $_SESSION["FILTRE-PRIXNET"] . "%'";
            $countfiltre = true;
        }

        if ($_SESSION["FILTRE-REFERENCECLIENT"] != "") {
            if ($countfiltre) {
                $wherecondition = $wherecondition . " AND" ;
            }
            $wherecondition = $wherecondition . " " . "`REFCLIENT` LIKE '%" . $_SESSION["FILTRE-REFERENCECLIENT"] . "%'";
            $countfiltre = true;
        }

        if ($_SESSION["FILTRE-ID"] != "") {
            if ($countfiltre) {
                $wherecondition = $wherecondition . " AND";
            }
            $wherecondition = $wherecondition . " " . "`ID` = " . $_SESSION["FILTRE-ID"];
            $countfiltre = true;
        }

        if ($_SESSION["FILTRE-WL"] != "") {
            if ($countfiltre) {
                $wherecondition = $wherecondition . " AND";
            }
            $wherecondition = $wherecondition . " " . "`WL` = " . "1";
            $countfiltre = true;
        }
        if ($_SESSION["FILTRE-JPM"] != "") {
            if ($countfiltre) {
                $wherecondition = $wherecondition . " AND";
            }
            $wherecondition = $wherecondition . " " . "`JPM` = " . "1";
            $countfiltre = true;
        }
        if ($_SESSION["FILTRE-FAV"] != "") {
            if ($countfiltre) {
                $wherecondition = $wherecondition . " AND";
            }
            if ($_SESSION["FILTRE-FAV"] == "1") {
                $wherecondition = $wherecondition . " " . "`FAV` = " . "1";
            }
            if ($_SESSION["FILTRE-FAV"] == "2") {
                $wherecondition = $wherecondition . " " . "`FAV` = " . "2";
            }
            if ($_SESSION["FILTRE-FAV"] == "3") {
                $wherecondition = $wherecondition . " " . "`FAV` = " . "1" . " OR" . " " . "`FAV` = " . "2" ;
            }
            $countfiltre = true;
        }
        if ($_SESSION["FILTRE-REFINT"] != "") { //FILTRE-REFINT
            if ($countfiltre) {
                $wherecondition = $wherecondition . " AND" ;
            }
            $wherecondition = $wherecondition . " " . "`REFINT` LIKE '%" . $_SESSION["FILTRE-REFINT"] . "%'";
            $countfiltre = true;
        }


        if ($_SESSION["FILTRE-DESIGNATION"] == "" && $_SESSION["FILTRE-REFERENCE"] == "" && $_SESSION["FILTRE-FOURNISSEUR"] == "" && $_SESSION["FILTRE-PRIXPUBLIC"] == "" && $_SESSION["FILTRE-PRIXNET"] == "" && $_SESSION["FILTRE-REFERENCECLIENT"] == "" && $_SESSION["FILTRE-ID"] == "" && $_SESSION["FILTRE-WL"] == "" && $_SESSION["FILTRE-JPM"] == "" && $_SESSION["FILTRE-FAV"] == "" && $_SESSION["FILTRE-REFINT"] == "") {
            $wherecondition = "1";
        }

        if ($_SESSION["DEPRECIER"]) {
            $wherecondition = " " . "`DEPRECIER` = " . "1";
            $countfiltre = true;
        }

        $_SESSION["FILTRE-ID"] = "";
        $wherecondition =  $wherecondition . " " . "ORDER BY DESIGNATION ASC";
        $wherecondition = str_replace("**", "_", $wherecondition);
        $wherecondition = str_replace("*", "%", $wherecondition);
        $sql = "SELECT * FROM `stock` WHERE " . $wherecondition; //`DESIGNATION` LIKE '%" . $_SESSION["filtredesignation"] . "%' ";

        //$sql = "SELECT * FROM `stock` WHERE 1";//"SELECT * FROM stock";
        //https://www.tbs-international.fr/fr/fr/Résultat-de-la-recherche.html?search_keywords=
        echo $sql;
        $sqlogs = 'INSERT INTO `logs` (`user`, `action`) VALUES ("' . $_SESSION["username"] . '","' . $sql . '")';
        //echo '<br>';
        //echo $sqlogs;
        $ww = mysqli_query($conn, $sqlogs);
        //$result = mysqli_query($conn, $sql);
        if ($wherecondition == "1" . " " . "ORDER BY DESIGNATION ASC") {
            echo "</br>";
            echo "MODE MOBILE";
            echo "</br>";
        } else {
            $result = mysqli_query($conn, $sql); ?>
<thead>
    <tr>
        <th>REF INTERNE </th>
        <th>DESIGNATION </th>
        <th>REFERENCE </th>
        <th>FOURNISSEUR </th>
        <th>PRIX PUBLIC</th>
        <th>PRIX NET </th>
        <th>REF CLIENT </th>
        <th>QUANTITE </th>
        <th>OPTIONS</th>
    </tr>
</thead>
<tbody>
    <?php

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["REFINT"] . "</td>";
            echo "<td>" . $row["DESIGNATION"] . "</td>";
            echo "<td>" . urlfourniseur($row["FOURNISSEUR"], $row["REFERENCE"], $row["REFERENCE"]) . "</td>";
            echo "<td>"  . urlfourniseur($row["FOURNISSEUR"], $row["REFERENCE"], $row["FOURNISSEUR"]) . "</td>";
            echo "<td>" . $row["PRIXPUBLIC"] . " €" . "</td>";
            echo "<td>" . $row["PRIXNET"]  . " €" . "</td>";
            echo "<td>" . $row["REFCLIENT"] . "</td>";
            echo "<td>";

            $QRB = $row["QRB"];
            $QRW = $row["QRW"];
            $QRJ = $row["QRJ"]; ?>

    <table name="nosearchtable" class="blueTable tablenoFixHead">
        <thead>
            <tr style="height:25%;">
                <th <?php compareforcolor($QRB, $QLB, $QPL); ?> colspan="1">
                    <?php if ($row["FAV"] == 1) {
                echo "* BUR *";
            } elseif ($row["FAV"] == 2) {
                echo "° BUR °";
            } else {
                echo "BUREAU";
            }; ?>
                </th>
                <th <?php compareforcolor($QRW, $QLW, $QPL); ?> colspan="1">
                    <?php if ($row["WL"] == 1) {
                echo "* WL *";
            } else {
                echo "WL";
            }; ?></th>
                <th <?php compareforcolor($QRJ, $QLJ, $QPL); ?> colspan="1">
                    <?php if ($row["JPM"] == 1) {
                echo "* JPM *";
            } else {
                echo "JPM";
            }; ?></th>
                <!-- <th>LIMITE</th> -->
            </tr>
        </thead>
        <tbody>
            <tr>
                <td <?php //compareforcolor($QRB, $QLB, $QPL);?>> <?php echo $QRB; ?> </td>
                <td <?php //compareforcolor($QRW, $QLW, $QPL);?>> <?php echo $QRW; ?> </td>
                <td <?php //compareforcolor($QRJ, $QLJ, $QPL);?>> <?php echo $QRJ; ?> </td>
                <!-- <td> <?php echo 100*$QPL.' %'; ?> </td> -->
            </tr>
        </tbody>
    </table>
    <?php
    echo "</td>";
            echo "<td>"; ?>
    <div style="height: 75%;">
        <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
            <input name="ID" type="text" maxlength="255" value="<?php echo $row["ID"]; ?>" style="display:none" />
            <input class="btn menu btn-warning" type="submit" name="openmodifitem" value="MODIFER"
                style="height: 90%;" />
        </form>
    </div>
    <div style="height: 25%;">
        <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
            <input name="ID" type="text" maxlength="255" value="<?php echo $row["ID"]; ?>" style="display:none" />
            <input class="btn menu btn-danger" type="submit" name="confitem" value="SUPPRIMER" style="height: 90%;" />
        </form>
    </div>
    <?php
    echo "</td>";
            echo "</tr>";
        } ?>

</tbody>
<tfoot id="footer">
    <tr>

        <th>REF INTERNE </th>
        <th>DESIGNATION </th>
        <th>REFERENCE </th>
        <th>FOURNISSEUR </th>
        <th>PRIX PUBLIC</th>
        <th>PRIX NET </th>
        <th>REF CLIENT </th>
        <th>QUANTITE </th>
        <th>OPTIONS</th>
    </tr>
</tfoot>

<?php
    } else {
        echo "</br>";
        echo "0 results";
    }
    
            mysqli_close($conn);
        }
    }

?>