<?php
$user = $app->getTable('User');
$dbuser = new \Core\Auth\DBAuth(App::getInstance()->getDatabase());
?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
    <title><?= $app->getTitle() ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <nav>
        <h1><?= $app->getTitle() ?></h1>
        <?php
        if ($dbuser->isLogged()) {
            echo '<span>Bienvenue '.$user->getById($dbuser->getUserId())->username.'</span>';
        }
        ?>
    </nav>
    <?= $content ?>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

</body>
</html>