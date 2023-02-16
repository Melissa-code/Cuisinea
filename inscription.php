<?php
require_once("templates/header.php");
require_once("lib/user.php");

$errors = [];
$messages = [];

if(isset($_POST['addUser'])) {
    $res = addUser($pdo, $_POST['firstname'], $_POST['lastname'], $_POST['login'], $_POST['password']);
    if($res) {
        $messages[] = "Votre inscription a bien été enregistrée.";
    } else {
        $errors[] = "Une erreur est survenue lors de votre inscription.";
    }

}


?>

<!-- Main -->

<main class="container h-100">
    <div class="row d-flex justify-content-center">

        <div class="col-12">
            <h1 class="text-center"> Inscription </h1>
        </div>

        <div class="col-6 pt-md-2">
            <?php foreach($messages as $message) : ?>
                <div class="alert alert-success text-center">
                    <?= $message; ?>
                </div>
            <?php endforeach; ?>

            <?php foreach($errors as $error) : ?>
                <div class="alert alert-danger text-center">
                    <?= $error; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="row d-flex justify-content-center align-items-center pt-1">
        <div class="col-md-10 col-lg-8">

            <form action="" method="POST" enctype="multipart/form-data" class="border border-secondary rounded p-5">
                <!-- Firstname -->
                <div class="mb-3">
                    <label for="firstname" class="form-label">Votre prénom :</label>
                    <input type="text" name="firstname" id="firstname" value="" class="form-control" placeholder="Ex: Alain">
                </div>
                <!-- Lastname -->
                <div class="mb-3">
                    <label for="lastname" class="form-label">Votre nom :</label>
                    <input type="text" name="lastname" id="lastname" value="" class="form-control" placeholder="Ex: Dupont">
                </div>
                <!-- Login / Email -->
                <div class="mb-3">
                    <label for="login" class="form-label">Votre email :</label>
                    <input type="email" name="login" id="login" value="" class="form-control" placeholder="Ex: alain@gmail.com">
                </div>
                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Votre mot de passe :</label>
                    <input type="password" name="password" id="password" value="" class="form-control" placeholder="Ex: *********">
                </div>
                <!-- Submit button -->
                <div class="mt-4 w-100 text-center">
                    <input type="submit" name="addUser" value="S'inscrire'" class="btn btn-primary">
                </div>
            </form>

        </div>
    </div>

</main>



<?php
require_once("templates/footer.php");
?>
