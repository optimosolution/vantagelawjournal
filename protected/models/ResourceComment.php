<?php

/**
 * This is the model class for table "{{resource_comment}}".
 *
 * The followings are the available columns in table '{{resource_comment}}':
 * @property integer $id
 * @property integer $resource
 * @property string $full_name
 * @property string $email
 * @property string $website
 * @property string $comment
 * @property string $created
 * @property integer $status
 */
class ResourceComment extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{resource_comment}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('resource, full_name, email, comment, created', 'required'),
            array('resource, status', 'numerical', 'integerOnly' => true),
            array('full_name, email', 'length', 'max' => 150),
            array('website', 'length', 'max' => 100),
            array('email', 'email'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, resource, full_name, email, website, comment, created, status', 'safe', 'on' => 'search'),
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
            'resource' => 'Resource',
            'full_name' => 'Name',
            'email' => 'Email',
            'website' => 'Website',
            'comment' => 'Comment',
            'created' => 'Created',
            'status' => 'Status',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('resource', $this->resource);
        $criteria->compare('full_name', $this->full_name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('website', $this->website, true);
        $criteria->compare('comment', $this->comment, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ResourceComment the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function count_comments($resource) {
        $value = ResourceComment::model()->findAll(array('condition' => 'status=1 AND resource=' . $resource,));
        return count($value);
    }

    public static function get_comments($resource) {
        $array = ResourceComment::model()->findAll(
                array(
                    'select' => 'id,full_name,email,comment,created',
                    'condition' => 'status=1 AND resource=' . $resource,
                    'order' => 'created DESC',
        ));
        echo '<ul>';
        foreach ($array as $key => $value) {
            ?>
            <div class="comment">
                <!-- user-avatar -->
                <span class="user-avatar">
                    <img class="pull-left media-object" src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/avatar.png" width="64" height="64" alt="">
                </span>
                <div class="media-body">
                    <h4 class="media-heading bold"><?php echo $value['full_name']; ?></h4>
                    <small class="block"><?php echo UserAdmin::get_date_time($value['created']); ?></small>
                    <?php echo $value['comment']; ?> 
                </div>
            </div>
            <?php
        }
        echo '</ul>';
    }

    public static function get_recent_comments() {
        $array = ResourceComment::model()->findAll(
                array(
                    'condition' => 'status=1',
                    'order' => 'created DESC, id DESC',
                    'limit' => '10',
        ));
        echo '<ul>';
        foreach ($array as $key => $value) {
            echo '<li>' . CHtml::link('<i class="fa fa-sign-out"></i> ' . mb_substr($value['comment'], 0, 50, 'UTF-8') . '... by ' . $value['full_name'], array('news/view', 'id' => $value['resource']), array()) . '</li>';
        }
        echo '</ul>';
    }

}
