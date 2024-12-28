<?php 
    require_once('./config/databaseconnect.php');

    $sqlRecipesQuery = 'SELECT * FROM recipes';
    $recipesStatement = $mysqlclient->prepare($sqlRecipesQuery);
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll();

    $sqlUsersQuery = 'SELECT * FROM users';
    $usersStatement = $mysqlclient->prepare($sqlUsersQuery);
    $usersStatement->execute();
    $users = $usersStatement->fetchAll();
