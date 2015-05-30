<?php
/* @var $this ResourceCommentController */
/* @var $model ResourceComment */
?>

<?php
$this->pageTitle = 'Resource Comment details - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Resource Comments' => array('admin'),
    $model->full_name,
);
?>
<div class="widget-box">
    <div class="widget-header">
        <h5>Details Resource Comment</h5>
        <div class="widget-toolbar">
            <a data-action="settings" href="#"><i class="icon-cog"></i></a>
            <a data-action="reload" href="#"><i class="icon-refresh"></i></a>
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
            <a data-action="close" href="#"><i class="icon-remove"></i></a>
        </div>
        <div class="widget-toolbar">
            <?php echo CHtml::link('<i class="icon-pencil"></i>', array('update', 'id' => $model->id), array('data-rel' => 'tooltip', 'title' => 'Edit', 'data-placement' => 'bottom')); ?>
        </div>
        <div class="widget-toolbar">
            <?php echo CHtml::link('<i class="icon-plus"></i>', array('create'), array('data-rel' => 'tooltip', 'title' => 'Add', 'data-placement' => 'bottom')); ?>
        </div>
    </div><!--/.widget-header -->
    <div class="widget-body">
        <?php
        $this->widget('zii.widgets.CDetailView', array(
            'htmlOptions' => array(
                'class' => 'table table-striped table-condensed table-hover',
            ),
            'data' => $model,
            'attributes' => array(
                'id',
                array(
                    'name' => 'resource',
                    'type' => 'raw',
                    'value' => Resource::get_title($model->resource),
                    'htmlOptions' => array('style' => "text-align:left;"),
                ),
                'full_name',
                'email',
                'website',
                'comment',
                array(
                    'name' => 'created',
                    'value' => UserAdmin::get_date_time($model->created),
                ),
                array(
                    'name' => 'status',
                    'value' => $model->status ? "Active" : "Inactive",
                ),
            ),
        ));
        ?>
    </div>
</div><!--/.widget-body -->
</div><!--/.widget-box -->