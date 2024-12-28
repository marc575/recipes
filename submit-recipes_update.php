<?php
    session_start();
    require_once(__DIR__ . '/utils/variables.php');
    require_once(__DIR__ . '/utils/functions.php');
    require_once(__DIR__ . '/config/databaseconnect.php');

    $postData = $_POST;
    $ID = $_GET['id'];

    $postFile = $_FILES;
    
    if (isset($postFile['illustration']) && $postFile['illustration']['error'] == 0) {

        if ($postFile['illustration']['error'] > 3000000) {
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

    if (isset($postData['title']) || isset($postData['recipe'])) {
        $sqlUpdateRecipe = 'UPDATE recipes SET title = :title, recipe = :recipe, illustration = :illustration WHERE recipe_id = :id';
        $updateRecipe = $mysqlclient->prepare($sqlUpdateRecipe);
        $updateRecipe->execute([
            "title" => $postData['title'],
            "recipe" => $postData['recipe'],
            "id" => $ID,
            "illustration" => $pathImg,
        ]) or die(print_r($mysqlclient->errorInfo()));
    }

    redirectToUrl('index.php');