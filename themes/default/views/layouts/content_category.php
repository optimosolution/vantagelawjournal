<?php $this->beginContent('//layouts/main'); ?>
<!-- PAGE TOP -->
<section class="page-title">
    <div class="container">
        <header>
            <h2><!-- Page Title -->
                Publications
            </h2><!-- /Page Title -->
        </header>
    </div>			
</section>
<!-- /PAGE TOP -->
<!-- CONTENT -->
<section>
    <div class="container">
        <div id="blog" class="row">
            <!-- BLOG ARTICLE LIST -->
            <div class="col-md-9 col-sm-9">
                <?php echo $content; ?>
            </div>
            <!-- /BLOG ARTICLE LIST -->
            <!-- BLOG SIDEBAR -->
            <div class="col-md-3 col-sm-3">                
                <div class="widget">
                    <h4 class="text-uppercase"><?php echo Content::get_title(3); ?></h4>
                    <?php echo Content::get_picture_responsive(3); ?>
                    <?php echo Content::get_introtext(3); ?>
                </div>
                <!-- Advertisement -->
                <div class="widget">
                    <?php $this->get_advertisement(2); ?>                    
                </div>
                <!-- FB Like Box -->
                <div class="widget">
                    <?php
                    $this->widget('application.extensions.fbLikeBox.fbLikeBox', array(
                        'likebox' => array(
                            'url' => 'https://www.facebook.com/vantagelawjournal',
                            'header' => 'true',
                            'width' => '260',
                            'height' => '400',
                            'layout' => 'light',
                            'show_post' => 'false',
                            'show_faces' => 'true',
                            'show_border' => 'true',
                        )
                    ));
                    ?>                    
                </div>
            </div>
            <!-- /BLOG SIDEBAR -->
        </div>
    </div>
</section>
<!-- /CONTENT -->
<?php $this->endContent(); ?>