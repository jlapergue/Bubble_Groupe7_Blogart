<?php
///////////////////////////////////////////////////////////////
//
//  CRUD COMMENT (PDO) - Code Modifié - 23 Janvier 2021
//
//  Script  : createComment.php  (ETUD)   -   BLOGART21
//
///////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';


    // controle des saisies du formulaire


    // insertion classe COMMENT
    require_once __DIR__ . '/../../util/ctrlSaisies.php';
    require_once __DIR__ . '/../../CLASS_CRUD/getNextNumCom.php';
    require_once __DIR__ . '/../../CLASS_CRUD/comment.class.php';
    global $db;
    $monComment = new COMMENT;


    // Gestion du $_SERVER["REQUEST_METHOD"] => En POST
    // ajout effectif du statucommentairet
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Opérateur ternaire
        $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

        if ((isset($_POST["Submit"])) AND ($_POST["Submit"] === "Annuler")) {

            header("Location: ./comment.php");
        }   // End of if ((isset($_POST["submit"])) ...

        // Mode création
        if (((isset($_POST['libCom'])) AND !empty($_POST['libCom']))
            AND (!empty($_POST['Submit']) AND ($Submit === "Envoyer"))
            AND ((isset($_POST['numArt'])) AND !empty($_POST['numArt']))) {    
            
            // Saisies valides
            $erreur = false;

            $libCom = ctrlSaisies(($_POST['libCom']));
            $numArt = ctrlSaisies(($_POST['numArt']));
            $dtCreaCom = date("Y-m-d h:i:s");
            $numSeqCom = getNextNumCom($numArt);

            $monComment->create($numSeqCom, $numArt, $dtCreaCom, $libCom);
            header("Location: ./comment.php");

                  
        }   // Fin if ((isset($_POST['libStat'])) ...
        else {
            $erreur = true;
            $errSaisies =  "Erreur, la saisie est obligatoire !";
        }   // End of else erreur saisies

    }   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")

    // Init variables form
    include __DIR__ . '/initComment.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Comment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Comment</h1>
    <h2>Ajout d'un commentaire</h2>

    <form method="post" action="./createComment.php" enctype="multipart/form-data">

      <fieldset>
        <legend class="legend1">Formulaire Commentaire...</legend>

        <!--<input type="hidden" id="id" name="id" value=": /*$_GET['id']; */-->
        
        <div class="control-group">
            <label class="control-label" for="libCom"><b>Commentaire&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libCom" id="libCom" size="80" maxlength="80" value="<?= $libCom; ?>" autofocus="autofocus" />
        </div>
        <div class="control-group">
            <label for="numArt">Articles :</label>  
            <select id="numArt" name="numArt"  onchange="select()">
                <option value="" selected disabled hidden>Sélectionner un article</option>
                <?php 
                global $db;
                $requete = 'SELECT numArt, libTitrArt FROM ARTICLE ;';
                $result = $db->query($requete);
                $allArticle = $result->fetchAll();
                foreach ($allArticle AS $pays)
                {
                ?>
                <option value="<?php echo $pays['numArt'];?>"><?php echo $pays['libTitrArt'];?></option>
                <?php
            }
            ?>
            </select>
        </div>
      
        <div class="controls">
            <br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" value="Annuler" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
            &nbsp;&nbsp;&nbsp;&nbsp;
            <input type="submit" value="Envoyer" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
            <br>
        </div>

      </fieldset>
    </form>
<?php
require_once __DIR__ . '/footerComment.php';
require_once __DIR__ . '/footer.php';
?>
</body>
</html>