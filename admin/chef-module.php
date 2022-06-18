<?php
$_GET['page'] = 'Chef';

include_once "layouts/header.php";

$fetcher->chef();
$chef = $database->getChef();
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
        $upload_ok = true;

        if (isset($_POST['update'])) {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $file = $_FILES['photo'];
            $error = $_FILES['photo']['error'];
            $upload_dir = "../img/";

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
                        unlink($upload_dir . $chef['photo']);
                        $updater->chef([$title, $description, $filename, $id]);
                    }
                }
            }

            else if ($error !== UPLOAD_ERR_NO_FILE) {
                $upload_ok = false;
            }

            else {
                $updater->chef([$title, $description, $chef['photo'], $id]);
            }
        }

        if ($action == 'edit') {
//                refresh
            $fetcher->chef();
            $chef = $database->getChef();

            $description = $chef['description'];
            $title = $chef['title'];
            $file = $chef['photo'];
            ?>

            <section class="content">
                <a href="chef-module.php" class="btn btn-sm btn-primary" style="margin: 1em 0">&langle; Go back</a>

                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Edit Form</h3>

                                <form action="<?=$self?>?action=edit&id=<?=$id?>" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="title">Title : </label>
                                            <input type="text" id="title" name="title" class="form-control" placeholder="type in your title..." value="<?=$title?>">
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
            ?>

        <section class="content">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Chef Table</h3>
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
                        <tr>
                            <td><p><?= $chef['title']?></p></td>
                            <td><p><?= $chef['description']?></p></td>
                            <td><a href="../img/<?= $chef['photo']?>"><img src="../img/<?= $chef['photo']?>" alt="" width="80" height="80" class="img-rounded"></a></td>
                            <td>
                                <a href="<?=$self?>?action=edit&id=<?= $chef['id']?>" class="btn btn-warning btn-sm col-1">Edit</a>
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
