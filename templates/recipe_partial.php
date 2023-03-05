<!-- Card to display each recipe -->

<div class="col-md-4 my-2">
    <div class="card">
        <img src="<?= getRecipeImage($recipe['image']) ?>" class="card-img-top" alt="<?= $recipe['title']; ?>">
        <div class="card-body">
            <h5 class="card-title"><?= $recipe['title']; ?></h5>
            <p class="card-text"><?= $recipe['description']; ?></p>
            <a href="recette.php?id=<?= $recipe['id']; ?>" class="btn btn-primary">Voir la recette</a>

            <!--  Update a recipe button  -->
            <a href="ajout_modification_Recette.php?action=Modifier&id=<?= $recipe['id'] ?>" class="btn btn-warning text-dark"><i class="fa-solid fa-pen-to-square text-dark"></i></a>

            <!--  Delete a recipe button (data-bs-toggle="modal" to have a modal & data-getId to get the id in JS ) -->
            <a href="#delete-modal" class="btn btn-danger text-dark" data-bs-toggle="modal" data-getId="suppression_recette.php?id=<?= $recipe['id'] ?>"><i class="fa-solid fa-trash"></i></a>
        </div>
    </div>
</div>

<!-- Modal to confirm the deletion of a recipe -->

<div id="delete-modal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Etes-vous sûr de vouloir supprimer cette recette ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ne pas supprimer</button>
                <!-- id got by JavaScript (attribute data-getId) in the footer -->
                <a href="" class="btn btn-primary" id="deleteBtn">Supprimer</a>
            </div>
        </div>
    </div>
</div>