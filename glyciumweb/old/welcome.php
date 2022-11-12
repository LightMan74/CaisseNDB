<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<a href="logout.php" class="btn btn-outline-danger btndeconnection">Utillisateur: <?php echo htmlspecialchars($_SESSION["username"]); ?> Se deconnecter</a>

