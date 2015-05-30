<?php
/* @var $this ResourceController */
/* @var $data Resource */
?>
<div class="col-sm-6 col-md-4" style="height: 250; overflow: hidden;">
    <div class="thumbnail">
        <?php echo Content::get_picture_fixed($data->id); ?>
        <div class="caption">
            <h4><?php echo CHtml::link(mb_substr($data->title, 0, 20, 'UTF-8') . '...', array('news/view', 'id' => $data->id), array('title' => $data->title)); ?></h4>
        </div>
    </div>
</div> 