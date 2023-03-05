<?php
    require_once("templates/header.php");
    require_once("lib/recipe.php");

    $recipes = getRecipes($pdo);
?>

<!-- Main -->

<main class="container">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
        <h1 class="text-center"> Liste des recettes </h1>
    </div>


    <div class="row">
        <!-- include as many times as possible the recipes cards -->
        <?php foreach($recipes as $key => $recipe) include("templates/recipe_partial.php"); ?>
    </div>

</main>

<?php require_once("templates/footer.php"); ?>
