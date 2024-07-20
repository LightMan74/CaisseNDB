<?php
//session_start();
require_once "config.php";
function PopUpMsg($message)
{
    echo "<script>alert('$message');</script>";
}
$countcopypersistant = 0;
function countcopy()
{
    global $countcopypersistant;
    $countcopypersistant++;
}

$_POST = array_map("trim", $_POST);

if (isset($_POST['addfilter'])) {
    $_SESSION["FILTRE-NOM"] = $_POST["FILTRE-NOM"];
} else {
    if (htmlspecialchars($_GET["nom"]) != "") {
        $_SESSION["FILTRE-NOM"] = htmlspecialchars($_GET["nom"]);
    }

    if (htmlspecialchars($_GET["id"]) != "") {
        $_SESSION["FILTRE-ID"]  = htmlspecialchars($_GET["id"]);
    }
}

if (isset($_POST['removefilter'])) {
    $_SESSION["FILTRE-NOM"] = "";
    $_SESSION["FILTRE-ID"] = "";
}

function loadclients()
{
    global $countcopypersistant;
    $countfiltre = false;
    if ($_SESSION["FILTRE-NOM"] != "") {
        $wherecondition = "`NOM` LIKE '%" . $_SESSION["FILTRE-NOM"] . "%'";
        $countfiltre = true;
    }

    if ($_SESSION["FILTRE-ID"] != "") {

        if ($countfiltre) {
            $wherecondition = $wherecondition . " AND";
        }
        $wherecondition = $wherecondition . " " . "`ID` = " . $_SESSION["FILTRE-ID"];

        $countfiltre = true;
    }
    if ($_SESSION["FILTRE-NOM"] == ""  && $_SESSION["FILTRE-ID"] == "") {
        $wherecondition = "1";
    }

    //$_SESSION["FILTRE-ID"] = "";

    $wherecondition = $wherecondition . " " . "ORDER BY ID ASC";
    $wherecondition = str_replace("*", "%", $wherecondition);

    // dbconnect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // // Check connection
    // if (!dbconnect) {
    //     $msg = "Connection failed: " . mysqli_connect_error();
    //     die($msg);
    //     PopUpMsg($msg);
    // }

    $sql = "SELECT * FROM `clients` WHERE " . $wherecondition; //1 ORDER BY `idgcm` ASC";//"SELECT * FROM stock";

    if ($wherecondition != "1" . " " . "ORDER BY ID ASC") {
        $result = mysqli_query(dbconnect, $sql);
    } else {
        echo "MODE MOBILE";
        echo "</br>";
    }
    //"SELECT * FROM stock";
    // echo $sql;
    // echo "</br>";

    if (mysqli_num_rows($result) > 0) {
        ?>
<table id="searchtable" class="blueTable tableFixHead">
    <thead>
        <tr>
            <th>
                <font>OPTION</font>
            </th>
            <th>
                <font>NOM</font>
            </th>
            <th>
                <font>CREDIT</font>
            </th>
            <th>
                <font>ID</font>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php

        while ($row = mysqli_fetch_assoc($result)) {
            ?>
        <tr>
            <th>
                <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
                    <input name="ID" type="text" maxlength="255" value="<?php echo $row["id"]; ?>" style="display:none" />
                    <input class="btn btn-warning" type="submit" name="viewitem" value="VOIR" />
                </form>
            </th>
            </th>
            <th><?php echo $row["nom"] ?></th>
            <th><?php echo $row["credit"] ?></th>
            <th><?php echo $row["id"] ?></th>
            <?php }?>
    </tbody>
    <tfoot id=" footer">
        <tr>
            <th>
                <font>OPTION</font>
            </th>
            <th>
                <font>NOM</font>
            </th>
            <th>
                <font>CREDIT</font>
            </th>
            <th>
                <font>ID</font>
            </th>
        </tr>
    </tfoot>
</table>
<?php
    }
}
?>