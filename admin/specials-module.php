<?php
$_GET['page'] = 'Specials';


include_once "layouts/header.php";

$fetcher->specials();
$specials = $database->getSpecials();
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
        <?php
        $self = htmlspecialchars($_SERVER['PHP_SELF']);
        ?>

        <?php
        $action = $_GET['action'] ?? null;
        $id = $_GET['id'] ?? null;
        $upload_ok = true;

        if (isset($_POST['update'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $file = $_FILES['photo'];
            $error = $_FILES['photo']['error'];
            $upload_dir = "../img/";

            foreach ($specials as $special) {
                if ($special['id'] == $id) {
                    break;
                }
            }

            if ($error == UPLOAD_ERR_OK) {
                $filename = basename(date('d.m.Y-h:i:s', time()).'-'.$file["name"]);
                $target_file = $upload_dir . $filename;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                    $upload_ok = false;
                }

                if ($upload_ok) {
                    if (!move_uploaded_file($file['tmp_name'], $target_file)) {
                        $upload_ok = false;
                    }

                    else {
                        unlink($upload_dir . $special['photo']);
                        $updater->specials([$title, $filename, $description, $id]);
                    }
                }
            }

            else if ($error !== UPLOAD_ERR_NO_FILE) {
                $upload_ok = false;
            }

            else {
                $updater->specials([$title, $special['photo'], $description, $id]);
            }
        }

        else if ($action == "create") {
            ?>
            <section class="content">
                <a href="specials-module.php" class="btn btn-sm btn-primary" style="margin: 1em 0">&langle; Go back</a>

                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Create Form</h3>

                                <form action="<?=$self?>?action=store" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="title">Title : </label>
                                            <textarea id="title" name="title" class="form-control" placeholder="type in your title..."></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Description : </label>
                                            <textarea id="description" name="description" class="form-control" placeholder="type in your description..."></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="photo">Image File : </label>
                                            <input type="file" name="photo" id="photo" accept="image/*" class="form-control">
                                            <p class="help-block">
                                                <span class="text-muted">Select One Photo File (*.jpg, *.jpeg, *.png) - (~<?= ini_get('upload_max_filesize')?>)</span>
                                            </p>
                                            <p class="help-block">
                                                <?php
                                                if (!$upload_ok) {
                                                    ?>
                                                    <span class="text-danger">File uploading failed</span>
                                                    <?php
                                                }
                                                ?>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" name="store">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
        }

        else if ($action == 'edit') {
//                refresh
            $fetcher->specials();
            $specials = $database->getSpecials();
            $title = $description = $file = null;

            foreach ($specials as $special) {
                if ($special['id'] == $id) {
                    $title = $special['title'];
                    $description = $special['description'];
                    $file = $special['photo'];
                }
            }
            ?>

            <section class="content">
                <a href="specials-module.php" class="btn btn-sm btn-primary" style="margin: 1em 0">&langle; Go back</a>

                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Edit Form</h3>

                                <form action="<?=$self?>?action=edit&id=<?=$id?>" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="title">Title : </label>
                                            <textarea id="title" name="title" class="form-control" placeholder="type in your title..."><?=$title?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Description : </label>
                                            <textarea id="description" name="description" class="form-control" placeholder="type in your description..."><?=$description?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="photo">Image File : </label>
                                            <input type="file" name="photo" id="photo" accept="image/*" class="form-control">
                                            <img src="../img/<?= $file?>" alt="" width="64" height="64">
                                            <p class="help-block">
                                                <span class="text-muted">Select One Photo File (*.jpg, *.jpeg, *.png) - (~<?= ini_get('upload_max_filesize')?>)</span>
                                            </p>
                                            <p class="help-block">
                                                <?php
                                                if (!$upload_ok) {
                                                    ?>
                                                    <span class="text-danger">File uploading failed</span>
                                                    <?php
                                                }
                                                ?>
                                            </p>
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
            if ($action == "delete") {
                $deleter->specials($id);

//                refresh
                $fetcher->specials();
                $specials = $database->getSpecials();
            }

            if ($action == "store" && isset($_POST['store'])) {
                $inserter->specials([$_POST['title'], $_POST['description']]);
            }

            ?>
            <a class="btn btn-primary btn-sm margin" href="<?=$self?>?action=create">+ Create</a>

        <section class="content">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Specials Table</h3>
                </div>
                <div class="box-body">
                    <table id="datatable" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($specials as $special) {?>
                        <tr>
                            <td><p><?= $special['title']?></p></td>
                            <td><p><?= $special['description']?></p></td>
                            <td><a href="../img/<?= $special['photo']?>"><img src="../img/<?= $special['photo']?>" alt="" width="80" height="80" class="img-rounded"></a></td>
                            <td>
                                <a href="<?=$self?>?action=edit&id=<?= $special['id']?>" class="btn btn-warning btn-sm col-1" style="float: left">Edit</a>
                                <form action="<?=$self?>?action=delete&id=<?= $special['id']?>" method="post" class="col-1" style="float: left">
                                    <input type="submit" class="btn btn-sm btn-danger" value="Delete" name="delete">
                                </form>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
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
