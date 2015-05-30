<?php

/* @var $this GalleryController */
/* @var $data Banner */
$filePath = Yii::app()->basePath . '/../uploads/banners/' . $data->banner;
if ((is_file($filePath)) && (file_exists($filePath))) {
    $image = CHtml::image(Yii::app()->baseUrl . '/uploads/banners/' . $data->banner, 'Picture', array('alt' => 'Picture', 'class' => 'img-rounded', 'style' => 'width:100px;height:100px;margin:10px;'));
    echo CHtml::link($image, Yii::app()->baseUrl . '/uploads/banners/' . $data->banner, array('class' => 'lytebox', 'data-title' => $data->name, 'data-lyte-options' => 'group:' . $data->catid));
}
?>