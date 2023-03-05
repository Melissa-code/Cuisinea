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
 * Display a default image if it doesn't exist in the database
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

/**
 * Get all the recipes or limit number only ($limit is optional : for the home page)
 * @param PDO $pdo
 * @param int|null $limit
 * @return array
 */
function getRecipes(PDO $pdo, int $limit = null) {
    /* To get random recipes */
    //$sql = "SELECT * from recipes ORDER BY RAND() DESC";
    $sql = "SELECT * from recipes ORDER BY id DESC";

    if($limit) {
        $sql .= " LIMIT :limit";
    }
    $query = $pdo->prepare($sql);
    if($limit) {
        $query->bindParam(":limit", $limit, PDO::PARAM_INT);
    }

    $query->execute();
    return $query->fetchAll();
}

/**
 * Create a new recipe
 * @param PDO $pdo
 * @param int $category_id
 * @param string $title
 * @param string $description
 * @param string $ingredients
 * @param string $instructions
 * @param string|null $image
 * @return bool
 */
function saveRecipe(PDO $pdo, int $category_id, string $title, string $description, string $ingredients, string $instructions, string|null $image) {
    $sql = "INSERT INTO recipes (id, category_id, title, description, ingredients, instructions, image) VALUES (NULL, :category_id, :title, :description, :ingredients, :instructions, :image)";
    $query = $pdo->prepare($sql);
    $query->bindParam(":category_id", $category_id, PDO::PARAM_INT);
    $query->bindParam(":title", $title, PDO::PARAM_STR);
    $query->bindParam(":description", $description, PDO::PARAM_STR);
    $query->bindParam(":ingredients", $ingredients, PDO::PARAM_STR);
    $query->bindParam(":instructions", $instructions, PDO::PARAM_STR);
    $query->bindParam(":image", $image, PDO::PARAM_STR);
    return $query->execute();
}

/**
 * Update a recipe
 * @param PDO $pdo
 * @param int $id
 * @param int $category_id
 * @param string $title
 * @param string $description
 * @param string $ingredients
 * @param string $instructions
 * @param string|null $image
 * @return bool
 */
function updateRecipe(PDO $pdo, int $id, int $category_id, string $title, string $description, string $ingredients, string $instructions, string|null $image) {

//    var_dump($id);
//    var_dump($category_id);
//    var_dump($title);
//    var_dump($description);
//    var_dump($ingredients);
//    var_dump($instructions);
//    var_dump($image);

    $sql = "UPDATE recipes SET category_id = :category_id, title = :title, description = :description, ingredients = :ingredients, instructions = :instructions, image = :image WHERE id = :id";
    $query = $pdo->prepare($sql);
    $query->bindParam(":category_id", $category_id, PDO::PARAM_INT);
    $query->bindParam(":title", $title, PDO::PARAM_STR);
    $query->bindParam(":description", $description, PDO::PARAM_STR);
    $query->bindParam(":ingredients", $ingredients, PDO::PARAM_STR);
    $query->bindParam(":instructions", $instructions, PDO::PARAM_STR);
    $query->bindParam(":image", $image, PDO::PARAM_STR);
    $query->bindParam(":id", $id, PDO::PARAM_INT);
    return $query->execute();
}