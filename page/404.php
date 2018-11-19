<p>
    <?php
    if (isset($_GET['error']) && $_GET['error'] != null) {
        echo $_GET['error'];
    } else {
        echo \App\App::PAGE_NOT_FOUND;
    }
    ?>
</p>