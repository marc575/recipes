<?php 
    $postDatas = $_POST;
    if (!isset($postDatas['email']) || !filter_var($postDatas['email'], FILTER_VALIDATE_EMAIL)
        || empty($postDatas['message']) || trim($postDatas['message']) === '') {
        echo('Il faut un email et un message pour soumettre le formulaire');
        return;
    }
    
    $postFile = $_FILES;
    if (isset($postFile['screenshot']) && $postFile['screenshot']['error'] == 0) {

        if ($postFile['screenshot']['error'] > 1000000) {
            echo('L envoie n a pas pu etre effectué, erreur ou image trop volumineuse');
            return;
        }

        $fileInfo = pathinfo($postFile['screenshot']['name']);
        $extension = $fileInfo['extension'];
        $allowedExtensions = ["jpg", "jpeg", "gif", "png"];
        if (!in_array($extension, $allowedExtensions)) {
            echo "l envoi n'a pas pu etre effectué, l'extension {$extension} n'est pas pris en charge";
            return;
        }

        $path = __DIR__ . '/uploads/';
        if (!is_dir($path)) {
            echo "l envoi n'a pas pu etre effectué, le dossier uploads est manquant";
            return;
        }

        move_uploaded_file($_FILES['screenshot']['tmp_name'], $path . basename($_FILES['screenshot']['name']));

    }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Accusé de reception</title>
    
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <?php require_once(__DIR__ . '/sections/header.php'); ?>

    <main class='banner py-5'>
        <div class="card my-5 shadow">
            <h3>Accusé de reception</h3>
            <div class="card-body">
                <p class="card-text"><b>Email</b> : <?php echo $postDatas['email']; ?></p>
                <!-- htmlspecialchars() annule les effets des balises  -->
                <!-- strip_tags() efface les balises  -->
                <p class='card-text'><b>Message</b> : <?php echo strip_tags($postDatas['message']); ?></p>
            </div>
        </div>
    </main>
    
    <?php require_once(__DIR__ . '/sections/footer.php'); ?>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>