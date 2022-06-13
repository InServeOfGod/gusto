<?php
$_GET['page'] = 'About';

include_once "layouts/header.php";

$fetcher->about();
$head = $database->getAbout();
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

        $action = $_GET['action'] ?? null;
        $id = $_GET['id'] ?? null;
        $upload_ok = true;

        if (isset($_POST['update'])) {
            $story = $_POST['story'];
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
                        unlink($upload_dir . $head['photo']);
                        $updater->about([$story, $filename, $id]);
                    }
                }
            }

            else if ($error !== UPLOAD_ERR_NO_FILE) {
                $upload_ok = false;
            }

            else {
                $updater->about([$story, $head['photo'], $id]);
            }
        }

        if ($action == 'edit') {
//                refresh
            $fetcher->about();
            $head = $database->getAbout();

            $story = $head['story'];
            $file = $head['photo'];
        ?>

            <section class="content">
                <a href="about-module.php" class="btn btn-sm btn-primary" style="margin: 1em 0">&langle; Go back</a>

                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Edit Form</h3>

                                <form action="<?=$self?>?action=edit&id=<?=$id?>" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="story">Story : </label>
                                            <textarea id="story" name="story" class="form-control" placeholder="type in your story..."><?=$story?></textarea>
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

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">About Table</h3>
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
                        <td><p><?= $head['story']?></p></td>
                        <td><a href="../img/<?= $head['photo']?>"><img src="../img/<?= $head['photo']?>" alt="" width="80" height="80" class="img-rounded"></a></td>
                        <td>
                            <a href="<?=$self?>?action=edit&id=<?= $head['id']?>" class="btn btn-warning btn-sm col-1">Edit</a>
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
