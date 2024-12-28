<?php
    session_start();
    require_once(__DIR__ . '/utils/variables.php');
    require_once(__DIR__ . '/utils/functions.php');
    require_once(__DIR__ . '/config/databaseconnect.php');

    $postData = $_POST;

    if (isset($postData['email']) && isset($postData['password']) && isset($postData['confirm-password'])) {
        if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL) && $postData['password'] !== $postData['confirm-password']) {
            $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Erreur sur email et mot de passe';
        } elseif (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL) || $postData['password'] !== $postData['confirm-password']) {
            $_SESSION['LOGIN_ERROR_MESSAGE'] = 'Erreur sur email ou mot de passe';
        } else {
            $sqlInsertUser = 'INSERT INTO users(full_name, email, age, password) VALUES (:full_name, 
            :email, :age, :password)';
            $insertUser = $mysqlclient->prepare($sqlInsertUser);
            $insertUser->execute([
                "full_name" => $postData['full_name'],
                "email" => $postData['email'],
                "age" => $postData['age'],
                "password" => $postData['password'],
            ]) or die(print_r($mysqlclient->errorInfo()));

            $_SESSION['LOGGED_USER'] = [
                'email' => $postData['email'],
                'user_id' => count($users) + 1,
            ];

            if (!isset($_SESSION['LOGGED_USER'])) {
                $_SESSION['LOGIN_ERROR_MESSAGE'] = sprintf(
                    'les informations envoyees sont erronnees : (%s / %s)',
                    $postData['email'],
                    strip_tags($postData['password'])
                );
            }
        }
        
    }

    redirectToUrl('index.php');