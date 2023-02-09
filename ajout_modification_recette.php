<?php
require_once("templates/header.php");
require_once("lib/recipe.php");
require_once("lib/category.php");
require_once("lib/tools.php");

$errors = [];
$messages = [];
$recipe = [
     'title' => '',
     'description'=> '',
     'ingredients' =>'',
     'instructions' =>'',
     'category_id'=> ''
     ];
$categories = getCategories($pdo);

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

    if(!$errors) {
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


 }

?>

<!-- Main -->

<main class="container h-100">
    <div class="row d-flex justify-content-center">

        <div class="col-12">
            <h1 class="text-center">Ajouter une recette</h1>
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

            <form action="ajout_modification_recette.php" method="POST" enctype="multipart/form-data" class="border border-secondary rounded p-5">
                <!-- Titre -->
                <div class="mb-3">
                    <label for="title" class="form-label">Titre :</label>
                    <input type="text" name="title" id="title" value="<?= $recipe['title'] ?>" class="form-control">
                </div>
                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description :</label>
                    <textarea name="description" id="description"  cols="30" rows="2" class="form-control"><?= $recipe['description'] ?></textarea>
                </div>
                <!-- Ingredients -->
                <div class="mb-3">
                    <label for="ingredients" class="form-label">Ingredients :</label>
                    <textarea name="ingredients" id="ingredients" cols="30" rows="2" class="form-control"><?= $recipe['ingredients'] ?></textarea>
                </div>
                <!-- Instructions -->
                <div class="mb-3">
                    <label for="instructions" class="form-label">Instructions :</label>
                    <textarea name="instructions" id="instructions" cols="30" rows="2" class="form-control"><?= $recipe['instructions'] ?></textarea>
                </div>
                <!-- Catégorie -->
                <div class="mb-3">
                    <label for="category" class="form-label">Catégorie :</label>
                    <select name="category_id" id="category" class="form-select">
<!--                        <option value="">-- Sélectionner la catégorie -- </option>-->
                        <?php foreach($categories as $category) :?>
                            <option value="<?= $category['id']; ?>">
                                <?php if($recipe['category_id'] === (int)$category['id']) echo 'selected = "selected"'; ?>
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

