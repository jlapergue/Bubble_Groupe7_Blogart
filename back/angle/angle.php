<?
/////////////////////////////////////////////////////
//
//  CRUD ANGLE (PDO) - Modifié - 6 Décembre 2020
//
//  Script  : angle.php  (ETUD)   -   BLOGART21
//
/////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

    // insertion classe STATUT
    require_once __DIR__ . '/../../CLASS_CRUD/angle.class.php';
    global $db;
    $monAngle = new ANGLE;


    $errCIR=0;
    if (isset($_GET['errCIR']) AND !empty($_GET['errCIR'])) {
        $errCIR = ($_GET['errCIR']);
    }  


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Angle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Angle</h1>
    <hr /><br />
	<h2>Nouveau angle :&nbsp;<a href="./createAngle.php"><i>Créer un angle</i></a></h2>
	<br /><hr />
	<h2>Tous les angle</h2>

    <table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
            <th>&nbsp;numAngl&nbsp;</th>
            <th>&nbsp;libAngl&nbsp;</th>
            <th>&nbsp;numLang&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
        </tr>
    </thead>
    <tbody>
<?
    $allAngle = $monAngle->get_AllAngle();
    foreach($allAngle as $row){
	// Appel méthode : tous les statuts en BDD

    // Boucle pour afficher
	//foreach($all as $row) {
?>
        <tr>
		<td><h4>&nbsp; <?php echo $row["numAngl"]; ?> &nbsp;</h4></td>

        <td>&nbsp; <?php echo $row["libAngl"]; ?> &nbsp;</td>
        <td>&nbsp; <?php echo $row["numLang"]; ?> &nbsp;</td>

		<td>&nbsp;<a href="./updateAngle.php?id=<?=$row["numAngl"];?>"><i>Modifier</i></a>&nbsp;
		<br /></td>
		<td>&nbsp;<a href="./deleteAngle.php?id=<?=$row["numAngl"];?>"><i>Supprimer</i></a>&nbsp;
		<br /></td>
        </tr>
<?
	}	// End of foreach
?>
    </tbody>
    </table>
    <br><br>
<?php
if ($errCIR == 1){
    echo 'Vous ne pouvez pas supprimer cet utilisateur. Veuillez d\'abord supprimer cet utilisateur dans les autres tables';
}
require_once __DIR__ . '/footer.php';
?>
</body>
</html>
