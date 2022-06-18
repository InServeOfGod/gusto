<?php

$_GET['page'] = 'Dashboard';

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

        <section class="content">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?= count($menus)?></h3>
                            <p>Products</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="menus-module.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <?php
                            // calculate profit
                            $money = 0;

                            foreach ($profits as $profit) {
                                $money += $profit['profit'];
                                $money -= $profit['loss'];
                            }
                        ?>

                        <div class="inner">
                            <h3><?= ($money < 0) ? '-' : '+', $money ?><sup style="font-size: 20px">$</sup></h3>
                            <p>Profit</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="profits-module.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?= count($contacts)?></h3>
                            <p>Contacts</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="contact-module.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?= count($visitors);?></h3>
                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="visitors-module.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <section class="col-lg-7 connectedSortable">
                    <div class="nav-tabs-custom">
                        <div class="tab-content no-padding">
                            <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                            <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                        </div>
                    </div>

                    <div class="box box-primary">
                        <div class="box-header">
                            <i class="ion ion-clipboard"></i>
                            <h3 class="box-title">To Do List</h3>
                        </div>
                        <div class="box-body">
                            <ul class="todo-list">
                                <?php
                                foreach (array_slice($todo, 0, 5) as $todo_item) {
                                    ?>
                                    <li>
                                        <a href="todo_list-module.php?action=show&id=<?= $todo_item['id']?>">
                                            <h3>
                                                <?= $todo_item['todo']?>
                                                <span class="pull-right"><?php ($todo_item['done']) ? print '&check' : print '&times'?></span>
                                            </h3>
                                            <span class="text-muted">
                                        <?= $todo_item['timestamp']?>
                                    </span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="box-footer clearfix no-border">
                            <a class="btn btn-default pull-right" href="todo_list-module.php?action=create">
                                <i class="fa fa-plus"></i> Add item
                            </a>
                        </div>
                    </div>
                </section>
                <section class="col-lg-5 connectedSortable">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Recently Added Products</h3>
                        </div>
                        <div class="box-body">
                            <ul class="products-list product-list-in-box">
                                <?php
                                foreach (array_slice($menus, 0, 5) as $menu) {
                                ?>
                                <li class="item">
                                    <div class="product-info">
                                        <span class="product-title text-primary">
                                            <?= $menu['title']?>
                                            <span class="label label-primary pull-right">$<?= $menu['price']?></span>
                                        </span>
                                        <span class="product-description"><?= substr($menu['description'], 0, 50)?>...</span>
                                    </div>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="box-footer text-center">
                            <a href="menus-module.php" class="uppercase">View All Products</a>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </div>

<?php
include_once "layouts/footer.php";
