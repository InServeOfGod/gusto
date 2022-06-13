<?php
$_GET['page'] = 'Contact Info';

include_once "layouts/header.php";

$fetcher->contactInfo();
$contactInfo = $database->getContactInfo();
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

        if (isset($_POST['update'])) {
            $phone_number = $_POST['phone_number'];
            $address = $_POST['address'];
            $week_work_from = $_POST['week_work_from'];
            $week_work_to = $_POST['week_work_to'];
            $weekend_work_from = $_POST['weekend_work_from'];
            $weekend_work_to = $_POST['weekend_work_to'];

            $updater->contactInfo([$phone_number, $address, $week_work_from, $week_work_to, $weekend_work_from, $weekend_work_to, $id]);
        }

        if ($action == 'edit') {
//                refresh
            $fetcher->contactInfo();
            $contactInfo = $database->getContactInfo();

            $phone_number = $contactInfo['phone_number'];
            $address = $contactInfo['address'];
            $week_work_from = $contactInfo['week_work_from'];
            $week_work_to = $contactInfo['week_work_to'];
            $weekend_work_from = $contactInfo['weekend_work_from'];
            $weekend_work_to = $contactInfo['weekend_work_to'];
        ?>

            <section class="content">
                <a href="contact_info-module.php" class="btn btn-sm btn-primary" style="margin: 1em 0">&langle; Go back</a>

                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Edit Form</h3>

                                <form action="<?=$self?>?action=edit&id=<?=$id?>" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="phone_number">Phone Number : </label>
                                            <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="type in your phone number..." value="<?=$phone_number?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address : </label>
                                            <input type="text" id="address" name="address" class="form-control" placeholder="type in your address..." value="<?=$address?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="week_work_from">In Week Work From : </label>
                                            <input type="time" id="week_work_from" name="week_work_from" class="form-control" placeholder="00:00" value="<?=($week_work_from)?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="week_work_to">In Week Work To : </label>
                                            <input type="time" id="week_work_to" name="week_work_to" class="form-control" placeholder="00:00" value="<?=($week_work_to)?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="weekend_work_from">In Weekend Work From : </label>
                                            <input type="time" id="weekend_work_from" name="weekend_work_from" class="form-control" placeholder="00:00" value="<?=($weekend_work_from)?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="weekend_work_to">In Weekend Work To : </label>
                                            <input type="time" id="weekend_work_to" name="weekend_work_to" class="form-control" placeholder="00:00" value="<?=($weekend_work_to)?>">
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
                    <h3 class="box-title">Phone Table</h3>
                </div>
                <div class="box-body">
                    <table id="datatable" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>In Week Working From</th>
                            <th>In Week Working To</th>
                            <th>In Weekend Working From</th>
                            <th>In Weekend Working To</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><p><?= $contactInfo['phone_number']?></p></td>
                            <td><p><?= $contactInfo['address']?></p></td>
                            <td><p><?= $contactInfo['week_work_from']?></p></td>
                            <td><p><?= $contactInfo['week_work_to']?></p></td>
                            <td><p><?= $contactInfo['weekend_work_from']?></p></td>
                            <td><p><?= $contactInfo['weekend_work_to']?></p></td>
                            <td>
                                <a href="<?=$self?>?action=edit&id=<?= $contactInfo['id']?>" class="btn btn-warning btn-sm col-1">Edit</a>
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
