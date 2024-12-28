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
    <title>Site de recettes - Accueil</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <?php require_once(__DIR__ . '/sections/header.php'); ?>

    <main>
        <div class="hero">
            <h1 class="fw-bold">Partage de recettes</h1>
            <p class='container'>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officiis quae nam harum saepe voluptates dolores, similique possimus sint. 
                Voluptatum natus minus mollitia ducimus autem enim magni qui, facilis consectetur itaque?
            </p>
            <?php if (isset($_SESSION['LOGGED_USER'])) : ?>
                <a href="recipes_create.php" class="btn btn-danger rounded-5">Ajouter une recette !</a>
            <?php endif ; ?>
        </div>

        <div class="container py-5">
            <div class="row row-cols-1 row-cols-sm-2 pb-4 align-items-center">
                <h2>Nos meilleures recettes</h2>
                <div>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cupiditate, aut? Sapiente voluptas omnis quisquam! Officia ratione et eaque doloribus 
                    possimus natus quasi blanditiis repellendus perferendis! Similique dolore optio laboriosam itaque.</div>
            </div>
            <div class="section-recipes">
                <?php foreach($recipes as $recipe) : ?>
                    <article class="recipe-card">
                        <img src="<?php echo $recipe["illustration"]; ?>" class="rounded-5" alt="image-recette">
                        <h4 class="py-2"><a href="recipes_read.php?id=<?php echo($recipe['recipe_id']); ?>" class="text-dark text-decoration-none"><?php echo $recipe["title"]; ?></a></h3>
                        <p class="text-truncate"><?php echo $recipe["recipe"]; ?></p>
                        <i><?php echo displayAuthor($recipe["author"], $users); ?></i>
                        <?php if (isset($_SESSION['LOGGED_USER']) && $recipe['author'] === $_SESSION['LOGGED_USER']['email'])  : ?>
                        <div class="recipe-action">
                            <a href="recipes_update.php?id=<?php echo($recipe['recipe_id']); ?>" class="text-decoration-none">✏️</a>
                            <a href="recipes_delete.php?id=<?php echo($recipe['recipe_id']); ?>" class="text-decoration-none">🗑️</a>
                        </div>
                        <?php endif; ?>
                    </article>
                <?php endforeach ?>
            </div>
        </div>

        <?php require_once(__DIR__ . '/sections/text-image.php'); ?>
        <?php require_once(__DIR__ . '/sections/features.php'); ?>
        <?php require_once(__DIR__ . '/sections/newsletter.php'); ?>
    </main>
    
    <?php require_once(__DIR__ . '/sections/footer.php'); ?>
    
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>