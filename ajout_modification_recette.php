<?php
require_once("templates/header.php");
require_once("lib/recipe.php");
require_once("lib/category.php");
require_once("lib/tools.php");

// Redirect the user to the login page id he's not logged-in
if(!isset($_SESSION['user'])) {
    header('location: connexion.php');
}

// Get the action in the URL : create or update a recipe
$action = $_GET['action']; // Ajouter ou Modifier

if($action == "Modifier") {
    // Get the id of the recipe in the URL
    $id = $_GET['id'];

    // Get the recipe to update
    $recipeToUpdate = getRecipeById($pdo, (int)$id);
}


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


// Check if the form is full
if(isset($_POST['saveRecipe'])) {

    $fileName = null;
    //print_r($_FILES['image']['tmp_name']);

    // Check if an image file is uploaded
    if(isset($_FILES['image']['tmp_name']) && $_FILES['image']['tmp_name'] != '') {
        $checkImage = getimagesize($_FILES['image']['tmp_name']); // return array|false
        //var_dump($checkImage);
        if($checkImage !== false) {
            $fileName = uniqid().'-'.slugify($_FILES['image']['name']);
            //var_dump($fileName);

            // move the image file to uploads/recipes
            move_uploaded_file($_FILES['image']['tmp_name'], _RECIPES_IMG_PATH_.$fileName);
        } else {
            $errors[] = "Le fichier doit être une image.";
        }
   }

//    if(!$errors) {
//        // Create a new recipe in the database
//        $result = saveRecipe($pdo, (int)$_POST['category_id'], $_POST['title'], $_POST['description'], $_POST['ingredients'], $_POST['instructions'], $fileName);
//        //var_dump($resultat);
//
//        if($result) {
//            $messages[] = "La recette a bien été sauvegardée.";
//        } else {
//            $errors[] = "La recette n'a pas été sauvegardée.";
//        }
//    }

    // Check if the form is correct & update or create the recipe
    if(!$errors && $action == "Modifier") {
        // Update a recipe in the database
        $result = updateRecipe($pdo, (int)$_POST['id'], (int)$_POST['category_id'], $_POST['title'], $_POST['description'], $_POST['ingredients'], $_POST['instructions'], $fileName);

        if($result) {
            $messages[] = "La recette a bien été modifiée.";
        } else {
            $errors[] = "La recette n'a pas été modifiée.";
        }
        //header('location: recettes.php');

    } else if(!$errors) {
        // Create a new recipe in the database
        $result = saveRecipe($pdo, (int)$_POST['category_id'], $_POST['title'], $_POST['description'], $_POST['ingredients'], $_POST['instructions'], $fileName);
        //var_dump($resultat);

        if($result) {
            $messages[] = "La recette a bien été sauvegardée.";
        } else {
            $errors[] = "La recette n'a pas été sauvegardée.";
        }
    }

    $recipe = [
        'title' => $_POST['title'],
        'description'=> $_POST['description'],
        'ingredients' => $_POST['ingredients'],
        'instructions' => $_POST['instructions'],
        'category_id'=> $_POST['category_id']
    ];

    $recipeToUpdate = [
        'id'=> $_POST['id'],
        'title' => $_POST['title'],
        'description'=> $_POST['description'],
        'ingredients' => $_POST['ingredients'],
        'instructions' => $_POST['instructions'],
        'category_id'=> $recipe['category_id']
    ];
 }

?>

<!-- Main -->

<main class="container h-100">
    <div class="row d-flex justify-content-center">

        <div class="col-12">
            <h1 class="text-center"><?= $action; ?>  une recette</h1>
        </div>

        <div class="col-6 pt-md-2">
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

    <div class="row d-flex justify-content-center align-items-center pt-1">
        <div class="col-md-10 col-lg-8">

            <form method="POST" enctype="multipart/form-data" class="border border-secondary rounded p-5">
                <!-- id hidden -->
                <div class="mb-3">
                    <input type="hidden" id="id" name="id" value="<?php if($action == "Modifier"){ echo $recipeToUpdate['id']; } ?>">
                </div>
                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Titre :</label>
                    <input type="text" name="title" id="title" value="<?php if($action == "Modifier"){echo $recipeToUpdate['title']; } else { echo $recipe['title']; }; ?>" class="form-control">
<!--                    <input type="text" name="title" id="title" value="--><?//= $recipe['title'] ?><!--" class="form-control">-->
                </div>
                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description :</label>
                    <textarea name="description" id="description"  cols="30" rows="2" class="form-control"><?php if($action == "Modifier"){ echo $recipeToUpdate['description']; } else { echo $recipe['description']; };  ?> </textarea>
<!--                    <textarea name="description" id="description"  cols="30" rows="2" class="form-control">--><?//= $recipe['description'] ?><!-- </textarea>-->
                </div>
                <!-- Ingredients -->
                <div class="mb-3">
                    <label for="ingredients" class="form-label">Ingredients :</label>
                    <textarea name="ingredients" id="ingredients" cols="30" rows="2" class="form-control"><?php if($action == "Modifier"){ echo $recipeToUpdate['ingredients']; } else { echo $recipe['ingredients']; } ?></textarea>
<!--                    <textarea name="ingredients" id="ingredients" cols="30" rows="2" class="form-control">--><?//= $recipe['ingredients'] ?><!--</textarea>-->
                </div>
                <!-- Instructions -->
                <div class="mb-3">
                    <label for="instructions" class="form-label">Instructions :</label>
                    <textarea name="instructions" id="instructions" cols="30" rows="2" class="form-control"><?php if($action == "Modifier"){ echo $recipeToUpdate['instructions']; } else { echo $recipe['instructions']; } ?></textarea>
<!--                    <textarea name="instructions" id="instructions" cols="30" rows="2" class="form-control">--><?//= $recipe['instructions'] ?><!--</textarea>-->
                </div>
                <!-- Catégory -->
                <div class="mb-3">
                    <label for="category" class="form-label">Catégorie :</label>
                    <select name="category_id" id="category" class="form-select">
<!--                        <option value="">-- Sélectionner la catégorie -- </option>-->
                        <?php foreach($categories as $category) :?>
                            <option value="<?= $category['id']; ?>">
                                <?php if($recipe['category_id'] === (int)$category['id']) echo 'selected = "selected"';?>
                                <?= $category['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Image -->
                <div class="mb-3">
                    <label for="image" class="form-label">Image :</label>
                    <input type="file" name="image" id="image">
                </div>

                <!-- Submit button -->
                <div class="mt-4 w-100 text-center">
                    <input type="submit" name="saveRecipe" value="Enregistrer" class="btn btn-primary">
                </div>
            </form>

        </div>
    </div>

</main>

<?php require_once("templates/footer.php"); ?>

