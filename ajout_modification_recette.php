<?php
require_once("templates/header.php");
require_once("lib/recipe.php");
require_once("lib/tools.php");

if(isset($_POST['saveRecipe'])) {
    //var_dump($_POST);
    $resultat = saveRecipe($pdo, (int)$_POST['category_id'], $_POST['title'], $_POST['description'], $_POST['ingredients'], $_POST['instructions'], null);
    var_dump($resultat);
 }

?>

<!-- Main -->

<main class="container h-100">

    <div class="row d-flex justify-content-center align-items-center py-5">
        <div class="col-md-10 col-lg-8">

            <form action="ajout_modification_recette.php" method="POST" enctype="multipart/form-data" class="border border-secondary rounded p-5">
                <!-- Titre -->
                <div class="mb-3">
                    <label for="title" class="form-label">Titre :</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description :</label>
                    <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
                </div>
                <!-- Ingredients -->
                <div class="mb-3">
                    <label for="ingredients" class="form-label">Ingredients :</label>
                    <textarea name="ingredients" id="ingredients" cols="30" rows="5" class="form-control"></textarea>
                </div>
                <!-- Instructions -->
                <div class="mb-3">
                    <label for="instructions" class="form-label">Instructions :</label>
                    <textarea name="instructions" id="instructions" cols="30" rows="5" class="form-control"></textarea>
                </div>
                <!-- Catégorie -->
                <div class="mb-3">
                    <label for="category" class="form-label">Catégorie :</label>
                    <select name="category_id" id="category" class="form-select">
                        <option value="">-- Sélectionner la catégorie -- </option>
                        <option value="1">Entrée</option>
                        <option value="2">Plat</option>
                        <option value="3">Dessert</option>
                    </select>
                </div>
                <!-- Image -->
                <div class="mb-3">
                    <label for="image" class="form-label">Image :</label>
                    <input type="file" name="image" id="image">
                </div>

                <!-- Submit button -->
                <div class="mt-3 w-100 text-center">
                    <input type="submit" name="saveRecipe" value="Enregistrer" class="btn btn-primary">
                </div>
            </form>

        </div>
    </div>

</main>

<?php require_once("templates/footer.php"); ?>

