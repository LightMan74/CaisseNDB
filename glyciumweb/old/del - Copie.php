<?php
session_start(); 
require_once "config.php";
//($_SERVER["REQUEST_METHOD"] == "POST" && 




?>





<?php
if (isset($_POST['delitem'])){
$id = $_POST["ID"];

$sql = "DELETE FROM `stock` WHERE `id` = '$id'";


if(mysqli_query($link, $sql)){
  echo "Record deleted successfully";
} else{
    echo "Error deleting record:" . mysqli_error($link);
}

mysqli_close($link);
  header("location: liste.php");
}

//($_SERVER["REQUEST_METHOD"] == "POST" && 
if (isset($_POST['confitem'])){
	

//$conn = $link;
//if (!$conn) {
//    die("Connection failed: " . mysqli_connect_error());
//}
$id = $_POST["ID"];

//$sql = "SELECT * FROM `stock` WHERE `ID` = $id";  //"SELECT * FROM stock";
//$result = mysqli_query($conn, $sql);
//if (mysqli_num_rows($result) > 0) {
//while($row = mysqli_fetch_assoc($result)) {


?>

<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post" >
<input name="ID" type="text" maxlength="255" value="<?php echo $row["ID"];?>" style="display:none"/>
TAPER : 'oui' pour confirmer la suppresion
<input name="ID" type="text" maxlength="255" value="non"/>
<input class="btn btn-danger" type="submit" name="delitem" value="SUPPRIMER" />
</form>	

	<?php
//    }
//} else {
    echo "0 results";
//}

//mysqli_close($conn);

?>

<script type="text/javascript">
toogleForm('del-popup');
</script>

<?php

}
?>




