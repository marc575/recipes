<?php 
    session_start();
    require_once(__DIR__ . '/utils/variables.php');
    require_once(__DIR__ . '/utils/functions.php');
    $ID = $_GET['id'];

    $sqlRecipeQuery = 'SELECT * FROM recipes WHERE recipe_id = :id';
    $recipeStatement = $mysqlclient->prepare($sqlRecipeQuery);
    $recipeStatement->execute([
        "id" => $ID,
    ]);
    $recipe = $recipeStatement->fetch();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une recette</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <?php require_once(__DIR__ . '/sections/header.php'); ?>

    <main class='form'>
        <!-- multipart/form-data lorsqu'on veut recuperer des fichiers  -->
        <form action="submit-recipes_update.php?id=<?php echo($ID); ?>" method="POST"  enctype="multipart/form-data" class="card">
            <h3>Modifier une recette !</h3>
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" name="title" id="title" class="form-control rounded-5"
                 placeholder="Titre de la recette" value="<?php echo $recipe['title']; ?>">
            </div>
            <div class="mb-3">
                <label for="recipe" class="form-label">Votre reçette</label>
                <textarea name="recipe" id="recipe" class="form-control rounded-5" 
                placeholder="Exprimez vous" cols="30" rows="5"><?php echo $recipe['recipe']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="illustration" class="form-label">Illustration</label>
                <input type="file" name="illustration" id="illustration" 
                class="form-control rounded-5" value="<?php echo $recipe['illustration']; ?>">
            </div>
            <button type="submit" class="btn btn-danger w-100 rounded-5">Envoyer</button>
        </form>
    </main>
    
    <?php require_once(__DIR__ . '/sections/footer.php'); ?>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>