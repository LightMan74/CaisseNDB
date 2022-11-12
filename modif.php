<link rel="stylesheet" type="text/css" href="CSS_JS/popup.css" media="all">
<link rel="stylesheet" type="text/css" href="CSS_JS/stockstyle.css" media="all">

<link rel="stylesheet" type="text/css" href="CSS_JS/styleappel.css" media="all">

<script type="text/javascript" src="CSS_JS/view.js"></script>

<script type="text/javascript" src="CSS_JS/popup.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

<script type="text/javascript" src="CSS_JS/table.js"></script>

<body>
    <?php
session_start();
include "voirfunc.php";
?>

    <table id="123" class="blueTable tablenoFixHead">
        <thead>
            <tr>
                <th colspan="7">

                    <form action="liste.php" method="post" style="margin: 0;">
                        <input class="btn btn-outline-danger btnadd intable" id="addbutton" type="submit" name=""
                            value="Retour" />
                        <a style="width:24%;display: inline-block; vertical-align: middle;"
                            href="../Accueil.html"><input class="btn btn-outline-danger btndeconnection intable"
                                value="<?php echo 'Utillisateur : ' . htmlspecialchars($_SESSION["username"]); ?>"></a>
                    </form>

                </th>
            </tr>

    </table>

    <table id="searchtable" class="blueTable tableFixHead">

        <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["ID"];
}
loadinterventions($id);
?>


        <div class="modif-popup_close" id="modif-popup">
            <?php
//include "modif.php";
?>
        </div>

        <div class="del-popup_close" id="del-popup">
            <?php
//include "del.php";
?>
        </div>

        <button onclick="topFunction()" id="myBtn" title="Go to top">↑ HAUT ↑</button>

        <?php
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    ?>
        <script type="text/javascript">
        window.location.href = "login.php";
        </script>
        <?php }?>

</body>