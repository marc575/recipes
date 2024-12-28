<?php
    session_start();
    require_once(__DIR__ . '/utils/variables.php');
    require_once(__DIR__ . '/utils/functions.php');
    require_once(__DIR__ . '/config/databaseconnect.php');

    $postData = $_POST;
    $id = $_GET['id'];

    if (isset($postData['comment']) && $postData['comment'] !== '' && isset($postData['review'])) {
        $sqlInsertComment = 'INSERT INTO comments(comment, review, recipe_id, user_id) VALUES (:comment, :review, :recipe_id, :user_id)';
        $insertComment = $mysqlclient->prepare($sqlInsertComment);
        $insertComment->execute([
            "comment" => $postData['comment'],
            "review" => $postData['review'],
            "recipe_id" => $id,
            "user_id" => $_SESSION['LOGGED_USER']['user_id'],
        ]) or die(print_r($mysqlclient->errorInfo()));
    } else {
        $_SESSION['COMMENT_ERROR_MESSAGE'] = 'Le commentaire ne peut pas etre vide !';
    }

    redirectToUrl('recipes_read.php?id='. $id);