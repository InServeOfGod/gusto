<?php
include_once "layouts/header.php";

$fetcher->about();
$about = $database->getAbout();

?>

<div class="wrapper">
    <header class="main-header">
        <a href="index.php?page=Dashboard" class="logo text-capitalize"><b><?= $user['username'] ?></b></a>
        <?php
        include_once "layouts/navbar.php";
        ?>
    </header>
    <?php
    include_once "layouts/aside.php";
    ?>

    <div class="content-wrapper">
<!--        <a class="btn btn-primary btn-sm margin" href="--><?//= htmlspecialchars($_SERVER['PHP_SELF'])?><!--?page=About&action=create">+ Create</a>-->

        <?php
            $action = $_GET['action'] ?? null;

            if ($action == 'edit') {
                ?>




                <?php
            } else {
        ?>

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Hover Data Table</h3>
            </div>
            <div class="box-body">
                <table id="datatable" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Story</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><p><?= $about['story']?></p></td>
                        <td><a href="../img/<?= $about['photo']?>"><img src="../img/<?= $about['photo']?>" alt="" width="80" height="80" class="img-rounded"></a></td>
                        <td>
                            <a href="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>?page=About&action=edit&id=<?= $about['id']?>" class="btn btn-warning btn-sm col-1">Edit</a>
<!--                            <form action="<?/*= htmlspecialchars($_SERVER['PHP_SELF'])*/?>?page=About&action=delete&id=<?/*= $about['id']*/?>" method="post" class="col-1">
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>-->
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <?php
            }
         ?>
    </div>

<?php
include_once "layouts/footer.php";
