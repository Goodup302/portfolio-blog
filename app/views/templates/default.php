<?php
$user = $app->getTable('User');
$dbuser = new \Core\Auth\DBAuth(App::getInstance()->getDatabase());
?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
    <title><?= $app->getTitle() ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>


    <nav class="navbar navbar-expand-md navbar-light">
        <a class="navbar-brand d-flex flex-column text-center align-items-center site_title" href="#">
            <img src="images/logo.svg" width="150" class="text-center" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_navbar_target">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main_navbar_target">
            <div class="navbar-nav header_menu w-100 justify-content-around">
                <a class="nav-item nav-link" href="index.php?p=home">Accueil</a>
                <a class="nav-item nav-link" href="index.php?p=loop">Article</a>
                <a class="nav-item nav-link" href="index.php?p=contact">Contact</a>
                <a class="nav-item nav-link" href="index.php?p=about">Â propos</a>
                <a class="nav-item nav-link" href="index.php?p=auth">Connection</a>
                <a class="nav-item nav-link" href="index.php?p=auth&disconnect=true">Se déconnecter</a>
            </div>
        </div>
    </nav>


    <nav class="col-md-12 d-flex">
        <h1><?= $app->getTitle() ?></h1>
        <?php
        if ($dbuser->isLogged()) {
            echo '<span>Bienvenue '.$user->getById($dbuser->getUserId())->username.'</span>';
        }
        ?>
    </nav>



    <div class="container">
        <div class="row">
            <?= $content ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>