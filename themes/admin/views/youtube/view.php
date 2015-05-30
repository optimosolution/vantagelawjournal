<?php
$this->breadcrumbs = array(
    'Youtubes' => array('admin'),
    $model->youtube_id,
);
$this->menu = array(
    array('label' => 'Manage', 'url' => array('admin'), 'active' => true, 'icon' => 'icon-home'),
    array('label' => 'New', 'url' => array('create'), 'active' => true, 'icon' => 'icon-file'),
    array('label' => 'Edit', 'url' => array('update', 'id' => $model->id), 'active' => true, 'icon' => 'icon-pencil'),
    array('label' => 'Delete', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?'), 'active' => true, 'icon' => 'icon-remove'),
);
?>

<div class="form-actions">
    <h2><?php echo $model->youtube_id; ?></h2>
</div>

<?php
$this->widget('bootstrap.widgets.TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        'id',
        'youtube_id',
        array(
            'name' => 'district',
            'type' => 'raw',
            'value' => District::getDistrict($model->district),
        ),
        array(
            'name' => 'thana',
            'type' => 'raw',
            'value' => Thana::getThana($model->thana),
        ),
        array(
            'name' => 'published',
            'type' => 'raw',
            'value' => $model->published ? "Yes" : "No",
        ),
        array(
            'name' => 'featured',
            'type' => 'raw',
            'value' => $model->featured ? "Yes" : "No",
        ),
        array(
            'name' => 'created_on',
            'type' => 'raw',
            'value' => date("F j, Y, g:i A", strtotime($model->created_on)),
        ),
        'created_by',
    ),
));
?>
