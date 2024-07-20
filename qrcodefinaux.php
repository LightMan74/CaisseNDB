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
for ($i = 1; $i <= 500; $i++) {
    echo "<div width='100%'><img src='https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=http%3A%2F%2F192.168.5.100/liste.php?id=$i'
    title='http://192.168.5.100/liste.php?id=$i' />" . "http://192.168.5.100/liste.php?id=$i" . "</div>" . "\n";
}
    
    ?>
</body>