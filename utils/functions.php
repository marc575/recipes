<?php

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

        return "Auteur inconnu";
    }

    function isAllowed(array $recipe) : bool {
        if (array_key_exists('status', $recipe)) {
            $isEnabled = $recipe['status'];
        } else {
            $isEnabled = false;
        }

        return $isEnabled . PHP_EOL ;
    }

    function redirectToUrl(string $url) : never {
        header("Location: {$url}");
        exit();
    }