<?php session_start(); ?>
<link rel="stylesheet" type="text/css" href="CSS_JS/popup.css" media="all">
<link rel="stylesheet" type="text/css" href="CSS_JS/stockstyle.css" media="all">

<link rel="stylesheet" type="text/css" href="CSS_JS/styleappel.css" media="all">

<script type="text/javascript" src="CSS_JS/view.js"></script>

<script type="text/javascript" src="CSS_JS/popup.js"></script>
<script type="text/javascript" src="CSS_JS/jquery.min.js"></script>

<script type="text/javascript" src="CSS_JS/table.js"></script>
<link rel="icon" type="image/png" sizes="32x32" href="CSS_JS/logo.ico">

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
            <tr style="height:50px;">
                <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post" style="margin: 0;">
                    <th colspan="2">
                        <input style="width:100%; height: 50px; text-align: center;"
                            class="btn btn-outline-danger btnadd intable" id="searchfilter" type="submit"
                            name="addfilter" value="FILTRER" style="height:50px;" />
                    </th>
                    <th colspan="4">
                        <input style="width:100%; height: 50px; text-align: center;" type="text" id="" placeholder="nom"
                            title="nom" name="FILTRE-NOM" value="<?php echo $_SESSION["FILTRE-NOM"]; ?>">
                    </th>
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
// } elseif ((isset($_POST['MODIFIER']) || $_SESSION["FILTRE-ID"] != "") || (htmlspecialchars($_GET["addc"]) == "true")) {
//     include "voirfunc.php";
//     modifintervention();
} elseif (isset($_POST['MODIFIERITEM']) || $_SESSION["FILTRE-ID"] != "" || isset($_POST['ADDITEM'])) {
    include "voirfunc.php"; //MODIFIERITEM
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