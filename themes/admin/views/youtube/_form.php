<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'youtube-form',
    'enableAjaxValidation' => false,
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->textFieldControlGroup($model, 'youtube_id', array('class' => 'span5', 'maxlength' => 100)); ?>
<?php
echo $form->dropDownListControlGroup($model, 'district', CHtml::listData(District::model()->findAll(array('select' => 'id,title', 'condition' => 'published=1', "order" => "title")), 'id', 'title'), array(
    'ajax' => array(
        'type' => 'POST',
        'url' => CController::createUrl('youtube/dynamicthana'),
        'update' => '#Youtube_thana',
    ),
    'empty' => Yii::t('Common', 'please_select'),
    'class' => 'span5'
        )
);
?>
<?php echo $form->dropDownListControlGroup($model, 'thana', array(), array('empty' => '--please select--', 'class' => 'span5')); ?>
<?php echo $form->DropDownListControlGroup($model, 'published', array('1' => 'Yes', '0' => 'No')); ?>
<?php echo $form->DropDownListControlGroup($model, 'featured', array('0' => 'No', '1' => 'Yes')); ?>
<div class="form-actions">
    <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
    <?php echo TbHtml::resetButton('Reset', array('color' => TbHtml::BUTTON_COLOR_INFO)); ?>
</div>
<?php $this->endWidget(); ?>