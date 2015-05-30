<?php
$this->pageTitle = $model->title . ' - ' . Yii::app()->name;
?>
<h4 class="article-title"><?php echo $model->title; ?></h4>
<?php
$this->widget('application.extensions.SocialShareButton.SocialShareButton', array(
    'style' => 'horizontal',
    'networks' => array('facebook', 'googleplus', 'linkedin', 'twitter'),
    'data_via' => '', //twitter username (for twitter only, if exists else leave empty)
));
?>
<!-- blog short preview -->
<p class="dropcap"><?php echo $model->introtext; ?></p>

