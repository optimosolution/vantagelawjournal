<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	
<html> <!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="author" content="S.M. Saidur Rahman">
        <meta name="generator" content="Optimo Solution" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- mobile settings -->
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />
        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/demo/favicon.ico" />
        <!-- WEB FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css" />
        <!-- CORE CSS -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/sky-forms.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/weather-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/line-icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/owl-carousel/owl.pack.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/animate.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/flexslider.css" rel="stylesheet" type="text/css" />
        <!-- REVOLUTION SLIDER -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/revolution-slider.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/layerslider.css" rel="stylesheet" type="text/css" />
        <!-- BLOG -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/layout-blog.css" rel="stylesheet" type="text/css" />
        <!-- THEME CSS -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/essentials.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/layout.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/header-default.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/footer-default.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/assets/css/color_scheme/red.css" rel="stylesheet" type="text/css" id="color_scheme" />
        <!-- Morenizr -->
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/modernizr.min.js"></script>
        <!--[if lte IE 8]>
                <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/respond.js"></script>
        <![endif]-->
    </head>
    <body class="smoothscroll">
        <div id="wrapper">
            <div id="header"><!-- class="sticky" for sticky menu -->
                <!-- Top Bar -->
                <header id="topBar">
                    <div class="container">
                        <div class="pull-right fsize13 margin-top10 hide_mobile">
                            <!-- mail , phone -->
                            <a href="mailto:vantagelawjournal@gmail.com">vantagelawjournal@gmail.com</a> &bull; +880 1765 900900 
                            <div class="block text-right"><!-- social -->
                                <a href="#" class="social fa fa-facebook"></a>
                                <a href="#" class="social fa fa-twitter"></a>
                                <a href="#" class="social fa fa-google-plus"></a>
                                <a href="#" class="social fa fa-linkedin"></a>
                                <a href="#" class="social fa fa-pinterest"></a>
                            </div><!-- /social -->
                        </div>
                        <!-- Logo -->
                        <?php echo $this->get_logo(1); ?>
                    </div><!-- /.container -->
                </header>
                <!-- /Top Bar -->
                <!-- Top Nav -->
                <header id="topNav">
                    <div class="container">
                        <!-- Mobile Menu Button -->
                        <button class="btn btn-mobile" data-toggle="collapse" data-target=".nav-main-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                        <!-- Search -->
                        <form class="search" method="get" action="#">
                            <input type="text" class="form-control" name="s" value="" placeholder="Search">
                            <button class="fa fa-search"></button>
                        </form>
                        <!-- /Search -->
                        <!-- Top Nav -->
                        <div class="navbar-collapse nav-main-collapse collapse">
                            <nav class="nav-main">
                                <ul id="topMain" class="nav nav-pills nav-main">
                                    <?php echo '<li class="mega-menu active">' . CHtml::link('HOME', array('/site/index'), array('class' => '', 'style' => '')) . '</li>'; ?>                                    
                                    <?php echo '<li class="mega-menu">' . CHtml::link('PUBLICATIONS', array('/publication/index', 'id' => 2), array('class' => '')) . '</li>'; ?>                                                                       
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" href="#">ABOUT US</a>
                                        <ul class="dropdown-menu">
                                            <?php echo '<li>' . CHtml::link('About Us', array('/content/view', 'id' => 4), array('class' => '')) . '</li>'; ?>  
                                            <?php echo '<li>' . CHtml::link('Editorial Team', array('/content/view', 'id' => 5), array('class' => '')) . '</li>'; ?>  
                                        </ul>
                                    </li>
                                    <?php echo '<li class="mega-menu">' . CHtml::link('SUBMISSION', array('/content/view', 'id' => 6), array('class' => '')) . '</li>'; ?>                                                                       
                                    <?php echo '<li class="mega-menu">' . CHtml::link('CONTACT US', array('/site/contact'), array('class' => '')) . '</li>'; ?>                                    
                                </ul>
                            </nav>
                        </div>
                        <!-- /Top Nav -->
                    </div><!-- /.container -->
                </header>
                <!-- /Top Nav -->
            </div>      
            <?php echo $content; ?>                        
            <!-- FOOTER -->
            <footer id="footer">
                <div class="container">
                    <div class="row">
                        <!-- col #1 -->
                        <div class="logo_footer dark col-md-4">
                            <h4>Contact <strong>Us</strong></h4>
                            <p class="block">
                                <?php echo Content::get_introtext(2); ?>
                            </p>
                            <p class="block"><!-- social -->
                                <a href="#" class="social fa fa-facebook"></a>
                                <a href="#" class="social fa fa-twitter"></a>
                                <a href="#" class="social fa fa-google-plus"></a>
                                <a href="#" class="social fa fa-linkedin"></a>
                            </p><!-- /social -->
                        </div>
                        <!-- /col #1 -->
                        <!-- col #2 -->
                        <div class="spaced col-md-4 col-sm-4">
                            <h4>Footer <strong>Menu</strong></h4>
                            <ul class="list-unstyled">
                                <li><?php echo CHtml::link('<i class="fa fa-home"></i> HOME', array('/site/index'), array()); ?></li>                                
                                <li><?php echo CHtml::link('<i class="fa fa-sign-out"></i> VIDEO', array('youtube/index'), array()); ?></li>                                
                                <li><?php echo CHtml::link('<i class="fa fa-sign-out"></i> WEBLINKS', array('/weblink/index'), array()); ?></li>                                
                                <li><?php echo CHtml::link('<i class="fa fa-sign-out"></i> GALLERY', array('/gallery/index', 'id' => 3), array()); ?></li>                                                                
                                <li><?php echo CHtml::link('<i class="fa fa-envelope"></i> CONTACT US', array('/site/contact'), array()); ?></li>
                            </ul>
                        </div>
                        <!-- /col #2 -->
                        <!-- col #4 -->
                        <div class="spaced col-md-4 col-sm-4">
                            <h4>Subscribe <strong>Us</strong></h4>
                            <p>Want to get informed about latest publications?</p>
                            <h4><small><strong>Subscribe to our Newsletter</strong></small></h4>
                            <form id="newsletterSubscribe" method="post" action="php/newsletter.php" class="input-group">
                                <input required type="email" class="form-control" name="newsletter_email" id="newsletter_email" value="" placeholder="E-mail Address">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary">SUBMIT</button>
                                </span>
                            </form>
                        </div>
                        <!-- /col #4 -->
                    </div>
                </div>
                <hr />
                <div class="copyright">
                    <div class="container text-center fsize12">
                        Copyright &copy; <?php echo date('Y'); ?> <?php echo Yii::app()->name; ?>. Developed by <?php echo CHtml::link('Optimo Solution', 'http://www.optimosolution.com', array('target' => '_blank')); ?>
                    </div>
                </div>
            </footer>
            <!-- /FOOTER -->
            <a href="#" id="toTop"></a>
        </div><!-- /#wrapper -->
        <!-- JAVASCRIPT FILES -->
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/jquery.isotope.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/masonry.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/owl-carousel/owl.carousel.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/knob/js/jquery.knob.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/flexslider/jquery.flexslider-min.js"></script>
        <!-- REVOLUTION SLIDER -->
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/revolution-slider/js/jquery.themepunch.tools.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/plugins/revolution-slider/js/jquery.themepunch.revolution.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/revolution_slider.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/js/scripts.js"></script>       
    </body>
</html>
