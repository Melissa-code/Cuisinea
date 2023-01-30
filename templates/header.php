<?php
    require_once ("lib/config.php");

    //var_dump($_SERVER['SCRIPT_NAME']); // Cuisinea/recette.php
    $currentPage = (basename($_SERVER['SCRIPT_NAME'])); // recette.php
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Ce Site présente des recettes de cuisine">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/override-bootstrap.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Cuisinea</title>
</head>

<body>

    <!-- Header -->

    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <a href="index.php" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                <img src="assets/images/logo-cuisinea-horizontal.jpg" alt="logo de Cuisinea" width="200">
            </a>

            <ul class="nav nav-pills col-md-auto mb-2 justify-content-center mb-md-0">
                <?php foreach($mainMenu as $key => $value) : ?>
                    <li class="nav-item">
                        <a href="<?= $key; ?>" class="nav-link <?php if($currentPage === $key) { echo 'active'; } ?>"><?= $value; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <div class="col-md-3 text-end">
                <button type="button" class="btn btn-outline-primary me-2">
                    <i class="fa-regular fa-user"></i>
                </button>
                <button type="button" class="btn btn-primary">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </div>
        </header>
    </div>