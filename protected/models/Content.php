<?php

/**
 * This is the model class for table "{{content}}".
 *
 * The followings are the available columns in table '{{content}}':
 * @property string $id
 * @property string $title
 * @property string $alias
 * @property string $introtext
 * @property string $fulltext
 * @property integer $state
 * @property string $catid
 * @property string $created
 * @property string $created_by
 * @property string $modified
 * @property string $modified_by
 * @property string $publish_up
 * @property string $publish_down
 * @property integer $ordering
 * @property string $metakey
 * @property string $metadesc
 * @property string $hits
 * @property integer $featured
 */
class Content extends CActiveRecord {

    public $file;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Content the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{content}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, catid, introtext, state', 'required'),
            array('state, ordering, featured, editorial_choice', 'numerical', 'integerOnly' => true),
            array('title, alias', 'length', 'max' => 255),
            array('catid, created_by, modified_by, hits', 'length', 'max' => 10),
            array('created, modified, publish_up, publish_down, metakey, metadesc', 'safe'),
            array('images', 'file', 'types' => 'jpg,jpeg,gif,png', 'allowEmpty' => true, 'minSize' => 2, 'maxSize' => 1024 * 1024 * 5, 'tooLarge' => 'The file was larger than 5MB. Please upload a smaller file.', 'wrongType' => 'File format was not supported.', 'tooSmall' => 'File size was too small or empty.'),
            array('file', 'file', 'types' => 'jpg, jpeg, gif, png', 'allowEmpty' => true, 'minSize' => 2, 'maxSize' => 1024 * 1024 * 2, 'tooLarge' => 'The file was larger than 2MB. Please upload a smaller file.', 'wrongType' => 'File format was not supported.', 'tooSmall' => 'File size was too small or empty.'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, alias, introtext, fulltext, state, catid, created, created_by, modified, modified_by, publish_up, publish_down, ordering, metakey, metadesc, hits, featured, editorial_choice', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'title' => 'Title',
            'alias' => 'Alias',
            'introtext' => 'Content',
            'fulltext' => 'Fulltext',
            'state' => 'Published',
            'catid' => 'Category',
            'created' => 'Created',
            'created_by' => 'Created By',
            'modified' => 'Modified',
            'modified_by' => 'Modified By',
            'publish_up' => 'Publish Up',
            'publish_down' => 'Publish Down',
            'ordering' => 'Ordering',
            'metakey' => 'Metakey',
            'metadesc' => 'Metadesc',
            'hits' => 'Hits',
            'featured' => 'Featured',
            'images' => 'Images',
            'editorial_choice' => 'Editorial Choice',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('alias', $this->alias, true);
        $criteria->compare('introtext', $this->introtext, true);
        $criteria->compare('fulltext', $this->fulltext, true);
        $criteria->compare('state', $this->state);
        $criteria->compare('catid', $this->catid, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('created_by', $this->created_by, true);
        $criteria->compare('modified', $this->modified, true);
        $criteria->compare('modified_by', $this->modified_by, true);
        $criteria->compare('publish_up', $this->publish_up, true);
        $criteria->compare('publish_down', $this->publish_down, true);
        $criteria->compare('ordering', $this->ordering);
        $criteria->compare('metakey', $this->metakey, true);
        $criteria->compare('metadesc', $this->metadesc, true);
        $criteria->compare('hits', $this->hits, true);
        $criteria->compare('featured', $this->featured);
        $criteria->compare('editorial_choice', $this->editorial_choice);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => Yii::app()->params['pageSize'],
            ),
            'sort' => array('defaultOrder' => 'created DESC, id DESC')
        ));
    }

    /**
     * Retrieves User name by ID.
     * @return string.
     */
    public function getUserName($id) {
        $returnValue = Yii::app()->db->createCommand()
                ->select('name')
                ->from('{{user_admin}}')
                ->where('id=:id', array(':id' => $id))
                ->queryScalar();

        return $returnValue;
    }

    /**
     * Retrieves Category name by ID.
     * @return string.
     */
    public function getCategoryName($id) {
        $value = ContentCategory::model()->findByAttributes(array('id' => $id));
        if (empty($value->title)) {
            return null;
        } else {
            return $value->title;
        }
    }

    public static function get_date_time($date) {
        if (empty($date) || $date == '0000-00-00' || $date == '0000-00-00 00:00:00') {
            return null;
        } else {
            return date("F j, Y", strtotime($date));
        }
    }

    public static function get_meta_desc($id) {
        $value = Content::model()->findByAttributes(array('id' => $id));
        if (empty($value->metadesc)) {
            return null;
        } else {
            return $value->metadesc;
        }
    }

    public static function get_meta_key($id) {
        $value = Content::model()->findByAttributes(array('id' => $id));
        if (empty($value->metakey)) {
            return null;
        } else {
            return $value->metakey;
        }
    }

    public static function get_title($id) {
        $value = Content::model()->findByAttributes(array('id' => $id));
        if (empty($value->title)) {
            return null;
        } else {
            return $value->title;
        }
    }

    public static function get_introtext($id) {
        $value = Content::model()->findByAttributes(array('id' => $id));
        if (empty($value->introtext)) {
            return null;
        } else {
            return $value->introtext;
        }
    }

    public static function get_images($id) {
        $value = Content::model()->findByAttributes(array('id' => $id));
        $filePath = Yii::app()->basePath . '/../uploads/images/' . $value->images;
        if ((is_file($filePath)) && (file_exists($filePath))) {
            echo CHtml::image(Yii::app()->baseUrl . '/uploads/images/' . $value->images, 'Picture', array('alt' => $value->title, 'class' => 'img-responsive alignleft imageborder', 'title' => $value->title, 'style' => ''));
        }
    }

    public static function get_picture_responsive($id) {
        $value = Content::model()->findByAttributes(array('id' => $id));
        $filePath = Yii::app()->basePath . '/../uploads/images/' . $value->images;
        if ((is_file($filePath)) && (file_exists($filePath))) {
            return CHtml::image(Yii::app()->baseUrl . '/uploads/images/' . $value->images, 'Picture', array('alt' => $value->title, 'class' => 'img-responsive img-thumbnail', 'title' => $value->title, 'style' => ''));
        } else {
            return CHtml::image(Yii::app()->baseUrl . '/uploads/images/default.png', 'Picture', array('alt' => $value->title, 'class' => 'img-responsive', 'title' => $value->title, 'style' => ''));
        }
    }

    public static function get_picture_fixed($id) {
        $value = Content::model()->findByAttributes(array('id' => $id));
        $filePath = Yii::app()->basePath . '/../uploads/images/' . $value->images;
        if ((is_file($filePath)) && (file_exists($filePath))) {
            return CHtml::image(Yii::app()->baseUrl . '/uploads/images/' . $value->images, 'Picture', array('alt' => $value->title, 'class' => 'img-thumbnail', 'title' => $value->title, 'style' => 'height:170px;width:230px;'));
        } else {
            return CHtml::image(Yii::app()->baseUrl . '/uploads/images/default.png', 'Picture', array('alt' => $value->title, 'class' => 'img-responsive', 'title' => $value->title, 'style' => 'height:170px;width:230px;'));
        }
    }

    public static function get_popular() {
        $array = Content::model()->findAll(
                array(
                    'select' => 'id,title,catid,introtext,created',
                    'condition' => 'state=1 AND catid !=1',
                    'order' => 'hits DESC',
                    'limit' => '10',
        ));
        foreach ($array as $key => $value) {
            echo '<div class="prev-article row">';
            echo '<div class="blog-prev-date col-md-3 col-sm-3">';
            echo Content::get_picture_responsive($value['id']);
            echo '</div>';
            echo '<div class="col-md-9 col-sm-9">';
            echo '<h5 class="article-title">' . CHtml::link($value['title'], array('news/view', 'id' => $value['id']), array()) . '</h5>';
            echo '<span>' . UserAdmin::get_date($value['created']) . '</span>';
            echo '</div>';
            echo '</div>';
        }
    }

    public static function get_recent() {
        $array = Content::model()->findAll(
                array(
                    'select' => 'id,title,catid,introtext,created',
                    'condition' => 'state=1 AND catid !=1',
                    'order' => 'created DESC, id DESC',
                    'limit' => '10',
        ));
        foreach ($array as $key => $value) {
            echo '<div class="prev-article row">';
            echo '<div class="blog-prev-date col-md-3 col-sm-3">';
            echo Content::get_picture_responsive($value['id']);
            echo '</div>';
            echo '<div class="col-md-9 col-sm-9">';
            echo '<h5 class="article-title">' . CHtml::link($value['title'], array('news/view', 'id' => $value['id']), array()) . '</h5>';
            echo '<span>' . UserAdmin::get_date($value['created']) . '</span>';
            echo '</div>';
            echo '</div>';
        }
    }

    public static function get_news_home($catid) {
        $array = Content::model()->findAll(
                array(
                    'select' => 'id,title,catid,introtext,created',
                    'condition' => 'state=1 AND catid=' . (int) $catid,
                    'order' => 'created DESC, id DESC',
                    'limit' => '5',
        ));
        $i = 1;
        foreach ($array as $key => $value) {
            if ($i == 1) {
                echo Content::get_picture_fixed($value['id']);
                echo '<h4>' . CHtml::link($value['title'], array('news/view', 'id' => $value['id']), array()) . '</h4>';
            } else {
                echo '<div>' . CHtml::link('<i class="fa fa-sign-out"></i> ' . $value['title'], array('news/view', 'id' => $value['id']), array()) . '</div>';
            }
            $i++;
        }
    }

    public static function get_editorial_choice() {
        $array = Content::model()->findAll(
                array(
                    'select' => 'id,title,catid,introtext,created',
                    'condition' => 'state=1 AND editorial_choice=1',
                    'order' => 'ordering DESC, created DESC',
                    'limit' => '6',
        ));
        $i = 1;
        echo '<div class="row">';
        foreach ($array as $key => $value) {
            if ($i == 1) {
                echo '<div class="col-md-6">';
                echo Content::get_picture_responsive($value['id']);
                echo '<h4>' . CHtml::link($value['title'], array('news/view', 'id' => $value['id']), array()) . '</h4>';
                echo '</div>';
            } else {
                echo '<div>' . CHtml::link('<i class="fa fa-sign-out"></i> ' . $value['title'], array('news/view', 'id' => $value['id']), array('style' => 'font-size:16px;')) . '<br /><span style="font-size:11px;">' . UserAdmin::get_date_time($value['created']) . '</span></div>';
            }
            $i++;
        }
        echo '</div>';
    }

}
