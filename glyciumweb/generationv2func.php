<?php
	session_start(); 
	require_once "config.php";
		
	function PopUpMsg($message) { 
		echo "<script>alert('$message');</script>"; 
	} 

	
	function v2() {
	
	$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $conninter = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	// Check connection
	if (!$conn) {
		$msg = "Connection failed: " . mysqli_connect_error();
		die($msg);
		PopUpMsg($msg);
	}
		
	$sql = "SELECT * FROM `clients` WHERE 1 ORDER BY `idgcm` ASC";//"SELECT * FROM stock";
	$result = mysqli_query($conn, $sql);

    //"SELECT * FROM stock";
	
	
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
?>


<hr width="50%" size="2 rem" noshade />
<div class="spoiler">
    <a onClick="showSpoiler(this);"
        value="Show/Hide"><?php echo $row["nom"] . " " . $row["prenom"] . " " . $row["adresse"] . " " . $row["cp"] . " " . $row["ville"]?></a>
    <div Class="inner" style="display: none;">
        <input type="text" id="0"
            value="<?php echo $row["nom"] . " " . $row["prenom"] . " " . $row["adresse"] . " " . $row["cp"] . " " . $row["ville"] . " *" . $row["telephone"] . "*"?>">
        <button onclick="selectText(0)">Copier Nom Client</button>
        <Table Border>
            <tr>
                <th>
                    <font>Nom</font>
                </th>
                <th>
                    <font>Prenom</font>
                </th>
                <th>
                    <font>Adresse</font>
                </th>
                <th>
                    <font>Code Postal</font>
                </th>
                <th>
                    <font>Ville</font>
                </th>
                <th>
                    <font>Coord GPS (Tech)</font>
                </th>
				<th>
                    <font>Coord GPS</font>
                </th>
                <th>
                    <font>Telephone</font>
                </th>
                <th>
                    <font>Email</font>
                </th>
                <th>
                    <font>Remarque</font>
                </th>
            </tr>
            <tr>
            <?php 
            $idgcm =  $row["idgcm"];
             $sqlinter = "SELECT * FROM `interventions` WHERE `idgcm`=" . "\"" . $idgcm . "\""; 
             ?>
                <th><?php echo $row["nom"] ?></th>
                <th><?php echo  $row["prenom"] ?></th>
                <th><?php echo  $row["adresse"] ?></th>
                <th><?php echo  $row["cp"] ?></th>
                <th><?php echo  $row["ville"] ?></th>
                <th><?php echo  $row["coordgps"] ?></th>				
                <th><?php echo  $row["latitude"] . ', ' . $row["longitude"] ?></th>
                <th><?php echo  $row["telephone"] ?></th>
                <th><?php echo $row["email"] ?></th>
                <th><?php echo $row["remarque"] ?></th>
            </tr>
        </Table>
        <Table Border>
            <tr>
            <th>
                    <font>Adresse Facturation</font>
                </th>
                <th>
                    <font>infos Client</font>
                </th>
            </tr>
            <tr>
            <th><?php echo $row["adressefacturation"] ?></th>
            <th><?php echo $row["infosclient"] ?></th>
            </tr>
        </Table>
        <Table Border>
            <tr>
            <th>
                    <font>Etat Rappel</font>
                </th>
                <th>
                    <font>Date Rappel</font>
                </th>
                <th>
                    <font>Etat Contrat</font>
                </th>
                <th>
                    <font>Date Contrat</font>
                </th>
            </tr>
            <tr>
            <th><?php echo $row["etatrappel"] ?></th>
                <th><?php echo $row["rdvupdate"] ?></th>
                <th><?php echo $row["etatcontrat"] ?></th>
                <th><?php echo $row["datecontrat"] ?></th>
            </tr>
        </Table>
        <Table Border>
            <tr>
                <th>
                    <font>Energie</font>
                </th>
                <th>
                    <font>Pre filtre</font>
                </th>
                <th>
                    <font>Emetteurs</font>
                </th>
            </tr>
            <tr>
                <th><?php echo $row["energie"] ?></th>
                <th><?php echo $row["prefiltre"] ?></th>
                <th><?php echo $row["emetteurs"] ?></th>
            </tr>
        </Table>
        <Table Border>
            <tr>
                <th>
                    <font>Marque Chaudiere</font>
                </th>
                <th>
                    <font>Type Chaudiere</font>
                </th>
                <th>
                    <font>Numero Chaudiere</font>
                </th>
            </tr>
            <tr>
                <th><?php echo $row["marquechaudiere"] ?></th>
                <th><?php echo $row["modelchaudiere"] ?></th>
                <th><?php echo $row["numerochaudiere"] ?></th>
            </tr>
        </Table>
        <Table Border>
            <tr>
                <th>
                    <font>Marque Bruleur</font>
                </th>
                <th>
                    <font>Type Bruleur</font>
                </th>
                <th>
                    <font>Numero Bruleur</font>
                </th>
            </tr>
            <tr>
                <th><?php echo $row["marquebruleur"] ?></th>
                <th><?php echo $row["modelbruleur"] ?></th>
                <th><?php echo $row["numerobruleur"] ?></th>
            </tr>
        </Table>
        <Table Border>
            <tr>
                <th>
                    <font>Marque Regulation</font>
                </th>
                <th>
                    <font>Type Regulation</font>
                </th>
                <th>
                    <font>Numero Regulation</font>
                </th>
            </tr>
            <tr>
                <th><?php echo $row["marqueregulation"] ?></th>
                <th><?php echo $row["modelregulation"] ?></th>
                <th><?php echo $row["numeroregulation"] ?></th>
            </tr>
        </Table>
        </br>
        <?php
$resultinter = mysqli_query($conninter, $sqlinter);
if (mysqli_num_rows($resultinter) > 0) {
?>
        <font>Intervention</font>
        </th>
        <Table Border>
            <tr>
                <th>
                    <font>Intervention</font>
                </th>
                <th>
                    <font>Facturation</font>
                </th>
                <th>
                    <font>Facture N°</font>
                </th>
                <th>
                    <font>Montant</font>
                </th>
                <th>
                    <font>Paye</font>
                </th>
                <th>
                    <font>Pieces</font>
                </th>
                <th>
                    <font>Commentaire</font>
                </th>
                <th>
                    <font>Technicien</font>
                </th>
                <th>
                    <font>Type</font>
                </th>
            </tr>
            <?php
		while($rowinter = mysqli_fetch_assoc($resultinter)) {
?>
            <tr>
                <th>
                    <?php echo $rowinter["dateintervention"] ?>
                </th>
                <th>
                    <?php echo $rowinter["datefacturation"] ?>
                </th>
                <th>
                    <?php echo $rowinter["facturenumber"] ?>
                </th>
                <th>
                    <?php echo $rowinter["montant"] ?>
                </th>
                <th>
                    <?php echo $rowinter["paye"] ?>
                </th>
                <th>
                    <?php echo $rowinter["pieces"] ?>
                </th>
                <th>
                    <?php echo $rowinter["commentaire"] ?>
                </th>
                <th>
                    <?php echo $rowinter["technicien"] ?>
                </th>
                <th>
                    <?php echo $rowinter["type"] ?>
                </th>
            </tr>

            <?php
               }
               ?>
        </Table>
<?php
            }     
            ?>
            </div>
            </div>
            </br>
            <?php       
        }
    }
}
			?>
