<?php
/* @var $this GalleryController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = Title::get_title(7) . ' - ' . Yii::app()->name;
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl . '/assets/js/lytebox.js', CClientScript::POS_END);
$cs->registerCssFile(Yii::app()->theme->baseUrl . '/assets/css/lytebox.css');
?>
<h1><?php echo Title::get_title(7); ?></h1>
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