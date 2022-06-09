<?php
require_once 'init.php';

// TODO : do not use blob because we do not need it

$database = new Database(DB, DB_USER, DB_PASS);
$fetcher = new DatabaseFetcher($database);
$inserter = new DatabaseInserter($database);
$imager = new DatabaseImager($database);

$fetcher->all();

$about = $database->getAbout();
$chef = $database->getChef();
$contact_info = $database->getContactInfo();
$gallery = $database->getGallery();
$header = $database->getHeader();
$menu_types = $database->getMenuTypes();

$social_media = $database->getSocialMedia();
$specials = $database->getSpecials();

include_once 'header.php';
?>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<!-- Navigation
    ==========================================-->
<nav id="menu" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="#features" class="page-scroll">Specials</a></li>
                <li><a href="#about" class="page-scroll">About</a></li>
                <li><a href="#restaurant-menu" class="page-scroll">Menu</a></li>
                <li><a href="#team" class="page-scroll">Chef</a></li>
                <li><a href="#contact" class="page-scroll">Contact</a></li>
                <li><a href="login.php" class="page-scroll">Login</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>
<!-- Header -->
<header id="header">
    <div class="intro">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="intro-text">
                            <h1 class="text-capitalize"><?php echo $header['title']?></h1>
                            <p>Reservations: <?php echo $contact_info['phone_number'] ?></p>
                        <?php
                            $imager->image($header['image'], HEADER_IMAGE);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Features Section -->
<div id="features" class="text-center">
    <div class="container">
        <div class="section-title">
            <h2>Our Specials</h2>
        </div>
        <div class="row">
            <?php
            $image_specials = [SPECIALS_IMAGE_1, SPECIALS_IMAGE_2, SPECIALS_IMAGE_3];
            $specials_count = count($image_specials);

            for ($i = 0; $i < $specials_count; $i++){
                $imager->image($specials[$i]['image'], $image_specials[$i]);
            ?>
            <div class="col-xs-12 col-sm-4">
                <div class="features-item">
                    <h3 class="text-capitalize"><?php echo $specials[$i]['title']?></h3>
                    <img src="<?php echo 'img/' . basename($image_specials[$i]) ?>" class="img-responsive" alt="special">
                    <p><?php echo $specials[$i]['description']?></p>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- About Section -->
<div id="about">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-6 about-img"> </div>
            <div class="col-xs-12 col-md-3 col-md-offset-1">
                <div class="about-text">
                    <div class="section-title">
                        <h2>Our Story</h2>
                    </div>
                    <p>
                        <?php $imager->image($about['image'], ABOUT_IMAGE)?>
                        <?php echo $about['story']?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Restaurant Menu Section -->
<div id="restaurant-menu">
    <div class="container">
        <div class="section-title text-center">
            <h2>Menu</h2>
        </div>
        <div class="row">
            <?php
            foreach ($menu_types as $menu_type) {
                $type = $menu_type['menu_type'];
                $fetcher->menus_by_type($type);
                $menus = $database->getMenus();
            ?>

            <div class="col-xs-12 col-sm-6">
                <div class="menu-section">
                    <h2 class="menu-section-title text-uppercase"><?php echo $type?></h2>
                    <?php
                        foreach ($menus as $menu) {
                    ?>
                        <div class="menu-item">
                            <div class="menu-item-name"><?php echo $menu['title']?></div>
                            <div class="menu-item-price"> <?php echo $menu['price']?> </div>
                            <div class="menu-item-description"> <?php echo $menu['description']?> </div>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- Gallery Section -->

<?php
$gallery_images = [GALLERY_IMAGE_1, GALLERY_IMAGE_2, GALLERY_IMAGE_3, GALLERY_IMAGE_4];
$image_count = count($gallery_images);

?>

<div id="gallery">
    <div class="container-fluid">
        <div class="row">
            <?php
            for ($i = 0; $i < $image_count; $i++) {
                $imager->image($gallery[$i]['image'], $gallery_images[$i]);
            ?>

            <div class="col-xs-6 col-md-3">
                <div class="gallery-item"> <img src="<?php echo 'img/' . basename( $gallery_images[$i])?>" class="img-responsive" alt=""></div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<!-- Team Section -->
<div id="team">
    <div class="container">
        <div id="row">
            <div class="col-md-6">
                <div class="col-md-10 col-md-offset-1">
                    <div class="section-title">
                        <h2 class="text-uppercase"><?php echo $chef['title']?></h2>
                    </div>
                    <p>
                        <?php echo $chef['description']?>
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <?php
                $imager->image($chef['image'], CHEF_IMAGE);
                ?>
                <div class="team-img"><img src="img/chef.jpeg" alt="chef"></div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Section -->
<div id="contact" class="text-center">
    <div class="container text-center">
        <div class="col-md-4">
            <h3>Reservations</h3>
            <div class="contact-item">
                <p>Please call</p>
                <p><?php echo $contact_info['phone_number']?></p>
            </div>
        </div>
        <div class="col-md-4">
            <h3>Address</h3>
            <div class="contact-item">
                <p>
                    <?php echo $contact_info['address']?>
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <h3>Opening Hours</h3>
            <div class="contact-item">
                <?php
                    $week_work_from = strtotime($contact_info['week_work_from']);
                    $week_work_to = strtotime($contact_info['week_work_to']);
                    $weekend_work_from = strtotime($contact_info['weekend_work_from']);
                    $weekend_work_to = strtotime($contact_info['weekend_work_to']);
                ?>

                <p>Mon-Thurs: <?php echo date('h:i', $week_work_from) ?> AM - <?php echo date('h:i', $week_work_to)?> PM</p>
                <p>Fri-Sun: <?php echo date('h:i', $weekend_work_from) ?> AM - <?php echo date('h:i', $weekend_work_to)?> AM</p>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="section-title text-center">
            <h3>Send us a message</h3>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <?php
            if (isset($_POST['contact-submit'])) {
                // no need to use regex or any validation for XSS or SQL injection because htmlspecialchars does the work
                $name = htmlspecialchars($_POST['name']);
                $email = htmlspecialchars($_POST['email']);
                $msg = htmlspecialchars($_POST['message']);

                $inserter->contact([$name, $email, $msg]);
            }
            ?>

            <form name="sentMessage" id="contactForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name"></label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Name" required="required" maxlength="128" minlength="3">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email"></label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required="required" maxlength="255" minlength="5">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="message"></label>
                    <textarea name="message" id="message" class="form-control" rows="4" placeholder="Message" required maxlength="255"></textarea>
                    <p class="help-block text-danger"></p>
                </div>
                <div id="success"></div>
                <button type="submit" class="btn btn-custom btn-lg" name="contact-submit">Send Message</button>
            </form>
        </div>
    </div>
</div>
<div id="footer">
    <div class="container text-center">
        <div class="col-md-6">
            <p>&copy; 2017 Gusto. All rights reserved. Design by <a href="#" rel="nofollow">TemplateWire</a></p>
        </div>
        <div class="col-md-6">
            <div class="social">
                <ul>
                    <li><a href="<?php echo $social_media['facebook'] ?? '#'?>"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="<?php echo $social_media['instagram'] ?? '#'?>"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="<?php echo $social_media['youtube'] ?? '#'?>"><i class="fa fa-youtube"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/jquery.1.11.1.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/SmoothScroll.js"></script>
<script type="text/javascript" src="js/jqBootstrapValidation.js"></script>
<script type="text/javascript" src="js/contact_me.js"></script>
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>
