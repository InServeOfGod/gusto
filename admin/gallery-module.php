<?php
$_GET['page'] = 'Gallery';


include_once "layouts/header.php";
?>

    <div class="wrapper">
    <header class="main-header">
        <a href="index.php" class="logo text-capitalize"><b><?= $user['username'] ?></b></a>
        <?php
        include_once "layouts/navbar.php";
        ?>
    </header>
    <?php
    include_once "layouts/aside.php";
    ?>

    <div class="content-wrapper">
        gallery
    </div>

<?php
include_once "layouts/footer.php";
