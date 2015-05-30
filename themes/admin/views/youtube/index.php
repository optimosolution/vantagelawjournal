<?php
$this->breadcrumbs=array(
	'Youtubes',
);

$this->menu=array(
	array('label'=>'Create Youtube','url'=>array('create')),
	array('label'=>'Manage Youtube','url'=>array('admin')),
);
?>

<h1>Youtubes</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
