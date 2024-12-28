<?php 
    require_once(__DIR__ . '/mysql.php');

    try {
        $mysqlclient = new PDO(
            sprintf('mysql:host=%s;dbname=%s;port=%s;charset=utf8', MYSQL_HOST, MYSQL_NAME, MYSQL_PORT),
            MYSQL_USER,
            MYSQL_PASSWORD,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
        );
        
    } catch (Exception $e) {
        die('Erreur: ' .$e->getMessage());
    }
