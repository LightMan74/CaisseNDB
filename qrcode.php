<?php session_start(); ?>
<!-- <link rel="stylesheet" type="text/css" href="CSS_JS/popup.css" media="all"> -->
<link rel="stylesheet" type="text/css" href="CSS_JS/stockstyle.css" media="all">

<link rel="stylesheet" type="text/css" href="CSS_JS/styleappel.css" media="all">

<!-- <script type="text/javascript" src="CSS_JS/view.js"></script> -->

<!-- <script type="text/javascript" src="CSS_JS/popup.js"></script> -->
<script type="text/javascript" src="CSS_JS/jquery.min.js"></script>

<!-- <script type="text/javascript" src="CSS_JS/table.js"></script> -->
<link rel="icon" type="image/png" sizes="32x32" href="CSS_JS/logo.ico">

<!-- <link rel="stylesheet" href="CSS_JS/menu.css" /> -->
<!-- <script type="text/javascript" src="CSS_JS/menu.js"></script> -->

<body>
    <?php

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] != true) {
    ?>
    <script type="text/javascript">
    window.location.href = "login.php?id=<?php echo htmlspecialchars($_GET["id"]); ?>";
    </script>
    <?php
}?>

    <?php
for ($i = 1; $i <= 1; $i++) {
    echo "<img src='https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=WIFI%3AT%3AWPA%3BS%3ANDB_2024_Caisse%3BP%3AAzertyuiop!1%3BH%3Atrue%3B%3B' />" . "\n";
}
    
    ?>
</body>