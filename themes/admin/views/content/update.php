<?php
$this->pageTitle = 'Edit content - ' . Yii::app()->name;
$this->breadcrumbs = array(
    'Contents' => array('admin'),
    $model->title => array('view', 'id' => $model->id),
    'Update',
);
?>
<div class="widget-box">
    <div class="widget-header">
        <h5>Edit Content (<?php echo $model->title; ?>)</h5>
        <div class="widget-toolbar">
            <a data-action="settings" href="#"><i class="icon-cog"></i></a>
            <a data-action="reload" href="#"><i class="icon-refresh"></i></a>
            <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
            <a data-action="close" href="#"><i class="icon-remove"></i></a>
        </div>
        <div class="widget-toolbar">
            <?php echo CHtml::link('<i class="icon-eye-open"></i>', array('view', 'id' => $model->id), array('data-rel' => 'tooltip', 'title' => 'Details', 'data-placement' => 'bottom')); ?>
        </div>
        <div class="widget-toolbar">
            <?php echo CHtml::link('<i class="icon-plus"></i>', array('create'), array('data-rel' => 'tooltip', 'title' => 'Add', 'data-placement' => 'bottom')); ?>
        </div>
    </div><!--/.widget-header -->
    <div class="widget-body">
        <div class="widget-main">
            <?php $this->renderPartial('_form', array('model' => $model,)); ?>
            <?php
            $form2 = $this->beginWidget('CActiveForm', array(
                'id' => 'image-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array(
                    'enctype' => 'multipart/form-data',
                    'onsubmit' => "return false;", /* Disable normal form submit */
                    'onkeypress' => " if(event.keyCode == 13){ upload(); } " /* Do ajax call when user presses enter key */
                ),
            ));
            ?>
            <div class="row-fluid">
                <div class="span6">
                    <?php echo $form2->textField($model_images, 'title', array('class' => 'span12', 'maxlength' => 255, 'placeholder' => 'Image title')); ?>
                </div>
                <div class="span4">
                    <?php echo $form2->hiddenField($model_images, 'content', array('value' => $model->id)); ?>
                    <?php echo $form2->fileField($model_images, 'content_image', array('class' => 'span12')); ?>
                </div>
                <div class="span2">
                    <?php echo CHtml::submitButton('Submit', array('class' => 'btn btn-primary btn-small', 'onclick' => 'upload();')); ?>
                </div>
            </div>
            <?php $this->endWidget(); ?>
            <?php
            $this->widget('bootstrap.widgets.TbGridView', array(
                'id' => 'image-grid',
                'dataProvider' => $modelmore->search($model->id),
                'columns' => array(
                    array(
                        'name' => 'title',
                        'type' => 'raw',
                        'value' => '$data->title',
                        'htmlOptions' => array('style' => "text-align:center;width:100px;", 'title' => 'title'),
                    ),
                    array(
                        'name' => 'content_image',
                        'type' => 'html',
                        'value' => 'CHtml::image(Yii::app()->baseUrl . "/uploads/images/" . $data->content_image, "Picture", array("style" => "width:50px;"))',
                    ),
                    array(
                        'header' => 'Path',
                        'type' => 'html',
                        'value' => 'Yii::app()->getBaseUrl(true)."/uploads/images/" . $data->content_image',
                    ),
                    array(
                        'header' => 'Actions',
                        'template' => '{delete}',
                        'class' => 'bootstrap.widgets.TbButtonColumn',
                        'buttons' => array(
                            'delete' => array(
                                'label' => '',
                                'imageUrl' => '',
                                'url' => 'Yii::app()->createUrl("/content/remove", array("id"=>(int)$data["id"]))',
                                'options' => array('class' => ''),
                            ),
                        ),
                    ),
                ),
            ));
            ?>
        </div>
    </div><!--/.widget-body -->
</div><!--/.widget-box -->
<script type="text/javascript">
    function upload()
    {
        //var data = $("#document-form").serialize();
        var formData = new FormData($('#image-form')[0]);
        $.ajax({
            type: 'POST',
            url: '<?php echo Yii::app()->createAbsoluteUrl("content/image"); ?>',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                //alert("succes:" + data);
                if (data != "false")
                {
                    $("#image-form")[0].reset();
                    $.fn.yiiGridView.update('image-grid', {
                    });
                }
            },
            error: function (data) { // if error occured
                alert("Error occured. Please try again");
                //alert(data);
            },
            dataType: 'html'
        });

    }
</script>