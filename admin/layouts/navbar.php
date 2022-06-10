<nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-envelope-o"></i>
                    <?php
                        $message_count = count($contacts);
                    ?>
                    <span class="label label-success"><?= $message_count ?></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">You have <?= $message_count ?> message(s)</li>
                    <li>
                        <ul class="menu">
                            <?php
                                foreach ($contacts as $contact) {
                            ?>
                            <li>
                                <a href="contact-module.php?page=Contacts&action=show&id=<?= $contact['id']?>">
                                    <h4>
                                        <?= $contact['name']?>
                                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                    </h4>
                                    <p><?= substr($contact['msg'], 0, 25) ?>...</p>
                                </a>
                            </li>
                            <?php
                                }
                            ?>
                        </ul>
                    </li>
                    <li class="footer"><a href="contact-module.php?page=Contacts">See All Messages</a></li>
                </ul>
            </li>
            <li class="dropdown tasks-menu">
                <?php
                $todo_count = count($todo);
                ?>

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-flag-o"></i>
                    <span class="label label-danger"><?= $todo_count ?></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="header">You have <?= $todo_count ?> task(s)</li>
                    <li>
                        <ul class="menu">
                            <?php
                            foreach ($todo as $todo_item) {
                            ?>
                            <li>
                                <a href="todo-module.php?page=Todo&action=show&id=<?= $todo_item['id']?>">
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
                    </li>
                    <li class="footer">
                        <a href="todo-module.php?page=Todo">View all tasks</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown user user-menu">
                <a href="profile-module.php?page=Profile" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="../img/<?= $user['photo']?>" class="user-image" alt="User Image"/>
                    <span class="hidden-xs"><?= $user['username']?></span>
                </a>
                <ul class="dropdown-menu">
                    <li class="user-header">
                        <img src="../img/<?= $user['photo']?>" class="img-circle" alt="User Image" />
                        <p>
                            <?= $user['username']?>
                            <small>Member since <?= date('Y', strtotime($user['created_at']))?></small>
                        </p>
                    </li>
                    <li class="user-body">
                        <div class="col-xs-4 text-center">
                            <a href="menus-module.php?page=Products">Products</a>
                        </div>
                        <div class="col-xs-4 text-center">
                            <a href="contact-module.php?page=Contacts">Contacts</a>
                        </div>
                        <div class="col-xs-4 text-center">
                            <a href="todo_list-module.php?page=Todo">Todo</a>
                        </div>
                    </li>
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="profile-module.php?page=Profile" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                            <a href="#" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
