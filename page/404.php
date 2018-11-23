<?php
use App\App;
use App\Config;

$app->setTitle('Page introuvable');
?>
<p>
    <?php
    if (isset($_GET['error']) && $_GET['error'] != null) {
        echo $_GET['error'];
    } else {
        echo Config::getInstance()->get('page_not_found');
    }
    ?>
</p>