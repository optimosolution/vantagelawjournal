<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    public $userData;

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = 'application.views.layouts.column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'users' => array('*'),
                'actions' => array('login'),
            ),
            array('allow',
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function init() {
        $this->statistics();
        if (!isset(Yii::app()->session['newsdate'])) {
            Yii::app()->session['newsdate'] = date('Y-m-d');
        }
    }

    public function checkAccess($controller, $action) {
        $val = Yii::app()->db->createCommand()
                ->select('access')
                ->from('{{acl}}')
                ->where('LOWER(controller)="' . $controller . '" AND LOWER(actions)="' . $action . '" AND group_id=' . Yii::app()->user->group . ' AND controller_type=0')
                ->queryScalar();
        if (empty($val)) {
            $val = 1;
        } else {
            $val = $val;
        }
        return $val;
    }

    public function statistics() {
        $model = new Visitor;
        $model->user_type = 0;
        $model->user_id = Yii::app()->user->id;
        $model->user_name = Yii::app()->user->name;
        $model->server_time = new CDbExpression('NOW()');
        $model->page_title = $this->pageTitle;
        $model->page_link = Yii::app()->request->url;
        $model->browser = Yii::app()->browser->getBrowser();
        $model->visitor_ip = $_SERVER['REMOTE_ADDR'];
        $model->save();
    }

    public function firstNwords($str, $n) {
        return preg_replace('/((\b\w+\b.*?){' . $n . '}).*$/s', '$1', $str);
    }

    public function strip_html_tags($string) {

        $string = str_replace("\r", ' ', $string);
        $string = str_replace("\n", ' ', $string);
        $string = str_replace("\t", ' ', $string);
        $pattern = '/<[^>]*>/';
        $string = preg_replace($pattern, ' ', $string);
        $string = trim(preg_replace('/ {2,}/', ' ', $string));

        return $string;
    }

    function html2txt($document) {
        $search = array('@<script[^>]*?>.*?</script>@si', // Strip out javascript
            '@<[\/\!]*?[^<>]*?>@si', // Strip out HTML tags
            '@<style[^>]*?>.*?</style>@siU', // Strip style tags properly
            '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
        );
        $text = preg_replace($search, '', $document);
        return $text;
    }

    public function text_cut($text, $length = 200, $dots = true) {
        $text = trim(preg_replace('#[\s\n\r\t]{2,}#', ' ', $text));
        $text_temp = $text;
        while (substr($text, $length, 1) != " ") {
            $length++;
            if ($length > strlen($text)) {
                break;
            }
        }
        //$text = substr($text, 0, $length);
        $text = mb_substr($text, 0, $length, 'UTF-8');
        return $text . ( ( $dots == true && $text != '' && strlen($text_temp) > $length ) ? '...' : '');
    }

    public function get_advertisement($catid) {
        $array = Yii::app()->db->createCommand()
                ->select('*')
                ->from('{{banner}}')
                //->where('published=1 AND catid=' . $catid . ' AND publish_up <= NOW()  AND publish_down >= NOW()')
                ->where('published=1 AND catid=' . $catid)
                ->order('ordering ASC, created_on DESC')
                ->queryAll();

        foreach ($array as $key => $values) {
            echo '<div style="margin-bottom:5px;">';
            $banner = CHtml::image(Yii::app()->baseUrl . '/uploads/banners/' . $values['banner'], $values['name'], array('title' => $values['name'], 'class' => 'img-responsive thumbnail'));
            echo CHtml::link($banner, $values['clickurl'], array('target' => '_blank'));
            echo '</div>';
        }
    }

    public function get_youtube_video() {
        $value = Yii::app()->db->createCommand()
                ->select('youtube_id')
                ->from('{{youtube}}')
                ->limit('1')
                ->order('created_on DESC')
                ->queryScalar();
        return $value;
    }

    public function get_logo($catid) {
        $array = Yii::app()->db->createCommand()
                ->select('*')
                ->from('{{banner}}')
                ->where('published=1 AND catid=' . $catid)
                ->limit('1')
                ->order('ordering ASC, created_on DESC')
                ->queryAll();

        foreach ($array as $key => $values) {
            $banner = CHtml::image(Yii::app()->baseUrl . '/uploads/banners/' . $values['banner'], $values['name'], array('title' => $values['name'], 'class' => 'logo'));
            echo CHtml::link($banner, $values['clickurl'], array('target' => '_blank'));
        }
    }

}
