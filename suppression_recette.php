<?php
require_once("templates/header.php");
require_once("lib/recipe.php");
require_once("lib/category.php");
require_once("lib/tools.php");

// Redirect the user to the login page id he's not logged-in
if(!isset($_SESSION['user'])) {
    header('location: connexion.php');
}

$id = $_GET['id'];
$recipeToUpdate = getRecipeById($pdo, (int)$id);

$errors = [];
$messages = [];

$recipe = [
    'title' => '',
    'description'=> '',
    'ingredients' => '',
    'instructions' => '',
    'category_id'=> ''
];

// Get all the categories
$categories = getCategories($pdo);

$result = deleteRecipe($pdo, $id);

if($result) {
    $messages[] = "La recette a bien été supprimée.";
} else {
    $errors[] = "La recette n'a pas été supprimée.";
}



?>

<!-- Main -->

<main class="container h-100">
    <div class="row d-flex justify-content-center">


        <!-- Alert : success or error message -->
        <div class="col-md-6 pt-md-2">
            <?php foreach($messages as $message) : ?>
                <div class="alert alert-success">
                    <?= $message; ?>
                </div>
            <?php endforeach; ?>

            <?php foreach($errors as $error) : ?>
                <div class="alert alert-danger">
                    <?= $error; ?>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</main>

<?php require_once("templates/footer.php"); ?>


