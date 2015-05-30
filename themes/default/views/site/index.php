<?php
$this->pageTitle = Yii::app()->name;
?>
<div class="row well">
    <h3 class="text-uppercase">Featured Publications</h3>
    <?php Content::get_editorial_choice(); ?>
</div>
<div class="row well">
    <h3 class="text-uppercase"><?php echo Content::get_title(1); ?></h3>
    <?php echo Content::get_introtext(1); ?>
</div>