<?php
	session_start(); 
	require_once "config.php";
	
	if (isset($_POST['delitem']) && $_POST["confdel"] == "oui" ){
		$id = $_POST["ID"];
		
		$sql = "DELETE FROM `stock` WHERE `id` = '$id'";
		
		
		if(mysqli_query($link, $sql)){
			PopUpMsg("SUPPRESSION EFFECTUER.");
		} else{
			PopUpMsg("SUPPRESSION Error :" . mysqli_error($link));
		}
		
		mysqli_close($link);
		
?>

<script type="text/javascript">
	window.location.href = "liste.php";
</script>

<?php
	
	}
	
	if (isset($_POST['confitem'])){
		
		$id = $_POST["ID"];
		include "delform.php";
	
?>

<script type="text/javascript">
	toogleForm('del-popup');
</script>

<?php
	}
?>







