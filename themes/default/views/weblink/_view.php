<?php
/* @var $this WeblinkController */
/* @var $data Weblink */
?>
<div><?php echo CHtml::link('<i class="fa fa-sign-out"></i> ' . $data->title, $data->click_url, array('target' => '_blank')); ?></div>