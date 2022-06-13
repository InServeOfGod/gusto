<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../img/<?= $user['photo']?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?= $user['username']?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="treeview <?php if ($_GET['page'] == 'Dashboard' | $_GET['page'] == 'Visitors') echo 'active' ?>">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if($_GET['page'] == 'Dashboard') echo 'active' ?>">
                        <a href="index.php"><i class="fa fa-circle-o"></i> Dashboard</a>
                    </li>

                    <li class="<?php if($_GET['page'] == 'Visitors') echo 'active' ?>">
                        <a href="visitors-module.php"><i class="fa fa-circle-o"></i> Visitors</a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="treeview <?php if ($_GET['page'] == 'Header' | $_GET['page'] == 'Specials' | $_GET['page'] == 'About' | $_GET['page'] == 'Gallery' | $_GET['page'] == 'Chef') echo 'active' ?>">
                <a href="#">
                    <i class="fa fa-sitemap"></i> <span>Page Modules</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($_GET['page'] == 'Header') echo 'active'?>"><a href="header-module.php"><i class="fa fa-circle-o"></i> Header</a></li>
                    <li class="<?php if ($_GET['page'] == 'Specials') echo 'active'?>"><a href="specials-module.php"><i class="fa fa-circle-o"></i> Specials</a></li>
                    <li class="<?php if ($_GET['page'] == 'About') echo 'active'?>"><a href="about-module.php"><i class="fa fa-circle-o"></i> About</a></li>
                    <li class="<?php if ($_GET['page'] == 'Gallery') echo 'active'?>"><a href="gallery-module.php"><i class="fa fa-circle-o"></i> Gallery</a></li>
                    <li class="<?php if ($_GET['page'] == 'Chef') echo 'active'?>"><a href="chef-module.php"><i class="fa fa-circle-o"></i> Chef</a></li>
                </ul>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="treeview <?php if ($_GET['page'] == 'Contact' | $_GET['page'] == 'Contact Info' | $_GET['page'] == 'Social Media') echo 'active' ?>">
                <a href="#">
                    <i class="fa fa-phone"></i> <span>Contact</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($_GET['page'] == 'Contact') echo 'active'?>"><a href="contact-module.php"><i class="fa fa-circle-o"></i> Contact</a></li>
                    <li class="<?php if ($_GET['page'] == 'Contact Info') echo 'active'?>"><a href="contact_info-module.php"><i class="fa fa-circle-o"></i> Contact Info</a></li>
                    <li class="<?php if ($_GET['page'] == 'Social Media') echo 'active'?>"><a href="social_media-module.php"><i class="fa fa-circle-o"></i> Social Media</a></li>
                </ul>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="treeview <?php if ($_GET['page'] == 'Menus' | $_GET['page'] == 'Profits' | $_GET['page'] == 'Menu Types') echo 'active' ?>">
                <a href="#">
                    <i class="fa fa-money"></i> <span>Products</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($_GET['page'] == 'Menu Types') echo 'active'?>"><a href="menu_types-module.php"><i class="fa fa-circle-o"></i> Menu Types</a></li>
                    <li class="<?php if ($_GET['page'] == 'Menus') echo 'active'?>"><a href="menus-module.php"><i class="fa fa-circle-o"></i> Menus</a></li>
                    <li class="<?php if ($_GET['page'] == 'Profits') echo 'active'?>"><a href="profits-module.php"><i class="fa fa-circle-o"></i> Profits</a></li>
                </ul>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="treeview <?php if ($_GET['page'] == 'Todo') echo 'active' ?>">
                <a href="#">
                    <i class="ion ion-clipboard"></i> <span>Todo</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($_GET['page'] == 'Todo') echo 'active'?>"><a href="todo_list-module.php"><i class="fa fa-circle-o"></i> Todo List</a></li>
                </ul>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="treeview <?php if ($_GET['page'] == 'Profile') echo 'active' ?>">
                <a href="#">
                    <i class="fa fa-user"></i> <span>Profile</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php if ($_GET['page'] == 'Profile') echo 'active'?>"><a href="profile-module.php"><i class="fa fa-circle-o"></i> Profile Settings</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Sign Out</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
