<?php
    session_start();
    require_once(__DIR__ . '/utils/variables.php');
    require_once(__DIR__ . '/utils/functions.php');
    require_once(__DIR__ . '/config/databaseconnect.php');

    $ID = $_GET['id'];

    if (isset($ID)) {
        $sqlDeleteRecipe = 'DELETE FROM recipes WHERE recipe_id = :id';
        $deleteRecipe = $mysqlclient->prepare($sqlDeleteRecipe);
        $deleteRecipe->execute([
            "id" => $ID,
        ]) or die(print_r($mysqlclient->errorInfo()));
    }

    redirectToUrl('index.php');