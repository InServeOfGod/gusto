<?php
$_GET['page'] = 'Visitors';

include_once "layouts/header.php";

$fetcher->visitors();
$visitors = $database->getVisitors();
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

        if ($action == 'delete') {
            $deleter->visitors($id);

            //refresh
            $fetcher->visitors();
            $visitors = $database->getVisitors();
        }

        ?>

        <section class="content">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Visitors Table</h3>
                </div>
                <div class="box-body">
                    <table id="datatable" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>IPv2 Address</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($visitors as $visitor) {
                        ?>
                        <tr>
                            <td><p><?= $visitor['visitor_ip']?></p></td>
                            <td>
                                <form action="<?=$self?>?action=delete&id=<?= $visitor['id']?>" method="post" class="col-1">
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
        </section>
    </div>

<?php
include_once "layouts/footer.php";
