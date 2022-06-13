<?php
$_GET['page'] = 'Contact';

include_once "layouts/header.php";

$fetcher->contact();
$contacts = $database->getContact();
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

        if ($action == 'delete') {
            $deleter->contact($id);

            // refresh
            $fetcher->contact();
            $contacts = $database->getContact();
        }

        ?>

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Contact Table</h3>
            </div>
            <div class="box-body">
                <table id="datatable" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($contacts as $contact){
                    ?>
                    <tr>
                        <td><p><?= $contact['name']?></p></td>
                        <td><p><?= $contact['email']?></p></td>
                        <td><p><?= $contact['msg']?></p></td>
                        <td><p><?= $contact['created_at']?></p></td>
                        <td>
                        <form action="<?=$self?>?action=delete&id=<?= $contact['id']?>" method="post" class="col-1">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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
    </div>

<?php
include_once "layouts/footer.php";
