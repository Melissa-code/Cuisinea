<?php

/**
 * Get a recipe by id
 * @param PDO $pdo
 * @param int $id
 * @return mixed
 */
function getRecipeById(PDO $pdo, int $id) {
    $query = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
    $query->bindParam(":id", $id, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch();
}

/**
 * display a default image if it doesn't exist in the database
 * @param string|null $image
 * @return string|null
 */
function getRecipeImage(string|null $image) {
    if(!isset($image)) {
        return _ASSETS_IMG_PATH_.'recipe_default.jpg';
    } else {
        return _RECIPES_IMG_PATH_.$image;
    }
}