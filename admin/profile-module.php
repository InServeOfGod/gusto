<?php
$_GET['page'] = 'Profile';

include_once "layouts/header.php";

$fetcher->user();
$user = $database->getUser();
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
            $username = $_POST['username'];
            $password = $_POST['password'];
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
                        unlink($upload_dir . $user['photo']);
                        if (empty($password)) {
                            $updater->user([$username, $user['password'], $filename, $id]);
                        } else {
                            $updater->user([$username, md5($password), $filename, $id]);
                        }
                    }
                }
            }

            else if ($error !== UPLOAD_ERR_NO_FILE) {
                $upload_ok = false;
            }

            else {
                if (empty($password)) {
                    $updater->user([$username, $user['password'], $user['photo'], $id]);
                } else {
                    $updater->user([$username, md5($password), $user['photo'], $id]);
                }
            }
        }

        if ($action == 'edit') {
//                refresh
            $fetcher->user();
            $user = $database->getUser();

            $username = $user['username'];
            $password = $user['password'];
            $file = $user['photo'];
            ?>

            <section class="content">
                <a href="profile-module.php" class="btn btn-sm btn-primary" style="margin: 1em 0">&langle; Go back</a>

                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Edit Form</h3>

                                <form action="<?=$self?>?action=edit&id=<?=$id?>" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="username">Username : </label>
                                            <input type="text" id="username" name="username" class="form-control" placeholder="type in your username..." value="<?=$username?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password : </label>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="type in your password...">
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
                    <h3 class="box-title">Profile Table</h3>
                </div>
                <div class="box-body">
                    <table id="datatable" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><p><?= $user['username']?></p></td>
                            <td><p>*****</p></td>
                            <td><a href="../img/<?= $user['photo']?>"><img src="../img/<?= $user['photo']?>" alt="" width="80" height="80" class="img-rounded"></a></td>
                            <td>
                                <a href="<?=$self?>?action=edit&id=<?= $user['id']?>" class="btn btn-warning btn-sm col-1">Edit</a>
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
