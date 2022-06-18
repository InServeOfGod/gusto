<?php
$_GET['page'] = 'Social Media';

include_once "layouts/header.php";

$fetcher->social_media();
$socialMedia = $database->getSocialMedia();
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
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><?= $_GET['page'] ?? null?></li>
            </ol>
        </section>

        <?php
        $self = htmlspecialchars($_SERVER['PHP_SELF']);
        $action = $_GET['action'] ?? null;
        $id = $_GET['id'] ?? null;

        if (isset($_POST['update'])) {
            $facebook = $_POST['facebook'];
            $instagram = $_POST['instagram'];
            $youtube = $_POST['youtube'];

            $updater->social_media([$facebook, $instagram, $youtube, $id]);
        }

        if ($action == 'edit') {
//                refresh
            $fetcher->social_media();
            $socialMedia = $database->getSocialMedia();

            $facebook = $socialMedia['facebook'];
            $instagram = $socialMedia['instagram'];
            $youtube = $socialMedia['youtube'];
            ?>

            <section class="content">
                <a href="social_media-module.php" class="btn btn-sm btn-primary" style="margin: 1em 0">&langle; Go back</a>

                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Edit Form</h3>

                                <form action="<?=$self?>?action=edit&id=<?=$id?>" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="facebook">Facebook Page : </label>
                                            <input type="url" id="facebook" name="facebook" class="form-control" placeholder="type in your facebook URL..." value="<?=$facebook?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="instagram">Instagram Page : </label>
                                            <input type="url" id="instagram" name="instagram" class="form-control" placeholder="type in your instagram URL..." value="<?=$instagram?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="youtube">Youtube Page : </label>
                                            <input type="url" id="youtube" name="youtube" class="form-control" placeholder="type in your youtube URL..." value="<?=$youtube?>">
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" name="update">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <?php
        } else {
            ?>

        <section class="content">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Social Media Table</h3>
                </div>
                <div class="box-body">
                    <table id="datatable" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Facebook</th>
                            <th>Instagram</th>
                            <th>Youtube</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><p><?= $socialMedia['facebook']?></p></td>
                            <td><p><?= $socialMedia['instagram']?></p></td>
                            <td><p><?= $socialMedia['youtube']?></p></td>
                            <td>
                                <a href="<?=$self?>?action=edit&id=<?= $socialMedia['id']?>" class="btn btn-warning btn-sm col-1">Edit</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

            <?php
        }
        ?>
    </div>

<?php
include_once "layouts/footer.php";
