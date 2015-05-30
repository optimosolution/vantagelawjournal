<?php

class ContentController extends BackEndController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    protected function beforeAction($action) {
        $access = $this->checkAccess(Yii::app()->controller->id, Yii::app()->controller->action->id);
        if ($access == 1) {
            return true;
        } else {
            Yii::app()->user->setFlash('error', "You are not authorized to perform this action!");
            $this->redirect(array('/site/noaccess'));
        }
    }

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'upload', 'listimages', 'image', 'remove'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('create', 'update', 'admin', 'delete', 'upload', 'listimages', 'image', 'remove'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionUpload() {
        $image = new Content;
        $image->file = CUploadedFile::getInstanceByName('file');
        if ($image->validate(array('file'))) {
            if ($image->file->saveAs(Yii::app()->basePath . '/../images/' . time() . '_' . strtolower($image->file->name))) {
                echo CHtml::image(Yii::app()->baseUrl . '/images/' . time() . '_' . strtolower($image->file->name));
                Yii::app()->end();
            }
        }

        throw new CHttpException(403, 'The server is crying in pain as you try to upload bad stuff');
    }

    public function actionListimages() {
        $images = array();
        $handler = opendir(Yii::app()->basePath . '/../images');
        while ($file = readdir($handler)) {
            if ($file != "." && $file != "..")
                $images[] = $file;
        }
        closedir($handler);
        $jsonArray = array();
        foreach ($images as $image)
            $jsonArray[] = array(
                'thumb' => Yii::app()->baseUrl . '/images/' . $image,
                'image' => Yii::app()->baseUrl . '/images/' . $image
            );

        header('Content-type: application/json');
        echo CJSON::encode($jsonArray);
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        //Display more picture grid
        $modelmore = new ContentImage('search');
        $modelmore->unsetAttributes();  // clear any default values
        if (isset($_GET['ContentImage']))
            $modelmore->attributes = $_GET['ContentImage'];

        $this->render('view', array(
            'model' => $this->loadModel($id),
            'modelmore' => $modelmore,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Content;
        $model_images = new ContentImage;
        $path = Yii::app()->basePath . '/../uploads/images';
        if (!is_dir($path)) {
            mkdir($path);
        }

        if (isset($_POST['Content'])) {
            $model->attributes = $_POST['Content'];
            //$images->attributes = $_POST['ContentImage'];
            $images = CUploadedFile::getInstancesByName('image');
            if ($model->validate()) {
                $model->created = new CDbExpression('NOW()');
                $model->created_by = Yii::app()->user->id;
                if (empty($model->alias)) {
                    $model->alias = str_replace(' ', '-', strtolower($model->title));
                } else {
                    $model->alias = str_replace(' ', '-', strtolower($model->alias));
                }
                //Picture upload script
                if (@!empty($_FILES['Content']['name']['images'])) {
                    $model->images = $_POST['Content']['images'];

                    if ($model->validate(array('images'))) {
                        $model->images = CUploadedFile::getInstance($model, 'images');
                    } else {
                        $model->images = null;
                    }
                    $model->images->saveAs($path . '/' . time() . '_' . str_replace(' ', '_', strtolower($model->images)));
                    $model->images = time() . '_' . str_replace(' ', '_', strtolower($model->images));
                }
                if ($model->save()) {
                    Yii::app()->user->setFlash('success', 'Data was saved successfully');
                    if (isset($_POST['savennew'])) {
                        $this->redirect(array('create'));
                    } elseif (isset($_POST['saveedit'])) {
                        $this->redirect(array('update', 'id' => $model->id));
                    } else {
                        $this->redirect(array('admin'));
                    }
                }
            }
        }

        $this->render('create', array(
            'model' => $model,
            'model_images' => $model_images,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $model_images = new ContentImage;
        $previuosFileName = $model->images;
        $path = Yii::app()->basePath . '/../uploads/images';
        if (!is_dir($path)) {
            mkdir($path);
        }
        //Display more picture grid
        $modelmore = new ContentImage('search');
        $modelmore->unsetAttributes();  // clear any default values
        if (isset($_GET['ContentImage']))
            $modelmore->attributes = $_GET['ContentImage'];

        if (isset($_POST['Content'])) {
            $model->attributes = $_POST['Content'];
            if ($model->validate()) {
                $model->modified = new CDbExpression('NOW()');
                $model->modified_by = Yii::app()->user->id;
                if (empty($model->alias)) {
                    $model->alias = str_replace(' ', '-', strtolower($model->title));
                } else {
                    $model->alias = str_replace(' ', '-', strtolower($model->alias));
                }
                //Picture upload script
                if (@!empty($_FILES['Content']['name']['images'])) {
                    $model->images = $_POST['Content']['images'];

                    if ($model->validate(array('images'))) {
                        $myFile = $path . '/' . $previuosFileName;
                        if ((is_file($myFile)) && (file_exists($myFile))) {
                            unlink($myFile);
                        }
                        $model->images = CUploadedFile::getInstance($model, 'images');
                    } else {
                        $model->images = null;
                    }
                    $model->images->saveAs($path . '/' . time() . '_' . str_replace(' ', '_', strtolower($model->images)));
                    $model->images = time() . '_' . str_replace(' ', '_', strtolower($model->images));
                } else {
                    $model->images = $previuosFileName;
                }
                if ($model->save()) {
                    Yii::app()->user->setFlash('success', 'Content has been updated successfully');
                    if (isset($_POST['savennew'])) {
                        $this->redirect(array('create'));
                    } elseif (isset($_POST['saveedit'])) {
                        $this->redirect(array('update', 'id' => $model->id));
                    } else {
                        $this->redirect(array('admin'));
                    }
                }
            }
        }

        $this->render('update', array(
            'model' => $model,
            'model_images' => $model_images,
            'modelmore' => $modelmore,
        ));
    }

    public function actionImage() {
        $model = new ContentImage;
        $path = Yii::app()->basePath . '/../uploads/images';
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        if (isset($_POST['ContentImage'])) {
            $model->attributes = $_POST['ContentImage'];
            $model->created = new CDbExpression('NOW()');
            if ($model->validate()) {
                //Picture upload script
                if (@!empty($_FILES['ContentImage']['name']['content_image'])) {
                    $model->content_image = $_POST['ContentImage']['content_image'];

                    if ($model->validate(array('ContentImage'))) {
                        $model->content_image = CUploadedFile::getInstance($model, 'content_image');
                    } else {
                        $model->content_image = null;
                    }
                    $model->content_image->saveAs($path . '/' . time() . '_' . str_replace(' ', '_', strtolower($model->content_image)));
                    $model->content_image = time() . '_' . str_replace(' ', '_', strtolower($model->content_image));
                }
                if ($model->save()) {
                    echo $model->id;
                } else {
                    echo "false";
                }
            }
        }
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {

        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    public function actionRemove($id) {

        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModelImage($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->redirect(array('admin'));
        $dataProvider = new CActiveDataProvider('Content');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {

        $model = new Content('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Content']))
            $model->attributes = $_GET['Content'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Content::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadModelImage($id) {
        $model = ContentImage::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'content-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
