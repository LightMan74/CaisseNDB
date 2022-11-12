<?php session_start(); ?>
<link rel="stylesheet" type="text/css" href="CSS_JS/popup.css" media="all">
<link rel="stylesheet" type="text/css" href="CSS_JS/stockstyle.css" media="all">

<link rel="stylesheet" type="text/css" href="CSS_JS/styleappel.css" media="all">

<script type="text/javascript" src="CSS_JS/view.js"></script>

<script type="text/javascript" src="CSS_JS/popup.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

<script type="text/javascript" src="CSS_JS/table.js"></script>
<link rel="icon" type="image/png" sizes="32x32" href="https://lmbruleurs.fr/logo.ico">

<link rel="stylesheet" href="CSS_JS/menu.css" />
<script type="text/javascript" src="CSS_JS/menu.js"></script>

<body>
    <?php

include "listefunc.php";

?>
    <?php

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
    ?>
    <script type="text/javascript">
    window.location.href = "login.php?id=<?php echo htmlspecialchars($_GET["id"]); ?>";
    </script>
    <?php
}?>
    <table id="123" class="blueTable tablenoFixHead">
        <thead>
            <tr>
                <th colspan="8">
                    <div class="nav-fullscreen">
                        <ul class="nav-fullscreen__items">
                            <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> method="post"
                                style="margin: 0;">
                                <input class="btn btn-outline-danger btncat" id="addbutton1" type="submit"
                                    name="aprevoir" value="A PREVOIR" />
                                <input class="btn btn-outline-danger btncat" id="addbutton" type="submit"
                                    name="contratin" value="CONTRAT IN" />
                                <input class="btn btn-outline-danger btncat" id="addbutton1" type="submit"
                                    name="contratout" value="CONTRAT OUT" />
                                <input class="btn btn-outline-danger btncat" id="addbutton1" type="submit" name="addc"
                                    value="AJOUTER CLIENT" />
                                <!-- <input class="btn btn-outline-danger btncat" id="addbutton1" type="submit" name=""
                                    value="AJOUTER INTERVENTIONT" /> -->
                                <?php echo 'Utillisateur : ' . htmlspecialchars($_SESSION["username"]); ?>
                                <a href="../logout.php"><input class="btn btn-outline-danger btncat"
                                        value="DECONNEXION"></a>
                            </form>
                        </ul>

                    </div>
                    <?php
                    function menutext(){
                        if($_POST["removefilter"]){return 'MENU';}
                        else
                        if($_SESSION["FILTRE-APREVOIR"] || $_POST["aprevoir"]){return 'MENU - A PREVOIR';}
                        elseif($_SESSION["FILTRE-CONTRATIN"] || $_POST["contratin"] ){return 'MENU - CONTRAT IN';}
                        elseif($_SESSION["FILTRE-CONTRATOUT"] || $_POST["contratout"]){return 'MENU - CONTRAT OUT';}
                       else{return 'MENU';}
                    }
                    ?>
                    <div class="hamburger">
                        <center>
                            <input style="width:75%; height: 100%;" class="btn" id="addbutton1" type="button" name=""
                                value="<?php echo menutext();?>" />
                        </center>
                    </div>
                </th>
            </tr>

            <tr style="height:50px;">
                <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post" style="margin: 0;">
                    <th colspan="2">
                        <input class="btn btn-outline-danger btnadd intable" id="searchfilter" type="submit"
                            name="addfilter" value="FILTRER" style="height:50px;" />
                    </th>
                    <th colspan="4">
                        <input style="width:100%; height: 50px; text-align: center;" type="text" id=""
                            placeholder="IDGCM" title="idgcm" name="FILTRE-IDGCM"
                            value="<?php echo $_SESSION["FILTRE-IDGCM"]; ?>">
                    </th>
                    <!--<th>
                        <input style="width:75%; height: 3vh; text-align: center;" type="text" id="" placeholder="NOM"
                            title="NOM" name="FILTRE-NOM" value="<?php echo $_SESSION["FILTRE-NOM"]; ?>">
                    </th>
                    <th>
                        <input style="width:75%; height: 3vh; text-align: center;" type="text" id=""
                            placeholder="PRENOM" title="PRENOM" name="FILTRE-PRENOM"
                            value="<?php echo $_SESSION["FILTRE-PRENOM"]; ?>">
                    </th>
                    <th>
                        <input style="width:75%; height: 3vh; text-align: center;" type="text" id=""
                            placeholder="ADRESSE" title="ADRESSE" name="FILTRE-ADRESSE"
                            value="<?php echo $_SESSION["FILTRE-ADRESSE"]; ?>">
                    </th>
                    <th>
                    <th>
                        <input style="width:75%; height: 3vh; text-align: center;" type="text" id=""
                            placeholder="TELEPHONE" title="TELEPHONE" name="FILTRE-TELEPHONE"
                            value="<?php echo $_SESSION["FILTRE-TELEPHONE"]; ?>">
                    </th>-->

                    <th colspan="2">
                        <input style="width:100%; height: 50px; text-align: center;"
                            class="btn btn-outline-danger btnadd intable" id="searchfilter" type="submit"
                            name="removefilter" value="ANNULER" />
                    </th>
                </form>
            </tr>

    </table>

    <?php
if (isset($_POST['addc'])) {
        $_GET["addc"] = "true";
    }

if ((isset($_POST['viewitem']) || $_SESSION["FILTRE-ID"] != "")) {
    include "voirfunc.php";
    loadintervention();
} elseif ((isset($_POST['MODIFIER']) || $_SESSION["FILTRE-ID"] != "") || (htmlspecialchars($_GET["addc"]) == "true")) {
    include "modiffunc.php";
    modifintervention();
} elseif (isset($_POST['MODIFIERITEM']) || $_SESSION["FILTRE-ID"] != "" || isset($_POST['ADDITEM'])) {
    include "modiffunc.php"; //MODIFIERITEM
    if (isset($_POST['ADDITEM'])) {
        modifinterventionupdate('ADDITEM');
    } else {
        modifinterventionupdate('MODIFIERITEM');
    }
} elseif (isset($_POST['GENERERPDF'])) {
    include "pdffunc.php";
    pdfclient();
} else {
    loadclients(); ?>
    <button onclick="topFunction()" id="myBtn" title="Go to top">↑ HAUT ↑</button>
    <?php
}
?>


    <?php session_write_close(); ?>



</body>