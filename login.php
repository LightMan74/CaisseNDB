<?php session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    header('location: liste.php?id=' . $_POST["id"]);
    exit;
// }
} elseif ($_COOKIE['LMB_CONNECT_USERNAME'] != "") {
    $_SESSION["loggedin"] = true;
    $_SESSION["username"] = $_COOKIE['ALB_CONNECT_USERNAME'];
    header('location: liste.php?id=' . $_POST["id"]);
    exit;
}

// Include config file
require_once "configbis.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }
   
                                session_start();

                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;
                                // retenir l'email de la personne connectée pendant 1 an
                                setcookie('ALB_CONNECT_USERNAME', $username, time() + 1*12*3600, '/', 'site.lansard.ch', true, true);
                                // Redirect user to welcome page
                                header('location: liste.php?id=' . $_POST["id"]);
}
                           
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>GCMW.LMBRULEURS.FR</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
    body {
        font: 14px sans-serif;
    }

    .wrapper {
        width: 500px;
        padding: 20px;
    }
    </style>
</head>

<body>
    <div class="wrapper" style="margin: 0 auto; text-align: center;">
        <h2><a style="color:inherit; text-decoration: inherit " href="https://albinton.fr"
                class="fullwidth">CAISSE</a></br>ALBINTON</br>NDB</h2>
        <h2>Connexion</h2>
        <p>Veuillez remplir vos identifiants pour vous connecter.</p>
        </br>
        </br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Nom d'utillisateur</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>

            <div class="form-group">
                <input name="id" type="text" maxlength="255" value="<?php echo $_GET["id"]; ?>" style="display:none" />

                <input type="submit" class="btn btn-primary" value="Connexion">
            </div>
        </form>
    </div>
</body>

</html>