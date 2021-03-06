<?php
$form = $this->beginWidget ( 'bootstrap.widgets.TbActiveForm', array (
		'id' => 'content-form',
		'enableAjaxValidation' => false,
		'htmlOptions' => array (
				'enctype' => 'multipart/form-data' 
		) 
) );
Yii::app ()->clientScript->registerScript ( 'search', "
    $('#Content_images').ace_file_input({
        no_file: 'No Image ...',
        btn_choose: 'Choose',
        btn_change: 'Change',
        droppable: false,
        onchange: null,
        thumbnail: false //| true | large
                //whitelist:'gif|png|jpg|jpeg'
                //blacklist:'exe|php'
                //onchange:''
                //
    });
" );
?>
<p class="help-block">
	Fields with <span class="required">*</span> are required.
</p>
<?php echo $form->errorSummary($model); ?>
<div class="row-fluid">
	<div class="span12">
        <?php
			if ($model->isNewRecord) {
				echo ContentCategory::get_category_new ( 'Content', 'catid' );
			} else {
				echo ContentCategory::get_category_update ( 'Content', 'catid', $model->catid );
			}
		?>
    </div>
</div>
<?php echo $form->textFieldControlGroup($model, 'title', array('class' => 'span12', 'maxlength' => 255)); ?>
<div class="control-group">
	<label for="form-field-1" class="control-label"><?php echo $form->labelEx($model, 'introtext'); ?></label>
	<div class="controls">
        <?php
			$this->widget ( 'application.extensions.yii-ckeditor.CKEditorWidget', array (
					'model' => $model,
					'attribute' => 'introtext',
					// editor options http://docs.ckeditor.com/#!/api/CKEDITOR.config
					'config' => array (
							'language' => 'en' 
					) 
			) );
			// 'toolbar' => 'Basic',
			
		?>
    </div>
</div>
<div class="row-fluid">
	<div class="span2">
        <?php echo $form->dropDownListControlGroup($model, 'state', array('1' => 'Yes', '0' => 'No'), array('class' => 'span12')); ?>
    </div>
	<div class="span2">
        <?php echo $form->dropDownListControlGroup($model, 'featured', array('1' => 'Yes', '0' => 'No'), array('class' => 'span12')); ?>
    </div>
	<div class="span2">
        <?php echo $form->dropDownListControlGroup($model, 'editorial_choice', array('1' => 'Yes', '0' => 'No'), array('class' => 'span12')); ?>
    </div>
	<div class="span2">
        <?php echo $form->textFieldControlGroup($model, 'ordering', array('class' => 'span12')); ?>
    </div>
	<div class="span4">
        <?php echo $form->fileFieldControlGroup($model, 'images', array('size' => 36, 'maxlength' => 255, 'class' => 'span12')); ?>
    </div>
</div>
<div class="row-fluid">
	<div class="span3">
		<?php echo $form->dropDownListControlGroup($model, 'created_by', CHtml::listData(UserAdmin::model()->findAll(array('condition' => '', "order" => "name")), 'id', 'name'), array('empty' => '--please select--', 'class' => 'span12')); ?>
	</div>
	<div class="span3">
        <?php echo $form->labelEx($model, 'created'); ?>
        <?php
			echo $form->widget ( 'zii.widgets.jui.CJuiDatePicker', array (
					'language' => 'en',
					'model' => $model, // Model object
					'attribute' => 'created',
					'options' => array (
							'mode' => 'date',
							'changeYear' => true,
							'changeMonth' => true,
							'yearRange' => '1900:2200',
							'dateFormat' => 'yy-mm-dd',
							'timeFormat' => '',
							'showTimepicker' => false 
					),
					'htmlOptions' => array (
							'placeholder' => 'Create Date',
							'class' => 'span12' 
					) 
			), true );
		?>
    </div>
</div>
<div class="row-fluid">
	<div class="span6">
        <?php echo $form->textAreaControlGroup($model, 'metakey', array('rows' => 2, 'cols' => 50, 'class' => 'span12')); ?>
    </div>
	<div class="span6">
        <?php echo $form->textAreaControlGroup($model, 'metadesc', array('rows' => 2, 'cols' => 50, 'class' => 'span12')); ?>
    </div>
</div>
<div class="form-actions">
    <?php echo TbHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>
    <?php
				echo TbHtml::submitButton ( 'Save & New', array (
						'color' => TbHtml::BUTTON_COLOR_PRIMARY,
						'name' => 'savennew' 
				) );
				?>
    <?php
				echo TbHtml::submitButton ( 'Save & Edit', array (
						'color' => TbHtml::BUTTON_COLOR_PRIMARY,
						'name' => 'saveedit' 
				) );
				?>
    <?php echo TbHtml::resetButton('Reset', array('color' => TbHtml::BUTTON_COLOR_INFO)); ?>
</div>
<?php $this->endWidget(); ?>