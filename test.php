<?php 

    setcookie (
        'LOGGED_USER',
        'utilisateur@exemple.com',
        [
            'expires' => time() + 365*24*3600,
            'secure' => true,
            'httponly' => true,
        ]
    );

    $recipes = [
        [
            'title' => 'riz',
            'author' => 'marc',
            'recipe' => '[...]',
            'status' => true
        ],
        [
            'title' => 'spaghetti',
            'author' => 'andrew',
            'recipe' => '[...]',
            'status' => false
        ],
        [
            'title' => 'couscous',
            'author' => 'mathieu',
            'recipe' => '[...]',
            'status' => true
        ],
        [
            'title' => 'lazaine',
            'author' => 'laurene',
            'recipe' => '[...]',
            'status' => false
        ],
    ];
    $users = [
        [
            'full_name' => 'Mickael Andriew',
            'email' => 'mickael.andrew@exemple.com',
            'age' => 34,
        ],
        [
            'full_name' => 'Mathieu Nebra',
            'email' => 'mathieu.nebra@exemple.com',
            'age' => 34,
        ],
        [
            'full_name' => 'Laurene Castor',
            'email' => 'laurene.castor@exemple.com',
            'age' => 28,
        ],
    ];
    $recipe = [
        'title' => 'riz',
        'author' => 'marc',
        'recipe' => '[...]',
        'status' => true
    ];

    function getRecipes(array $recipes) : array {
        $allowRecipes = [];
        foreach ($recipes as $recipe) {
            if ($recipe['status']) {
                $allowRecipes[] = $recipe;
            }
        }
        return $allowRecipes;
    }

    function displayAuthor(string $authorEmail, array $users) : string {
        foreach ($users as $user) {
            if ($authorEmail === $user['email']) {
                return $user['full_name'];
            }
        }
    }

    function isAllowed(array $recipe) : bool {
        if (array_key_exists('status', $recipe)) {
            $isEnabled = $recipe['status'];
        } else {
            $isEnabled = false;
        }

        return $isEnabled . PHP_EOL ;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes</title>
</head>
<body>
    <?php require_once(__DIR__ . '/header.php') ?>

    <h1>Listes des recettes</h1>
    <?php 

    $allowRecipes = getRecipes($recipes);

    $isPossible = isAllowed($recipe);

    ?>

    <?php 
    echo sprintf(
        '%s par "%s" : %s',
        $recipe['title'],
        $recipe['author'],
        $recipe['recipe'],
    );

    $date = date('H \H i, d/m/Y');
    echo '<br><br>'. $date .'<br><br>';

    foreach($recipe as $property => $propertyValue) { // parcours en recuperant la clé et la valeur
        echo '[' . $property . '] vaut ' . $propertyValue . '<br>';
    }
    ?>
    <?php 
        if(array_key_exists('title', $recipe)) { //verifie si une clé existe
            echo "vrai <br>";
        }; 
        
        if(in_array('riz', $recipe)) { //verifie si une valeur existe