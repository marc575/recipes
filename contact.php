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
    <title>Site de recettes - Contact</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <?php require_once(__DIR__ . '/sections/header.php'); ?>

    <main class='form'>
        <!-- multipart/form-data lorsqu'on veut recuperer des fichiers  -->
        <form action="submit-contact.php" method="POST" enctype="multipart/form-data" class="card">
            <h3>Contactez nous</h3>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control rounded-5">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Votre message</label>
                <textarea name="message" id="message" class="form-control rounded-5" 
                placeholder="Exprimez vous" cols="30" rows="5"></textarea>
            </div>
            <div class="mb-3">
                <label for="screenshot" class="form-label">Capture d'écran</label>
                <input type="file" name="screenshot" id="screenshot" class="form-control rounded-5">
            </div>
            <button type="submit" class="btn btn-danger w-100 rounded-5">Envoyer</button>
        </form>
    </main>
    
    <?php require_once(__DIR__ . '/sections/footer.php'); ?>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>