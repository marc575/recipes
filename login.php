<?php 
    session_start();
    require_once(__DIR__ . '/utils/variables.php');
    require_once(__DIR__ . '/utils/functions.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Créer un compte</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <?php require_once(__DIR__ . '/sections/header.php'); ?>

    <main class="form">
        <?php if (!isset($_SESSION['LOGGED_USER'])) : ?>
            <form action="submit-login.php" method="post" class="card">
                <h3>Se connecter</h3>
                <?php if (isset($_SESSION['LOGIN_ERROR_MESSAGE'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_SESSION['LOGIN_ERROR_MESSAGE'];
                        unset($_SESSION['LOGIN_ERROR_MESSAGE']); ?>
                    </div>
                <?php endif ; ?>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control rounded-5" placeholder="you@exemple.com">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control rounded-5" placeholder="Mot de passe">
                </div>
                <button type="submit" class="btn btn-danger w-100 rounded-5">Envoyer</button>
            </form>

        <?php else : ?>
            <div class="alert alert-success" role="alert">
                Bonjour <?php echo displayAuthor($_SESSION['LOGGED_USER']['email'], $users); ?> et bienvenue sur le site !
            </div>
        <?php endif ; ?>
            
    </main>
    
    <?php require_once(__DIR__ . '/sections/footer.php'); ?>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>