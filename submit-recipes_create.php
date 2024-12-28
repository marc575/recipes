<?php
    session_start();
    require_once(__DIR__ . '/utils/variables.php');
    require_once(__DIR__ . '/utils/functions.php');
    require_once(__DIR__ . '/config/databaseconnect.php');

    $postData = $_POST;

    $postFile = $_FILES;
    
    if (isset($postFile['illustration']) && $postFile['illustration']['error'] == 0) {

        if ($postFile['illustration']['error'] > 5000000) {
            echo('L envoie n a pas pu etre effectué, erreur ou image trop volumineuse');
            return;
        }

        $fileInfo = pathinfo($postFile['illustration']['name']);
        $extension = $fileInfo['extension'];
        $allowedExtensions = ["jpg", "jpeg", "gif", "png"];
        if (!in_array($extension, $allowedExtensions)) {
            echo "l envoi n'a pas pu etre effectué, l'extension {$extension} n'est pas pris en charge";
            return;
        }

        $path = './uploads/';
        if (!is_dir($path)) {
            echo "l envoi n'a pas pu etre effectué, le dossier uploads est manquant";
            return;
        }

        $pathImg = $path . basename($_FILES['illustration']['name']);

        move_uploaded_file($_FILES['illustration']['tmp_name'], $path . basename($_FILES['illustration']['name']));
        
    }

    if (isset($postData['title']) && isset($postData['recipe'])) {
        $sqlInsertRecipe = 'INSERT INTO recipes(title, recipe, author, is_enabled, illustration) VALUES (:title, 
        :recipe, :author, :is_enabled, :illustration)';
        $insertRecipe = $mysqlclient->prepare($sqlInsertRecipe);
        $insertRecipe->execute([
            "title" => $postData['title'],
            "recipe" => $postData['recipe'],
            "author" => $_SESSION['LOGGED_USER']['email'],
            "is_enabled" => 1,
            "illustration" => $pathImg,
        ]) or die(print_r($mysqlclient->errorInfo()));
    }
?>

    <!DOCTYPE html>
    <html lang="fr">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>partage de recettes - Accusé de reception</title>
        
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/index.css">
    </head>
    
    <body class="d-flex flex-column min-vh-100">
        <?php require_once(__DIR__ . '/sections/header.php'); ?>
    
        <main class='banner py-5'>
            <div class="card my-5 shadow">
                <h3>Accusé de reception</h3>
                <div class="card-body">
                    <p class="card-text"><b>Titre</b> : <?php echo $postData['title']; ?></p>
                    <p class="card-text"><b>Recette</b> : <?php echo $postData['recipe']; ?></p>
                    <p class='card-text'><b>illustration</b> : <?php echo $_FILES['illustration']['name']; ?></p>
                </div>
            </div>
        </main>
        
        <?php require_once(__DIR__ . '/sections/footer.php'); ?>
    
        <script src="assets/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>