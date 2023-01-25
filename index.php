<?php

    define('_RECIPES_IMG_PATH_', 'uploads/recipes/');

    $recipes = [
        ['title' => 'recette du gratin dauphinois', 'image' => '2-gratin-dauphinois.jpg','content' => 'Some quick example text gratin'],
        ['title' => 'recette de la mousse au chocolat', 'image' => '1-chocolate-au-mousse.jpg', 'content' => "Some quick example text mousse"],
        ['title' => 'recette de la salade niçoise', 'image' => '3-salade.jpg','content' => "Some quick example text salade" ]
    ];

    require_once("templates/header.php");
?>

    <!-- Main -->

    <main class="container">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="assets/images/logo-cuisinea.jpg" class="d-block mx-lg-auto img-fluid" alt="logo de Cuisinea" width="200" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3">Cuisinea - Recettes de cuisine</h1>
                <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Nos recettes</button>
                </div>
            </div>
        </div>

        <div class="row">
            <?php foreach($recipes as $key => $recipe) include("templates/recipe_partial.php"); ?>
        </div>

    </main>

<?php require_once("templates/footer.php"); ?>