<div class="col-md-4 my-2">
    <div class="card">
        <img src="<?= getRecipeImage($recipe['image']) ?>" class="card-img-top" alt="<?= $recipe['title']; ?>">
        <div class="card-body">
            <h5 class="card-title"><?= $recipe['title']; ?></h5>
            <p class="card-text"><?= $recipe['description']; ?></p>
            <a href="recette.php?id=<?= $recipe['id']; ?>" class="btn btn-primary">Voir la recette</a>

            <!--  Update & delete buttons  -->
            <a href="ajout_modification_Recette.php?action=Modifier&id=<?= $recipe['id'] ?>" class="btn btn-warning text-dark"><i class="fa-solid fa-pen-to-square text-dark"></i></a>
            <a href="suppression_recette.php?id=<?= $recipe['id'] ?>" class="btn btn-danger text-dark"><i class="fa-solid fa-trash"></i></a>
        </div>
    </div>
</div>