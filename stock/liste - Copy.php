<link rel="stylesheet" type="text/css" href="CSS_JS/popup.css" media="all">
<link rel="stylesheet" type="text/css" href="CSS_JS/stockstyle.css" media="all">

<script type="text/javascript" src="CSS_JS/view.js"></script>

<script type="text/javascript" src="CSS_JS/popup.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

<script type="text/javascript" src="CSS_JS/table.js"></script>

<body>
    <?php 
		session_start();
		include "listefunc.php";
	?>

    <table id="searchtable" class="blueTable tableFixHead">
        <thead>
            <tr>
                <th>DESIGNATION</th>
                <th>TYPE </th>
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
				loadpieces();
			?>

        </tbody>
        <tfoot id="footer">
            <tr>
                <th>DESIGNATION</th>
                <th>TYPE </th>
                <th>REFERENCE </th>
                <th>FOURNISSEUR </th>
                <th>PRIX PUBLIC</th>
                <th>PRIX NET </th>
                <th>REF CLIENT </th>
                <th>QUANTITE </th>
                <th>OPTIONS</th>
            </tr>
        </tfoot>
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

    <input id="NavButtonext" class="button_close" type="button" onclick="toogleForm('navbar');" value="OUVRIR MENU"
        style="position: fixed;
	bottom:0; display:block; width:100%;" />

    <div id="navbar" class="navbar navbar_show">

        <input id="NavButton" class="button_close" type="button" onclick="toogleForm('navbar');" value="FERMER MENU"
            style="display:inline-block; width:100%" />

        <div class="navbarchild navbarleft">
            <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
                <input class="btn btn-outline-danger btnadd" id="addbutton" type="submit" name="openadditem"
                    value="AJOUTER" />
            </form>
        </div>
        <div class="navbarchild navbarmiddle">
            <input style="width:100%; height: 3.4vh; text-align: center;" type="text" id="myInput"
                onkeyup="searchtable()" placeholder="Rechercher Item..." title="Type in a name">
            <select style="width:100%;height: 3vh;text-align: center;" id="columid">
                <option value="1">TYPE</option>
                <option value="0">DESIGNATION</option>
                <option value="1">TYPE</option>
                <option value="2">REFERENCE</option>
                <option value="3">FOURNISSEUR</option>
                <option value="4">PRIX PUBLIC</option>
                <option value="5">PRIX NET</option>
                <option value="6">REF CLIENT</option>
                <option value="7">QUANTITE</option>
            </select>
        </div>
        <div class="navbarchild navbarright">
            <?php
				if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
					header("location: login.php");
					exit;
				}
			?>
            <a href="../logout.php" class="btn btn-outline-danger btndeconnection">Accueil / Utillisateur:
                <?php echo htmlspecialchars($_SESSION["username"]); ?> </a>
        </div>
    </div>
</body>