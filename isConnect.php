<?php 
    if (!isset($_SESSION['LOGGED_USER'])) {
        echo('il faut etre authentifié pour effectuer cette action.');
        exit;
    }
