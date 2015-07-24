<?php
/* @var $this NewsController */
/* @var $data Content */
?>
<!-- article - text -->
<div class="prev-article row">
    <div class="blog-prev-date col-md-3 col-sm-3">        
        <?php echo Content::get_picture_responsive($data->id); ?>
        <span class="info hidden-xs">
        	<span class="block"><i class="fa fa-user"></i> Written By - <?php echo UserAdmin::get_name($data->created_by); ?></span>
            <span class="block"><i class="fa fa-book"></i> <?php echo ContentCategory::getVolumeNo($data->catid); ?></span>
            <span class="block"><i class="fa fa-file"></i> <?php echo ContentCategory::getCategoryName($data->catid); ?></span>
            <span class="block"><i class="fa fa-comments"></i> WITH <?php echo CHtml::link(ResourceComment::count_comments($data->id) . ' COMMENTS', array('news/view', 'id' => $data->id), array()); ?></span>
        </span>
    </div>
    <div class="col-md-9 col-sm-9">
        <h3 class="article-title"><?php echo CHtml::link($data->title, array('publication/view', 'id' => $data->id), array()); ?></h3>
        <span class="text-info">Published On - <?php echo UserAdmin::get_date($data->created); ?></span>
        <?php //echo $this->text_cut(htmlspecialchars_decode(CHtml::encode($data->introtext)), 500); ?>
        <span class="clearfix"><?php echo $this->text_cut($this->html2txt($data->introtext), 500); ?></span>
    </div>
</div>
<!-- /article - text -->