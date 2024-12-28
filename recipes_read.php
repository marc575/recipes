<?php 
    session_start();
    require_once(__DIR__ . '/utils/variables.php');
    require_once(__DIR__ . '/config/databaseconnect.php');
    require_once(__DIR__ . '/utils/functions.php');

    $id = $_GET['id'];

    $sqlRecipeQuery = 'SELECT * FROM recipes WHERE recipe_id = :id';
    $recipeStatement = $mysqlclient->prepare($sqlRecipeQuery);
    $recipeStatement->execute([
        "id" => $id,
    ]);
    $recipe = $recipeStatement->fetch();

    $sqlCommentsQuery = 'SELECT u.full_name, c.comment, DATE_FORMAT(c.created_at, "%d/%m/%Y") as comment_date FROM users u INNER JOIN comments c ON u.user_id = c.user_id ORDER BY c.created_at DESC';
    $commentsStatement = $mysqlclient->prepare($sqlCommentsQuery);
    $commentsStatement->execute();
    $comments = $commentsStatement->fetchAll();

    $sqlRecipeRatingQuery = 'SELECT ROUND(AVG(c.review), 1) AS rating FROM recipes r LEFT JOIN comments c ON 
    r.recipe_id = c.recipe_id WHERE r.recipe_id = :id';
    $recipeRatingStatement = $mysqlclient->prepare($sqlRecipeRatingQuery);
    $recipeRatingStatement->execute([
        "id" => $id,
    ]);
    $rating = $recipeRatingStatement->fetch();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partage de recettes</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/index.css">
    
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
	<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php require_once(__DIR__ . '/sections/header.php'); ?>

    <main>
        <?php if($recipe) : ?>
        <div class="banner">
            <h2 class="fw-bold">Recettes > <?php echo $recipe["title"]; ?></h2>
        </div>
        <div class="article container pt-5">
            <div class="row">
                <article class="col-md-8">
                    <img src="assets/img/default.jpg" width="100%" class="rounded-top-4" alt="recette-cuisine">
                    <h1 class="py-2"><?php echo $recipe["title"]; ?> <?php if ($rating) {echo $rating['rating'];} ?></h1>
                    <em><?php echo $recipe["recipe"]; ?></em><br>
                    <i class='py-2'><?php echo displayAuthor($recipe["author"], $users); ?></i>
                    <?php if (isset($_SESSION['LOGGED_USER']) && $recipe['author'] === $_SESSION['LOGGED_USER']['email'])  : ?>
                        <ul class="list-group list-group-horizontal list-group-flush justify-content-end">
                            <li class="list-group-item"><a href="recipes_update.php?id=<?php echo($recipe['recipe_id']); ?>" class="link-warning text-decoration-none">✏️</a></li>
                            <li class="list-group-item"><a href="recipes_delete.php?id=<?php echo($recipe['recipe_id']); ?>" class="link-danger text-decoration-none">🗑️</a></li>
                        </ul>
                    <?php endif; ?>
                </article>
                <div class="col-md-4 pt-4 pt-md-0">
                        <?php if (isset($_SESSION['COMMENT_ERROR_MESSAGE'])) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['COMMENT_ERROR_MESSAGE'];
                            unset($_SESSION['COMMENT_ERROR_MESSAGE']); ?>
                        </div>
                        <?php endif ; ?>
                        <h3>Laisser un commentaire</h3>
                        <form action="submit-comment.php?id=<?php echo($recipe['recipe_id']); ?>" method="POST" class="pb-4">
                            <div class="mb-3">
                                <label for="review" class="form-label">Votre note</label>
                                <input type='number' name="review" id="review" class="form-control rounded-5" max='5' min='1' placeholder='1'>
                            </div><div class="mb-3">
                                <label for="comment" class="form-label">Votre commentaire</label>
                                <textarea name="comment" id="comment" class="form-control rounded-5" 
                                placeholder="Exprimez vous" cols="30" rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger w-100 rounded-5">Envoyer</button>
                        </form>
                </div>
            </div>
        <?php endif; ?>
        </div>

        <div class="py-4 container bg-light my-4 rounded-5">
            <div class="comments text-center">
            <?php if($comments) : ?>
                <h3 class="pb-4">Avis clients</h3>
                <div class="swiper-reviews overflow-hidden">
                    <div class="swiper-wrapper">
                    <?php foreach($comments as $comment) : ?>
                    <div class="swiper-slide">
                        <h6><?php echo $comment["comment"]; ?></h6>
                        <em><?php echo $comment["full_name"]; ?></em>
                        <p><?php echo $comment["comment_date"]; ?></p>
                    </div>
                <?php endforeach; ?>
                    </div>
                </div>
            <?php else : ?>
                <p>Aucun commentaire !</p>
            <?php endif; ?>
            </div>
        </div>
    </main>
    
    <?php require_once(__DIR__ . '/sections/footer.php'); ?>
    
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper-reviews', {
        slidesPerView: 1, // Nombre de cartes visibles
        spaceBetween: 30, // Espace entre les cartes
      	centeredSlides: true,
      	mousewheel: true,
		loop: true,
		autoplay: {
			delay: 2500, // Autoplay avec un délai de 2,5 secondes
			disableOnInteraction: false, // Ne pas désactiver l'autoplay lors de l'interaction
		},
        breakpoints: {
			1200: {
                slidesPerView: 4, // Pour les tablettes
            },
            820: {
                slidesPerView: 3, // Pour les tablettes
            },
            480: {
                slidesPerView: 2, // Pour les petits écrans
            }
        }
    });
    </script>
</body>
</html>