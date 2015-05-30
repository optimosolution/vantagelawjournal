<?php
/* @var $this NewsController */
/* @var $model Content */
$this->pageTitle = $model->title . ' - ' . Yii::app()->name;
?>
<!-- article - text -->
<div class="prev-article row">
    <div class="blog-prev-date col-md-3 col-sm-3">
        <span class="date">
            <?php echo UserAdmin::get_day($model->created); ?> <small><?php echo UserAdmin::get_month_year($model->created); ?></small>
        </span>
        <span class="info hidden-xs">
            <span class="block"><i class="fa fa-folder-open-o"></i> POSTED IN <?php echo CHtml::link(ContentCategory::getCategoryName($model->catid), array('news/index', 'id' => $model->catid), array('class' => '')); ?></span>
            <span class="block"><i class="fa fa-comments"></i> WITH <?php echo CHtml::link(ResourceComment::count_comments($model->id) . ' COMMENTS', array('news/view', 'id' => $model->id), array()); ?></span>
        </span>
    </div>
    <div class="col-md-9 col-sm-9">
        <h2 class="article-title"><?php echo $model->title; ?></h2>
        <p>
            <?php
            $this->widget('application.extensions.SocialShareButton.SocialShareButton', array(
                'style' => 'horizontal',
                'networks' => array('facebook', 'googleplus', 'linkedin', 'twitter'),
                'data_via' => '', //twitter username (for twitter only, if exists else leave empty)
            ));
            ?>
        </p>        
        <?php echo Content::get_picture_responsive($model->id); ?>
        <!-- blog short preview -->
        <p class="dropcap"><?php echo $model->introtext; ?></p>
        <!-- read more button -->
        <div class="text-right">
            <?php //echo CHtml::link('<i class="fa fa-sign-out"></i> MAIN SOURCE', $model->main_source, array('class' => 'read-more btn btn-xs', 'target' => '_blank')); ?>
        </div>
        <hr class="half-margins invisible" />
        <!-- COMMENTS -->
        <div id="comments">
            <h3><?php echo ResourceComment::count_comments($model->id); ?> Comments</h3>
            <!-- comment item -->
            <?php ResourceComment::get_comments($model->id); ?>
            <hr />
            <!-- COMMENT FORM -->
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'comment-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('class' => 'sky-form boxed')
            ));
            ?>
            <header>Leave a reply</header>
            <?php echo $form->errorSummary($model_comment); ?>
            <fieldset>					
                <div class="row">
                    <section class="col col-md-4">
                        <label class="label">Name</label>
                        <label class="input">
                            <i class="icon-append fa fa-user"></i>
                            <?php echo $form->textField($model_comment, 'full_name', array('maxlength' => 150)); ?>
                        </label>
                    </section>
                    <section class="col col-md-4">
                        <label class="label">E-mail</label>
                        <label class="input">
                            <i class="icon-append fa fa-envelope"></i>
                            <?php echo $form->textField($model_comment, 'email', array('maxlength' => 150)); ?>
                        </label>
                    </section>
                    <section class="col col-md-4">
                        <label class="label">Website</label>
                        <label class="input">
                            <i class="icon-append fa fa-globe"></i>
                            <?php echo $form->textField($model_comment, 'website', array('maxlength' => 150)); ?>
                        </label>
                    </section>
                </div>
                <section>
                    <label class="label">Comment</label>
                    <label class="textarea">
                        <i class="icon-append fa fa-comments"></i>
                        <?php echo $form->textArea($model_comment, 'comment', array('rows' => 4)); ?>
                    </label>
                    <div class="note">You may use these HTML tags and attributes: &lt;a href="" title=""&gt;, &lt;abbr title=""&gt;, &lt;acronym title=""&gt;, &lt;b&gt;, &lt;blockquote cite=""&gt;, &lt;cite&gt;, &lt;code&gt;, &lt;del datetime=""&gt;, &lt;em&gt;, &lt;i&gt;, &lt;q cite=""&gt;, &lt;strike&gt;, &lt;strong&gt;.</div>
                </section>
            </fieldset>
            <footer>
                <button type="submit" class="button">Add comment</button>
            </footer>
            <?php $this->endWidget(); ?>
            <!-- /COMMENT FORM -->
        </div>
        <!-- /COMMENTS -->
    </div>
</div>
<!-- /article - text -->