<?php
/* @var $this YoutubeController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Title::get_title(6) . ' - ' . Yii::app()->name;
?>
<h1><?php echo Title::get_title(6); ?></h1>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'template' => '{items}{pager}',
    'itemView' => '_view',
    'pager' => array(
        'header' => '',
        'prevPageLabel' => '<i class="fa fa-backward"></i>',
        'nextPageLabel' => '<i class="fa fa-forward"></i>',
        'firstPageLabel' => '<i class="fa fa-fast-backward"></i>',
        'lastPageLabel' => '<i class="fa fa-fast-forward"></i>',
        'selectedPageCssClass' => 'active', //default "selected"
        'maxButtonCount' => 10, // defalut 10  
        'htmlOptions' => array(
            'class' => 'pagination',
            'style' => '',
            'id' => '',
        ),
    ),
));
?>